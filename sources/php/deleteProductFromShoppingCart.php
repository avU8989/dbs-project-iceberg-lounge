<?php
//include DatabaseHelper.php file
session_start();
require_once('DatabaseHelper.php');

//instantiate DatabaseHelper class
$database = new DatabaseHelper();

//Grab variable id from POST request
$product = '';
if(isset($_POST['product_id'])){
    $product = $_POST['product_id'];
}


// Delete method
if(isset($_POST['delete_from_card'])){

        $quantity = $database->selectQuantityFromShoppingCart($product, $_SESSION['customer_id']);
        $database->updateQuantityinShoppingCart($quantity['MENGE']-1, $_SESSION['customer_id'], $product);
     
    if(!$database->selectProductFromShoppingCart($_SESSION['customer_id'],$product)){
        $_SESSION['cart'][$product] = 0;
    }

    $quantity_of_cart =  $database->quantityOfShoppingCart($_SESSION['customer_id']);
    if($quantity_of_cart > 0){
       $_SESSION['shoppingCart'] =  $quantity_of_cart[0]; 
    }else{
        $_SESSION['shoppingCart'] = 0;
    }
    

    // If there are products in cart

    header("location:shoppingcart.php");
    exit;
  
}
?>
