<?php
require_once('DatabaseHelper.php');

session_start();
$database = new DatabaseHelper();

$error = false;
$vorname = trim($_POST['vorname']);
$nachname = trim($_POST['nachname']);
$strasse = trim($_POST['strasse']);
$plz = $_POST['plz'];
$bankverbindung = $_POST['iban'];
$email = $_POST['email'];
$benutzername = trim($_POST['benutzername']);
$telefonnummer = $_POST['telefonnummer'];
$passwort = $_POST['passwort'];
$passwort2 = $_POST['passwort2'];
$registered = false;

if (empty($vorname) || empty($nachname) || empty($bankverbindung) || empty($strasse) || empty($benutzername) || empty($plz) || empty($email)) {
    echo "Bitte alle Felder ausfüllen<br>";
    $error = true;
}

$email = filter_var($email, FILTER_SANITIZE_EMAIL);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Ungültige E-mail<br>";
    $error = true;
}

if (strlen($passwort) == 0) {
    echo "Bitte ein Passwort einfügen<br>";
    $error = true;
}

if ($passwort != $passwort2) {
    echo "Die Passwörter müssen übereinstimmen<br>";
    $error = true;
}

if (!$error) {
    $user = $database->selectFromUserLikeEmail($email);
    if ($user != false) {
        echo "Email bereits vergeben<br>";
        $error = true;
    }
}

if (!$error) {
    //Hasht ein neues Passwort in der Datenbank
    //funktion generiert automatisch eine kryptografische sichere salt
    $hashed_password = password_hash($passwort, PASSWORD_BCRYPT);
    $database->insertIntoPerson($vorname, $nachname, $strasse, $plz);
    $person = $database->selectPersonIdLikeName($vorname, $nachname);
    $sucess = $database->insertIntoCustomer($person['PERSON_ID'], $bankverbindung, $telefonnummer);
    $id = $database->selectKNrFromCustomerLikePersonId($person['PERSON_ID']);
    $register = $database->insertIntoUser($benutzername, $hashed_password, $email, 0, $id['KNR']);
    $user = $database->selectFromUserLikeEmail($email);
    if ($user != false && $register != false) {
        $_SESSION['benutzerid'] = $user['BENUTZERID'];
        $_SESSION['benutzername'] = $user['BENUTZERNAME'];
        $_SESSION['email'] = $user['EMAIL'];
        $_SESSION['logged_in'] = true;
        $_SESSION['customer_id'] = $user['KUNDENNUMMER_FK'];
        $_SESSION['shoppingCart'] = 0;
        header("location:logged_in.php");
        exit;
    } else {
        echo "Bei der Anmeldung ist ein Fehler entstanden<br>";
        $_SESSION['signed_up'] = false;
    }
}
?>
