<?php
require_once('DatabaseHelper.php');

session_start();
$database = new DatabaseHelper();
	if (isset($_POST['email']) && isset($_POST['passwort'])) {
		$email = $_POST['email'];
		$password = $_POST['passwort'];
		$user = $database->selectFromUserLikeEmail($email);
		$quantity_of_cart =  $database->quantityOfShoppingCart($user['KUNDENNUMMER_FK']);
		//Überprüfung Passwort
		if ($user != false && password_verify($password, $user['PASSWORT']/*($password == $user['PASSWORT'])*/)) {
			$_SESSION['benutzerid'] = $user['BENUTZERID'];
			$_SESSION['benutzername'] = $user['BENUTZERNAME'];
			$_SESSION['email'] = $user['EMAIL'];
			$_SESSION['logged_in'] = true;
			$_SESSION['customer_id'] = $user['KUNDENNUMMER_FK'];

			$_SESSION['shoppingCart'] = $quantity_of_cart[0];
			
			header("location:logged_in.php");
			exit;
			
		} else {			
			header("location:errorLogin.php");
			$_SESSION['logged_in'] = false;
			exit;			

		}
	}


$email_value = "";
if (isset($_POST['email']))
	$email_value = htmlentities($_POST['email']);

?>
