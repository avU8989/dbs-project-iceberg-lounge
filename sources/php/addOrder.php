<?php
require_once('DatabaseHelper.php');
include('login.php');
$database = new DatabaseHelper();
date_default_timezone_set('Europe/Vienna');
$date = date('Y-m-d');
$_SESSION['date'] = $date;

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['add_to_order'])) {
        // Set the post variables so we easily identify them, also make sure they are integer
        $user_id = $_SESSION['benutzerid'];
        // Prepare the SQL statement, we basically are checking if the product exists in our databaser
        $database->insertIntoOrder($date, $_SESSION['customer_id']);//funktioniert $database->update
        $order = $database->selectOrderIdLikeDateAndCustomerId($_SESSION['customer_id'], $date);
        $products = $database->selectProductsFromShoppingCart($_SESSION['customer_id']);

        foreach($products as $product){
            $database->insertIntoOrderedItems($order['BESTELLNUMMER'], $product['ARTIKELNUMMER_FK'], $product['MENGE'], 0, 0);
        }

        $database->deleteFromCart($_SESSION['customer_id']);
        $_SESSION['shoppingCart'] = 0;
        header('location: shoppingcart.php');
        exit;      
}

?>



