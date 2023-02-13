<?php

include("func.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Startseite</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styles.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
</head>

<style>
    .dropbtn {
        background-color: transparent;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        background-color: transparent;
        border: none;
        right: 50px;
        text-align: center;
        color: white;
        opacity: 0.9;
        cursor: pointer;
        float: left;
    }

    .button-test {
        display: none;
        position: absolute;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        background-color: transparent;
        border: none;
        right: 50px;
        text-align: center;
        color: white;
        opacity: 0.8;
        cursor: pointer;
        float: left;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
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

    function openChangePassword() {
        document.getElementById("changePassword").style.display = "block";
    }

    function closeChangePassword() {
        document.getElementById("changePassword").style.display = "none";
    }

    function redirectOrders(){
        location.replace("https://wwwlab.cs.univie.ac.at/~vua36/orders.php");
    }
</script>
<style>
    .form-popup {
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 400px;
    /* adjust as per your needs */
    height: 500px;
    /* adjust as per your needs */
    margin-left: -200px;
    /* negative half of width above */
    margin-top: -100px;
    border: 3px solid #f1f1f1;
    border-radius: 25px;
    z-index: 9;
    background: white;
}
</style>
<body>
    <header class="hero-image">
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-*">

            <div class="container px-5" style="width:100%; height:100px">
                <img src="logo2.png" alt="HTML5 Icon" width="128" height="128">
                <a class="navbar-brand" style="width:100px" href="#!">Icerberg Lounge</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if (!is_checked_in()) : ?>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="https://wwwlab.cs.univie.ac.at/~vua36/index.php">Home</a></li>
                        <?php else : ?>
                            <li class="nav-item"><a class="nav-link active" aria-current="page" href="https://wwwlab.cs.univie.ac.at/~vua36/logged_in.php">Home</a></li>
                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" style="color:white;" href="#!">About</a></li>
                        <li class="nav-item"><a class="nav-link" style="color:white;" href="#!">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" style="color:white;" href="#!">Services</a></li>


                    </ul>
                    <div class="btn-group">
                        <?php if (!is_checked_in()) : ?>
                            <button class="button" onclick="openLogin()">Login</button>
                            <button class="button" onclick="openSignUp()">Account erstellen</button>
                        <?php else : ?>
                            <button class="button" onclick="redirectOrders()">Warenrücksendungen und Bestellungen</button>
                            <div class="dropdown">
                                <button class="button" style="width:100px"><?php echo $_SESSION['benutzername']; ?></button>
                                <div class="dropdown-content">
                                    <div class="btn-group" style="display:block">
                                        <button class="button" style="color:black" >Wunschzettel</button>
                                        <button class="button" style="color:black" >Konten wechsel</button>
                                        <button class="button" style="color:black" >Button1</button>
                                        <button class="button" style="color:black" >Button2</button>
                                        <form action="deleteAccount.php" method="POST">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['benutzerid'] ?>" />
                                            <input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id'] ?>" />
                                            <button type="submit" name="delete_account" value="delete_account" class="button" style="color:black">Account löschen</button>
                                        </form>
                                        <button class="button" style="color:black" onclick="openChangePassword()">Passwort ändern</button>

                                    </div>
                                    <a class="button" style="color:black" href="s">Accountverwaltung</a>
                                </div>
                            </div>

                            <form action="logout.php" method="get">
                                <button class="button" formaction="logout.php">Sign out</button>
                            </form>
                        <?php endif; ?>
                        <button class="button" onclick="redirectShoppingCart()">

                            <button type="button" onclick="redirectShoppingCart()" class="button">
                                Einkaufswagen
                                <?php if (is_checked_in()) : ?>
                                    <span class="badge badge-dark" style="background-color: rgba(0,0,0,.5);"><?php echo $_SESSION['shoppingCart'] ?></span>
                                <?php endif; ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                            </button>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="text-center my-5">
                        <h1 class="display-5 fw-bolder text-white mb-2">SKITOUREN WELT</h1>
                        <p class="lead text-white mb-4">Alles was du für deine Skitour brauchst</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                            <a class="btn btn-outline-light btn-lg px-4" href="#features">Skitouren Welt entdecken</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php include("popup.php");?>
</body>

</html>