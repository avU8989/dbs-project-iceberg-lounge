<?php
require_once('DatabaseHelper.php');
include('login.php');
include('func.php');
$database = new DatabaseHelper();
date_default_timezone_set('Europe/Vienna');
$date = date('Y-m-d');
$_SESSION['date'] = $date;

if(!is_checked_in()){
    header('location: error.php');
    exit;
}

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['add_to_card']) && isset($_SESSION['customer_id'])) {
        // Set the post variables so we easily identify them, also make sure they are integer
        $product_id = (int)$_POST['product_id'];
        $user_id = $_SESSION['benutzerid'];
        // Prepare the SQL statement, we basically are checking if the product exists in our databaser
        $product = $database->selectProductByID($product_id);
        /*
        //select order date und verlgeich order date mit derzeitigen date und check ob order knr gleiche knr ist dann update order anstatt neu zu inserten -> trigger für order
        if(($database->selectOrderIdLikeDateAndCustomerId($_SESSION['customer_id'], $_SESSION['date'])) == false){
            $database->insertIntoOrder($date, $customer_id['KUNDENNUMMER_FK']);//funktioniert $database->update
        }
        $order = $database->selectOrderIdLikeDateAndCustomerId($customer_id['KUNDENNUMMER_FK'], $date);
        echo $order['BESTELLNUMMER'] . "<br>";
        */
        // Fetch the product from the database and return the result as an Array
        // Check if the product exists (array is not empty)
        if ($product != false) {
            $cart = $database->selectProductFromShoppingCart($_SESSION['customer_id'], $product_id);
            if ($cart) {
                $yes = $database->updateQuantityinShoppingCart($cart['MENGE'] + 1, $_SESSION['customer_id'], $product_id);
                $cart = $database->selectProductFromShoppingCart($_SESSION['customer_id'], $product_id);
            } else {
                $success = $database->insertIntoShoppingCart($product_id,$_SESSION['customer_id'],1);
                $cart = $database->selectProductFromShoppingCart($_SESSION['customer_id'], $product_id);
            }
            // Product exists in database, now we can create/update the session variable for the cart
            $_SESSION['cart'][$product_id] = $cart['MENGE'];
            $_SESSION['date'] = $date;
        }
        // Prevent form resubmission...

        $quantity_of_cart =  $database->quantityOfShoppingCart($_SESSION['customer_id']);
        if($quantity_of_cart > 0){
           $_SESSION['shoppingCart'] =  $quantity_of_cart[0]; 
        }else{
            $_SESSION['shoppingCart'] = 0;
        }
        
        header('location: shoppingcart.php');
        exit;
        
}

?>



