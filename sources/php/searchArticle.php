<?php
require_once ("DatabaseHelper.php");
$database = new DatabaseHelper();

echo $_POST['productname'];
$search_product = '';

if(isset($_POST['productname'])){
    $search_product = $_POST['productname'];
}
if(isset($_POST['searchProduct'])){
    $searched = $database->selectProductByName($search_product);
    echo $searched['BEZEICHNUNG'];
    echo $searched['PREIS'];
    echo $searched['ARTIKELNUMMER'];


}
















?>