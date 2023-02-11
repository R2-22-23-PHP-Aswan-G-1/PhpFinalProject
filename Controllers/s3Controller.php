<?php
require_once('../vendor/autoload.php');

use Controllers\orderController as orderController;
use Models\product as productModel;

$productModel = new productModel();
// old file name
$GLOBALS['file_name'] = $productModel->getRowByKey('product_id', 1)['product_link'];
$orderController = new orderController();
//increase counter
$orderController->increaseCounter();
// new name in DB
$GLOBALS['newFileName'] = $productModel->changeFileName();
download();
function download()
{
	$name = $GLOBALS['file_name'];
	$old_zip_file = $name . '.zip';
	$new_zip_file = $GLOBALS['newFileName'] . '.zip';
	rename($old_zip_file, $new_zip_file);
	// header
	header('Content-type: application/zip');
	header('Content-Disposition: attachment; filename="' . basename("$new_zip_file") . '"');
	header("Content-length: " . filesize("$new_zip_file"));
	header("Pragma: no-cache");
	header("Expires: 0");
	// clean output buffering
	ob_clean();
	flush();
	readfile("$new_zip_file");
}
