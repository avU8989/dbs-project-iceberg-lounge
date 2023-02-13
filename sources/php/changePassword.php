<?php
require_once('DatabaseHelper.php');

session_start();
$database = new DatabaseHelper();
$userid = '';
$customerid = '';
$email = '';
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$new_password2 = $_POST['new_password2'];
$error = false;

if(isset($_POST['user_id']) && isset($_POST['email']) && isset($_POST['customer_id'])){
    $userid = $_POST['user_id'];
    $customerid = $_POST['customer_id'];
    $email = $_POST['email'];
}

$user = $database->selectFromUserLikeEmail($email);

if ($new_password != $new_password2) {
    echo "Die Passwörter müssen übereinstimmen<br>";
    $error = true;
}


if(!password_verify($old_password, $user['PASSWORT'])){
    $error = true;
    header("location:errorLogin.php");
    exit;
}

if(!$error){
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
   if(isset($_POST['changePassword'])){
    $database->updatePassword($hashed_password, $email);

    header("location:logged_in.php");
    exit;
   }
}
?>
