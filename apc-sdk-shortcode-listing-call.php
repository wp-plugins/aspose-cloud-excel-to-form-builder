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


$sheet_name = 'Sheet1';

$excel_file = $filename;

$ext = pathinfo($excel_file, PATHINFO_EXTENSION);


if($ext == 'xls' || $ext == 'xlsx') {

    $func = new Worksheet($excel_file,$sheet_name);
    $rows = $func->getRowsCount(1,10000);
    $cols = $func->getMaxColumn(0,10000);
    $html_string = '<table cellspacing="10" cellpadding="10" width="100%">';

    for($row = 1; $row <= $rows; $row++){
        $html_string .= '<tr>';
        for($col = 0; $col <= $cols; $col++){
            $cell = generateAlphabet($col) . $row;
            $cell_value = $func->getcell($cell);
            $cell_value = $cell_value->Value;

            if($row == '1') {
                $html_string .= '<th>' . $cell_value . '</th>';
            } else {
                $html_string .= '<td>' . $cell_value . '</td>';
            }
        }
        $html_string .= '</tr>';
    }
    $html_string .= '</table>';
    echo $html_string;
    //echo "<pre>"; print_r($rows); exit;

} else {
    echo "Wrong File was selected!";
}