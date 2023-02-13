<?php
include("login.php");
include("header.php");
require_once('DatabaseHelper.php');
$database = new DatabaseHelper();
$anummer = $_GET['product'];
$product = $database->selectProductByID($anummer);
?>
<!DOCTYPE html>
<html>

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style.css">

</head>

<style>
    .card {
        border: none;
        overflow: hidden;
    }

    .body {
        background-color: #ecedee;
    }

    .thumbnail_images ul {
        list-style: none;
        justify-content: center;
        display: flex;
        align-items: center;
        margin-top: 10px
    }

    .thumbnail_images ul li {
        margin: 5px;
        padding: 10px;
        border: 2px solid #eee;
        cursor: pointer;
        transition: all 0.5s
    }

    .thumbnail_images ul li:hover {
        border: 2px solid #000
    }

    .main_image {
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #eee;
        height: 400px;
        width: 100%;
        overflow: hidden
    }

    .heart {
        height: 29px;
        width: 29px;
        background-color: #eaeaea;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center
    }

    .content p {
        font-size: 12px
    }

    .ratings span {
        font-size: 14px;
        margin-left: 12px
    }

    .colors {
        margin-top: 5px
    }

    .colors ul {
        list-style: none;
        display: flex;
        padding-left: 0px
    }

    .colors ul li {
        height: 20px;
        width: 20px;
        display: flex;
        border-radius: 50%;
        margin-right: 10px;
        cursor: pointer
    }

    .colors ul li:nth-child(1) {
        background-color: #6c704d
    }

    .colors ul li:nth-child(2) {
        background-color: #96918b
    }

    .colors ul li:nth-child(3) {
        background-color: #68778e
    }

    .colors ul li:nth-child(4) {
        background-color: #263f55
    }

    .colors ul li:nth-child(5) {
        background-color: black
    }

    .right-side {
        position: relative
    }

    .search-option {
        position: absolute;
        background-color: #000;
        overflow: hidden;
        align-items: center;
        color: #fff;
        width: 200px;
        height: 200px;
        border-radius: 49% 51% 50% 50% / 68% 69% 31% 32%;
        left: 30%;
        bottom: -250px;
        transition: all 0.5s;
        cursor: pointer
    }

    .search-option .first-search {
        position: absolute;
        top: 20px;
        left: 90px;
        font-size: 20px;
        opacity: 1000
    }

    .search-option .inputs {
        opacity: 0;
        transition: all 0.5s ease;
        transition-delay: 0.5s;
        position: relative
    }

    .search-option .inputs input {
        position: absolute;
        top: 200px;
        left: 30px;
        padding-left: 20px;
        background-color: transparent;
        width: 300px;
        border: none;
        color: #fff;
        border-bottom: 1px solid #eee;
        transition: all 0.5s;
        z-index: 10
    }

    .search-option .inputs input:focus {
        box-shadow: none;
        outline: none;
        z-index: 10
    }

    .search-option:hover {
        border-radius: 0px;
        width: 100%;
        left: 0px
    }

    .search-option:hover .inputs {
        opacity: 1
    }

    .search-option:hover .first-search {
        left: 27px;
        top: 25px;
        font-size: 15px
    }

    .search-option:hover .inputs input {
        top: 20px
    }

    .search-option .share {
        position: absolute;
        right: 20px;
        top: 22px
    }

    .buttons .btn {
        height: 50px;
        width: 150px;
        border-radius: 0px !important
    }
</style>

<script>
    function changeImage(element) {

        var main_prodcut_image = document.getElementById('main_product_image');
        main_prodcut_image.src = element.src;


    }

</script>

<?php
$product_jpgs = $database->selectProductFiles($anummer);
?>

<body>
    <div class="container mt-5 mb-5" style="background-color:white">
        <div class="card" style="background-color:transparent; border: none; overflow: hidden;">
            <div class="row g-0">
                <div class="col-md-6 border-end">
                    <div class="d-flex flex-column justify-content-center">
                        <div class="main_image"> <img src="<?php echo "products/" . $product_jpgs[0]['FILES']; ?>" id="main_product_image" width="350"> </div>
                        <div class="thumbnail_images">
                            <ul id="thumbnail">
                                <?php foreach ($product_jpgs as $img) : ?>
                                    <li><img onclick="changeImage(this)" src="<?php echo "products/" . $img['FILES'] ?>" width="70"></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 right-side">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3><?php echo $product['BEZEICHNUNG'] ?></h3> <span class="heart"><i class='bx bx-heart'></i></span>
                        </div>
                        <div class="mt-2 pr-3 content">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
                        </div>
                        <h3><?php echo $product['PREIS'] . " €" ?></h3>
                        <div class="ratings d-flex flex-row align-items-center">
                            <div class="d-flex flex-row"> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bxs-star'></i> <i class='bx bx-star'></i> </div> <span>441 reviews</span>
                        </div>
                        <div class="mt-5"> <span class="fw-bold">Color</span>
                            <div class="colors">
                                <ul id="marker">
                                    <li id="marker-1"></li>
                                    <li id="marker-2"></li>
                                    <li id="marker-3"></li>
                                    <li id="marker-4"></li>
                                    <li id="marker-5"></li>
                                </ul>
                            </div>
                        </div>
                        <div class="buttons d-flex flex-row mt-5 gap-3"> <button class="btn btn-outline-dark">Buy Now</button> 
                        <form action="addShoppingCart.php" id="addbasket" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $anummer?>"/>
                            <button type="submit" class="btn btn-dark" name="add_to_card" value="Zum Einkaufswagen hinzufügen">Zum Einkaufswagen hinzufügen</button>
                        </form>
                        </div>
                        <div class="search-option" style="height:125px"> <i class='bx bx-search-alt-2 first-search'></i>
                            <div class="inputs">
                                <form action="searchArticle.php" method="POST">
                                        <input name="productname" type="text" class="form-control input-md">
                                        <input name="productcategory" type="text" class="form-control input-md">
                                        <button type="submit" style="opacity:0" name="searchProduct">
                                </form>
                            </div> <i class='bx bx-share-alt share'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
