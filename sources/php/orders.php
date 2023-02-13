<?php
include("DatabaseHelper.php");
include("login.php");
$database = new DatabaseHelper();
$orders = $database->selectOrders($_SESSION['customer_id']);
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
  .gradient-custom {
    /* fallback for old browsers */
    background: whitesmoke;
  }
</style>

<body>
  <?php include("header.php") ?>
  <section class="h-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-10 col-xl-8">
          <div class="card" style="border-radius: 10px;">
            <div class="card-header px-4 py-5" style="background-color:transparent">
              <h5 style="color:black">Meine Bestellungen</h5>
              <div class="row d-flex align-items-center">
                <div class="col-md-10">
                  <div class="d-flex justify-content-around mb-1">
                    <a href="" class="text-muted mt-1 mb-0 small ms-xl-5" style="font-weight:600; font-size: 12px;">Bestellungen</a>
                    <a href="" class="text-muted mt-1 mb-0 small ms-xl-5" style="font-weight:600; font-size: 12px;">Nochmals kaufen</a>
                    <a href="" class="text-muted mt-1 mb-0 small ms-xl-5" style="font-weight:600; font-size: 12px;">Noch nicht versandt</a>
                    <a href="" class="text-muted mt-1 mb-0 small ms-xl-5" style="font-weight:600; font-size: 12px;">Stornierte Bestellungen</a>
                  </div>
                </div>
              </div>
            </div>

            <?php foreach ($orders as $order) :
              $products = array();
              $subtotal = 0.00;
              $items = 0;
              $product_list = array(array());
              $ordered_products = $database->selectProductFromOrderedItems($order['BESTELLNUMMER']);
              $ids = $database->selectProductIdsFromOrderedItems($order['BESTELLNUMMER']);
              $help = $database->selectPersonIdFromCustomer($_SESSION['customer_id']);
              $person = $database->selectPerson($help['PERSON_ID']);
              foreach ($ids as $id) {
                array_push($products, $database->selectProductByID($id['ARTIKELNUMMER_FK']));
              }

              for ($i = 0; $i < sizeof($ordered_products); ++$i) {
                $product_list[$ordered_products[$i]['ARTIKELNUMMER_FK']][] = $ordered_products[$i]['MENGE'];
              }

              // Calculate the subtotal
              foreach ($products as $product) {
                $subtotal += (float)$product['PREIS'] * (int)$product_list[$product['ARTIKELNUMMER']][0];
              }

              foreach ($products as $product) {
                $items += (int)$product_list[$product['ARTIKELNUMMER']][0];
              }
            ?>
              <div class="card shadow-0 border mb-4">
                <div class="card-body p-4">
                  <div class="row d-flex align-items-center">
                    <div class="col-md-10">
                      <table>
                        <tr>
                          <th class="text-muted mt-1 mb-0 small ms-xl-5" style="padding:10px">BESTELLDATUM</th>
                          <th class="text-muted mt-1 mb-0 small ms-xl-5" style="padding:10px">SUMME</th>
                          <th class="text-muted mt-1 mb-0 small ms-xl-5" style="padding:10px">VERSANDADRESSE</th>
                          <th class="text-muted mt-1 mb-0 small ms-xl-5" style="padding:10px">BESTELLNR</th>
                          <th class="text-muted mt-1 mb-0 small ms-xl-5" style="padding:10px; font-weight:600;"><a href="" style="font-weight:600;">Bestelldetails anzeigen</a></th>
                        </tr>
                        <tr>
                          <th class="text-muted mt-1 mb-0 small ms-xl-5" style="padding:10px"><?php echo $order['BESTELLDATUM'] ?></th>
                          <th class="text-muted mt-1 mb-0 small ms-xl-5" style="padding:10px"><?php echo $subtotal ?></th>
                          <th class="text-muted mt-1 mb-0 small ms-xl-5" style="padding:10px"><?php echo $person['STRASSE'] ?></th>
                          <th class="text-muted mt-1 mb-0 small ms-xl-5" style="padding:10px"><?php echo $order['BESTELLNUMMER'] ?></th>
                        </tr>
                      </table>
                     
                    </div>
                  </div>
                  <?php
                  foreach ($products as $product) :
                  ?>
                    <div class="card-body">
                      <div class="row" style="width:604px; height: 100px">
                        <?php $product_images = $database->selectProductFiles($product['ARTIKELNUMMER']); ?>
                        <div class="col-md-2">
                          <img src="products/<?php echo $product_images[0]['FILES'] ?>" class="img-fluid" style="height:75px; width:75.81px">
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center" style="width:180px; height:100px;">
                          <p class="text-muted mb-0 small" style="clear: both; display: inline-block; overflow: hidden; white-space: nowrap;"><?php echo $product['BEZEICHNUNG'] ?></p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                          <p class="text-muted mb-0 small"><?php echo $product['TYP'] ?></p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                          <p class="text-muted mb-0 small">Menge: <?php echo (int)$product_list[$product['ARTIKELNUMMER']][0] ?></p>
                        </div>
                        <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                          <p class="text-muted mb-0 small">&euro; <?php echo $product['PREIS'] ?></p>
                        </div>
                      </div>
                      <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
                    </div>
                  <?php endforeach; ?>


                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php include("footer.php") ?>
</body>

</html>