<?php
include("func.php");
include("login.php");
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();
$product_array = $database->selectProducts();
$counter = 0;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styles.css" rel="stylesheet" />
    <link href="style.css" rel="stylesheet" />
</head>

<style>
    .single-product:hover {
        transform: scale(1.2, 1.2);
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
</script>

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
                            <button class="button">Warenrücksendungen und Bestellungen</button>
                            <div class="dropdown">
                                <button class="button" style="width:100px"><?php echo $_SESSION['benutzername']; ?></button>
                                <div class="dropdown-content">
                                    <div class="btn-group" style="display:block">
                                        <form action="deleteAccount.php" method="POST">
                                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['benutzerid'] ?>" />
                                            <input type="hidden" name="customer_id" value="<?php echo $_SESSION['customer_id'] ?>" />
                                            <button type="submit" name="delete_account" value="delete_account" class="button" style="color:black">Account löschen</button>
                                        </form>
                                        <button class="button" style="color:black" onclick="openChangePassword()">Passwort ändern</button>
                                        <button class="button" style="color:black">Meine Bestellungen</button>
                                    </div>
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
                        <h1 class="display-5 fw-bolder text-white mb-2">Featured Product</h1>
                        <p class="lead text-white mb-4">Popular Products</p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="section-products">
        <div class="container">
            <div class="row">
                <!-- Single Product -->
                <?php foreach ($product_array as $product) : ?>
                    <?php $product_images = $database->selectProductFiles($product['ARTIKELNUMMER']); ?>
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div id="product-1" class="single-product">
                            <div class="part-1" style="<?php echo "background-image:url('products/" . $product_images[0]['FILES'] . "');"; ?> no-repeat center;  background-size: cover; background-position: center center; background-repeat: no-repeat;">
                                <ul>
                                    <li>
                                        <form action="addShoppingCart.php" method="POST">
                                            <input type="hidden" name="product_id" value="<?php echo $product_array[$counter]['ARTIKELNUMMER'] ?>" />
                                            <button type="submit" name="add_to_card" value="Zum Einkaufswagen hinzufügen" class="btn btn-success">Zum Einkaufswagen hinzufügen</button>
                                        </form>
                                    </li>
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="https://wwwlab.cs.univie.ac.at/~vua36/product.php?product=<?php echo $product['ARTIKELNUMMER']; ?>"><i class="fa fa-expand"></i></a></li>
                                </ul>
                            </div>
                            <div class="part-2">
                                <h3 class="product-title"><?php echo $product_array[$counter]["BEZEICHNUNG"]; ?>€</h3>
                                <h4 class="product-old-price"><?php echo $product_array[$counter]["PREIS"] * 1.1; ?>€</h4>
                                <h4 class="product-price"><?php echo $product_array[$counter++]["PREIS"]; ?>€</h4>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>

    <div class="form-popup" id="myForm">
        <form action="login.php" class="form-container" method="POST">
            <h1>Login</h1>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" value="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="passwort" value="passwort" required>

            <button type="submit" class="btn">Login</button>
            <button type="button" class="btn cancel" onclick="closeLogin()">Close</button>
        </form>
    </div>

    <div class="center">
        <div class="form-popup-sign_in" id="SignUp">
            <form action="signup.php" class="form-container-sign_in" method="post">
                <form action="?register=1" method="post">
                    <h1>SignUp</h1>
                    <label for="vorname"><b>Vorname</b></label>
                    <input type="text" name="vorname" required>

                    <label for="nachname"><b>Nachname</b></label>
                    <input type="text" name="nachname" required>

                    <label for="strasse"><b>Strasse</b></label>
                    <input type="text" name="strasse" required>

                    <label for="plz"><b>PLZ</b></label>
                    <input type="text" name="plz" required>

                    <label for="bankverbindung"><b>Bankverbindung</b></label>
                    <input type="text" name="iban" required>

                    <label for="telefonnummer"><b>Telefonnummer</b></label>
                    <input type="text" placeholder="optional" name="telefonnummer" required>

                    <label for="benutzername"><b>Benutzername</b></label>
                    <input type="text" name="benutzername" required>

                    <label for="e-mail"><b>E-Mail</b></label>
                    <input type="text" placeholder="optional" name="email" required>

                    <label for="passwort"><b>Passwort</b></label>
                    <input type="text" placeholder="mindestens 8 Zeichen" name="passwort" required>

                    <label for="passwort_verifierzung"><b>Passwort nochmals eingeben</b></label>
                    <input type="text" name="passwort2" required>

                    <button type="submit" class="btn-sign_in">SignUp</button>
                    <button type="button" class="btn-sign_in cancel" onclick="closeSignUp()">Close</button>
                </form>
            </form>
        </div>
    </div>

    <?php include("footer.php") ?>
</body>

</html>