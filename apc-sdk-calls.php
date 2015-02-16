<?php

/*
 * Including the sdk of php
 */


use Aspose\Cloud\Common\AsposeApp;
use Aspose\Cloud\Common\Product;
use Aspose\Cloud\Storage\Folder;
use Aspose\Cloud\Cells\Worksheet;
use Aspose\Cloud\Words\Converter as WordsConverter;


function my_autoloader($class) {
    $allowed_namespace = array('AsposeApp','Product','Folder','Converter','Utils','Worksheet');
    $arr = explode('\\', $class);
    if( in_array( $arr['3'] , $allowed_namespace)){
        include 'Aspose_Cloud_SDK_For_PHP-master/src/'. $arr[0] . '/' . $arr[1] . '/' .$arr[2] . '/' . $arr[3] . '.php';
    }

}

spl_autoload_register('my_autoloader');


/*
 *  Assign appSID and appKey of your Aspose App
 */
AsposeApp::$appSID = $ape_sid;
AsposeApp::$appKey = $ape_key;

/*
 * Assign Base Product URL
 */
Product::$baseProductUri = 'http://api.aspose.com/v1.1';

AsposeApp::$appSID = $ape_sid;
AsposeApp::$appKey = $ape_key;

$upload_dir = wp_upload_dir();

$excel_file = $post_params['excel_file_name'];
if(!isset($post_params['sheet_name']) || empty($post_params['sheet_name']) ) {
    $sheet_name = 'Sheet1';
}

$filename = $upload_dir['path'] . '/' . $post_params['excel_file_name'];

$ext = pathinfo($filename, PATHINFO_EXTENSION);

function generateAlphabet($na) {
    $sa = "";
    while ($na >= 0) {
        $sa = chr($na % 26 + 65) . $sa;
        $na = floor($na / 26) - 1;
    }
    return $sa;
}


if($ext == 'xls' || $ext == 'xlsx') {

    $uploadpath = $upload_dir;
    $uploadpath = str_replace('/','\\',$uploadpath);
    $uploadpath = $uploadpath . '\\';

    AsposeApp::$outPutLocation = $uploadpath;

    $folder = new Folder();
    $uploadpath = str_replace("\\","/",$uploadpath);
    $uploadFile = $filename;
    $result = $folder->uploadFile($uploadFile, '');

    if($result['Status'] == 'OK') {

        $func = new Worksheet($excel_file,$sheet_name);
        $total_cols = $func->getMaxColumn(0,255);
        $total_rows = $func->getMaxRow(0,10000);
        $headings = array();
        for($i = 0; $i < $total_cols; $i++) {

            $cell = generateAlphabet($i) . '1';
            $result = $func->getCell($cell);
            $headings[] = $result->Value;
        }

        $ser_head = serialize($headings);

        global $wpdb;

        $sql = " DELETE FROM " .$wpdb->prefix."apc_shortcodes WHERE `filename` = '$excel_file'; ";
        $wpdb->query($sql);

        $querystr = "
            INSERT INTO " .$wpdb->prefix."apc_shortcodes SET `filename` = '$excel_file', `head_row` = '$ser_head'
         ";
        $wpdb->query($querystr);

    }

} else {
    echo "Wrong File was selected!";
}



