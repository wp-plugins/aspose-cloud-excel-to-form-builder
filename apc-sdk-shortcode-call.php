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

$ape_sid = get_option('aspose_cloud_excel_to_form_app_sid');
$ape_key = get_option('aspose_cloud_excel_to_form_app_key');

if(empty($ape_sid) || empty($ape_key)) {
    return '<div><h2 style="color: red">Please enter Aspose SID and Key on plugin settings page.</h2></div>';
    //   return;
}

/*
 * Assign Base Product URL
 */
Product::$baseProductUri = 'http://api.aspose.com/v1.1';

AsposeApp::$appSID = $ape_sid;
AsposeApp::$appKey = $ape_key;

$post_params = $_POST;
//echo "<pre>"; print_r($post_params); exit;
$excel_file = $post_params['excel_file_name'];
if(!isset($post_params['sheet_name']) || empty($post_params['sheet_name']) ) {
    $sheet_name = 'Sheet1';
}

$excel_file = $post_params['filename'];

$ext = pathinfo($excel_file, PATHINFO_EXTENSION);


if($ext == 'xls' || $ext == 'xlsx') {

    $func = new Worksheet($excel_file,$sheet_name);
   // $total_cols = $func->setCellValue('','',);
    if(isset($post_params['col']) && is_array($post_params['col'])){
        $total_rows = $func->getRowsCount(0,10000);
        $next_row = $total_rows + 1;
        foreach($post_params['col'] as $key=>$value){
            $cell = generateAlphabet($key) . $next_row;
            $func->setCellValue($cell,'string',$value);
        }
        echo 'Record has been updated!';
    }
} else {
    echo "Wrong File was selected!";
}