<?php
include('addShoppingCart.php');
$products = array();

$products = array();
$subtotal = 0.00;
$items = 0;
// If there are products in cart
$product_list = array(array());
if (isset($_SESSION['shoppingCart'])) {

  // Fetch the products from the database and return the result as an Array
  $ids = $database->selectProductIdsFromShoppingCart($_SESSION['customer_id']);
  $help = $database->selectProductsFromShoppingCart($_SESSION['customer_id']);
  foreach ($ids as $id) {
    array_push($products, $database->selectProductByID($id['ARTIKELNUMMER_FK']));
  }

  for ($i = 0; $i < sizeof($help); ++$i) {
    $product_list[$help[$i]['ARTIKELNUMMER_FK']][] = $help[$i]['MENGE'];
  }

  // Calculate the subtotal
  foreach ($products as $product) {
    $subtotal += (float)$product['PREIS'] * (int)$product_list[$product['ARTIKELNUMMER']][0];
  }

  foreach ($products as $product) {
    $items += (int)$product_list[$product['ARTIKELNUMMER']][0];
  }
}
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
  body {
    background: url("background3.jpg");
    min-height: 100vh;
    vertical-align: middle;
    display: flex;
    font-family: sans-serif;
    font-size: 0.8rem;
    font-weight: bold;
  }

  .title {
    margin-bottom: 5vh;
  }

  .card {
    margin: auto;
    max-width: 950px;
    width: 90%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 1rem;
    border: transparent;
  }

  @media(max-width:767px) {
    .card {
      margin: 3vh auto;
    }
  }

  .cart {
    background-color: #fff;
    padding: 4vh 5vh;
    border-bottom-left-radius: 1rem;
    border-top-left-radius: 1rem;
  }

  @media(max-width:767px) {
    .cart {
      padding: 4vh;
      border-bottom-left-radius: unset;
      border-top-right-radius: 1rem;
    }
  }

  .summary {
    background-color: #ddd;
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
    padding: 4vh;
    color: rgb(65, 65, 65);
  }

  @media(max-width:767px) {
    .summary {
      border-top-right-radius: unset;
      border-bottom-left-radius: 1rem;
    }
  }

  .summary .col-2 {
    padding: 0;
  }

  .summary .col-10 {
    padding: 0;
  }

  .row {
    margin: 0;
  }

  .title b {
    font-size: 1.5rem;
  }

  .main {
    margin: 0;
    padding: 2vh 0;
    width: 100%;
  }

  .col-2,
  .col {
    padding: 0 1vh;
  }

  a {
    padding: 0 1vh;
  }

  .close {
    margin-left: auto;
    font-size: 0.7rem;
  }

  img {
    width: 3.5rem;
  }

  .back-to-shop {
    margin-top: 4.5rem;
  }

  h5 {
    margin-top: 4vh;
  }

  hr {
    margin-top: 1.25rem;
  }

  form {
    padding: 2vh 0;
  }

  select {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
  }

  input {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
  }

  input:focus::-webkit-input-placeholder {
    color: transparent;
  }

  .btn {
    background-color: #000;
    border-color: #000;
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 0;
  }

  .btn:focus {
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none;
  }

  .btn:hover {
    color: white;
  }

  a {
    color: black;
  }

  a:hover {
    color: black;
    text-decoration: none;
  }

  #code {
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center;
  }
</style>

<script>
  function redirectHomePage() {
    location.replace("https://wwwlab.cs.univie.ac.at/~vua36/logged_in.php");
  }
</script>

<body>
  <div class="card">
    <div class="row">
      <div class="col-md-8 cart">
        <div class="title">
          <div class="row">
            <div class="col">
              <h4><b>Shopping Cart</b></h4>
            </div>
            <div class="col align-self-center text-right text-muted">
              <?php if (empty($products)) : ?>
                <tr>
                  <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                </tr>
              <?php else : ?>
                <tr>
                  <td colspan="5" style="text-align:center;"><?php echo $items . ' items'; ?></td>
                </tr>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <?php foreach ($products as $product) : ?>
          <div class="row border-top border-bottom">
            <div class="row main align-items-center">
              <?php $product_images = $database->selectProductFiles($product['ARTIKELNUMMER']); ?>
              <div class="col-2"><img class="img-fluid" src="products/<?php echo $product_images[0]['FILES'] ?>"></div>
              <div class="col">
                <div class="row text-muted"><?php echo $product['TYP'] ?></div>
                <div class="row"><?php echo $product['BEZEICHNUNG'] ?></div>
              </div>
              <div class="col">
                <div class="btn-group">
                  <form action="deleteProductFromShoppingCart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['ARTIKELNUMMER'] ?>" />
                    <button type="submit" name="delete_from_card" value="delete_from_card" class="border">-</button>
                  </form>
                  <a href="#" class="border" style="height:100%; width:100%; display-block:inline;"><?php echo (int)$product_list[$product['ARTIKELNUMMER']][0] ?></a>
                  <form action="addShoppingCart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['ARTIKELNUMMER'] ?>" />
                    <button type="submit" name="add_to_card" value="add_to_card" class="border">+</button>
                  </form>
                </div>
              </div>
              <div class="col">&euro; <?php echo $product['PREIS'] ?>
                <form action="deleteProduct.php" style="display:inline;" method="POST">
                  <input type="hidden" name="product_id" value="<?php echo $product['ARTIKELNUMMER'] ?>" />
                  <button type="submit" name="delete_from_card" value="delete_from_card" class="btn" style="margin-top:0%; display:inline; width:30%; background-color:transparent; border-style:none; color:black ">&#10005;</button>
                </form>
              </div>
            </div>
          </div>
        <?php endforeach; ?>

        <div class="back-to-shop"><a href="https://wwwlab.cs.univie.ac.at/~vua36/logged_in.php">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
      </div>
      <div class="col-md-4 summary">
        <div>
          <h5><b>GESAMT</b></h5>
        </div>
        <hr>
        <div class="row">
          <div class="col" style="padding-left:0;">ITEMS <?php echo $items ?></div>
          <div class="col text-right">&euro;<?php echo $subtotal ?></div>
        </div>
        <form>
          <p>LIEFERUNG</p>
          <select>
            <option class="text-muted">Standard-Delivery- &euro;5.00</option>
          </select>
          <p>CODE EINGEBEN</p>
          <input id="code" placeholder="Enter your code">
        </form>
        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
          <div class="col">GESAMTPREIS</div>
          <div class="col text-right">&euro;<?php echo $subtotal + 5 ?></div>
        </div>
        <form action="addOrder.php" method="POST">
          <input type="hidden" name="code" value="code"/>
          <button type="submit" name="add_to_order" value="add_to_order" class="btn btn-primary" style="border-radius: 25px;">CHECKOUT</button>
        </form>
      </div>
    </div>

  </div>
</body>

</html>