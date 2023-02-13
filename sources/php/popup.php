<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Business Frontpage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styles.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
</head>

<script>
    function openLogin() {
        document.getElementById("myForm").style.display = "block";
    }

    function openSignUp() {
        document.getElementById("SignUp").style.display = "block";
    }

    function closeSignUp() {
        document.getElementById("SignUp").style.display = "none";
    }


    function closeLogin() {
        document.getElementById("myForm").style.display = "none";
    }

    function redirectShoppingCart() {
        location.replace("https://wwwlab.cs.univie.ac.at/~vua36/shoppingcart.php");
    }

    function redirectlogged() {
        location.replace("https://wwwlab.cs.univie.ac.at/~vua36/logged_in.php");
    }

    function openChangePassword() {
        document.getElementById("changePassword").style.display = "block";
    }

    function closeChangePassword() {
        document.getElementById("changePassword").style.display = "none";
    }
</script>

<style>
    .form-popup {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 800px;
        /* adjust as per your needs */
        height: 500px;
        /* adjust as per your needs */
        margin-left: -400px;
        /* negative half of width above */
        margin-top: -260px;
        border: 3px solid #f1f1f1;
        border-radius: 25px;
        z-index: 9;
        background-image: url("https://img.freepik.com/free-vector/paper-style-winter-wallpaper_23-2148713724.jpg?w=1380&t=st=1675352265~exp=1675352865~hmac=cbddce1f510e97b7a201eece50d81975af7f9caec3effd4794283dae605724b4");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .form-container {
        max-width: 50%;
        padding: 4px;
        border-radius: 25px;
        background-color: transparent;
    }

    .input{
        border-radius: 25px; 
        opacity: 0.9;
        color:black;
    }

    .form-popup-sign_in {
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 800px;
    /* adjust as per your needs */
    height: 950px;
    /* adjust as per your needs */
    margin-left: -400px;
    /* negative half of width above */
    margin-top: -475px;
    border: 3px solid #f1f1f1;
    border-radius: 25px;
    background-image: url("https://www.pixelstalk.net/wp-content/uploads/images2/Winter-Night-wallpaper-HD.png");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    z-index: 9;
}

.form-popup-change_password {
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 800px;
    /* adjust as per your needs */
    height: 500px;
    /* adjust as per your needs */
    margin-left: -400px;
    /* negative half of width above */
    margin-top: -250px;
    border: 3px solid #f1f1f1;
    border-radius: 25px;
    background: white;
    z-index: 9;
}

.form-container-sign_in {
    max-width: 100%;
    padding: 6px;
    border-radius: 25px;
    background-color: transparent;
}

.form-container-change_password {
    max-width: 100%;
    padding: 6px;
    background-color: whitesmoke;
}

</style>



<div class="form-popup" id="myForm">
    <form action="login.php" class="form-container" method="POST">
        <h1 style="text-align: center; color:white">Login</h1>
        <label for="email" style="color:white"><b>Email</b></label>
        <input type="text" class="input" placeholder="Enter Email" name="email" value="email" required>

        <label for="psw" style="color:white"><b>Passwort</b></label>
        <input type="password" class="input" placeholder="Enter Password" name="passwort" value="passwort" required>

        <button type="submit" class="btn btn-primary">Login</button>
        <button type="button" class="btn btn-outline-primary" onclick="closeLogin()">Schließen</button>
    </form>
</div>

<div class="form-popup-sign_in" id="SignUp">
    <form action="signup.php" class="form-container-sign_in" method="post">
            <h1 style="color:white">SignUp</h1>
            <label style="color:white" for="vorname"><b>Vorname</b></label>
            <input class="input" type="text" name="vorname" required>

            <label style="color:white" for="nachname"><b>Nachname</b></label>
            <input class="input" type="text" name="nachname" required>

            <label style="color:white" for="strasse"><b>Strasse</b></label>
            <input class="input" type="text" name="strasse" required>

            <label style="color:white" for="plz"><b>PLZ</b></label>
            <input class="input" type="text" name="plz" required>

            <label style="color:white" for="bankverbindung"><b>Bankverbindung</b></label>
            <input class="input" type="text" name="iban" required>

            <label style="color:white" for="telefonnummer"><b>Telefonnummer</b></label>
            <input class="input" type="text" placeholder="optional" name="telefonnummer" required>

            <label style="color:white" for="benutzername"><b>Benutzername</b></label>
            <input class="input" type="text" name="benutzername" required>

            <label style="color:white" for="e-mail"><b>E-Mail</b></label>
            <input class="input" type="text" placeholder="optional" name="email" required>

            <label style="color:white" for="passwort"><b>Passwort</b></label>
            <input class="input" type="password" placeholder="mindestens 8 Zeichen" name="passwort" required>

            <label style="color:white" for="passwort_verifierzung"><b>Passwort nochmals eingeben</b></label>
            <input class="input" type="password" name="passwort2" required>

            <button type="submit" class="btn btn-primary">SignUp</button>
            <button type="button" class="btn btn-outline-primary" style="color:white; border-color: transparent;" onclick="closeSignUp()">Close</button>
    </form>
</div>

<div class="form-popup-change_password" id="changePassword">
        <form action="changePassword.php" class="form-container" style="max-width:100%" method="POST">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['benutzerid'] ?>" />
            <input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id'] ?>" />
            <input type="hidden" name="email" value="<?php echo $_SESSION['email'] ?>" />
            <label for="old_password"><b>Altes Passwort</b></label>
            <input type="password" placeholder="Enter old Password" name="old_password" required>

            <label for="new_password"><b>Neues Passwort</b></label>
            <input type="password" placeholder="Enter new Password" name="new_password" required>

            <label for="new_password_verificate"><b>Verifiziere neues Passwort</b></label>
            <input type="password" name="new_password2" required>

            <button type="submit" name="changePassword" class="btn">Passwort ändern</button>
            <button type="button" class="btn cancel" onclick="closeChangePassword()">Schließen</button>

        </form>
    </div>