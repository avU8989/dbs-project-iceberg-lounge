<?php
session_start();
setcookie(session_name(), '', 100);
session_unset();
session_destroy();

$_SESSION = array();
?>

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

<style>
    .hero-image {
        background-image: url("background2.jpg");
        background-color: #cccccc;
        height: 1000px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
    }
</style>

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
</script>

<body>
    <header class="hero-image">
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-*">
            <div class="container px-5">
                <img src="logo2.png" alt="HTML5 Icon" width="128" height="128">
                <a class="navbar-brand" href="#!">Icerberg Lounge</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="https://wwwlab.cs.univie.ac.at/~vua36/index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" style="color:white;" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" style="color:white;" href="#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" style="color:white;" href="#!">Services</a></li>


                    </ul>
                    <div class="btn-group">
                        <button class="button">Warenrücksendungen und Bestellungen</button>
                        <button class="button" onclick="openLogin()">Login</button>
                        <button class="button" onclick="openSignUp()">Account erstellen</button>
                        <button class="button" onclick="redirectShoppingCart()">
                            <span class="glyphicon glyphicon-shopping-cart"></span>Einkaufswagen</button>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2" style="text-align:center;">Sie müssen angemeldet sein!</h1>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a class="btn btn-outline-light btn-lg px-4" href="https://wwwlab.cs.univie.ac.at/~vua36/index.php">Zurück zur Homepage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include ("popup.php"); ?>
    </header>
</body>

</html>