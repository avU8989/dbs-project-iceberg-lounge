<?php
include("header.php");
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

<body>
    <!-- Features section-->
    <section class="py-5 border-bottom" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">

                <div class="col-lg-6 col-xl-4">
                    <h2 class="h4 fw-bolder">Neu erhältlich</h2>
                    <p>Der Winter hat viel zu bieten. Idyllische, schneebedeckte Landschaften, klare, frische Luft und ein gemütlicherer, oftmals entschleunigter Alltag zeichnen ihn aus. Gleichzeitig bietet die Jahreszeit zahlreiche Möglichkeiten für sportliche Betätigungen.</p>
                    <div class="card mb-5 mb-xl-0" style="height:500px">
                        <div class="hero2-image">
                            <div class="card-body p-5">
                                <div class="mb-3">
                                    <img src="products/Trab-Gavia-85-Ride-10-Stelvio-85-B103704-00-320836.jpg" style="width:90%;height:400px; opacity:0">
                                </div>
                                <div class="d-grid"> <a class="text-center" style="color:white" href="https://wwwlab.cs.univie.ac.at/~vua36/bestseller.php">
                                        Jetzt entdecken
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-4">
                    <h2 class="h4 fw-bolder">Bestseller</h2>
                    <p>Sie rasen auf zwei wackeligen Brettern einen schneebedeckten, 2.000 Meter hohen Berg herunter. Was könnte da schon schief gehen? Damit sie heil und sicher unten ankommen, sollten Sie bei der Abfahrt mit der richtigen Ausrüstung stehen.</p>
                    <div class="card mb-5 mb-xl-0" style="height:500px">
                        <div class="hero3-image">
                            <div class="card-body p-5">
                                <div class="mb-3">
                                    <img src="products/Trab-Gavia-85-Ride-10-Stelvio-85-B103704-00-320836.jpg" style="width:90%;height:400px; opacity:0">
                                </div>
                                <div class="d-grid"> <a class="text-center" style="color:white" href="https://wwwlab.cs.univie.ac.at/~vua36/bestseller.php">
                                        Jetzt entdecken
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-xl-4">
                    <?php if (is_checked_in()) : ?>
                        <h2 class="h4 fw-bolder">Für dich empfohlen</h2>

                        <p>Angepasst an deinen vergangenen Käufen</p>
                        <div class="card mb-5 mb-xl-0" style="height: 500px">
                            <div class="hero4-image">
                                <div class="card-body p-5">
                                    <div class="mb-3">
                                        <img src="products/Trab-Gavia-85-Ride-10-Stelvio-85-B103704-00-320836.jpg" style="width:90%;height:400px; opacity:0">
                                    </div>
                                    <div class="d-grid"> <a class="text-center" style="color:white" href="#!">
                                            Jetzt entdecken
                                            <i class="bi bi-arrow-right"></i>
                                        </a></div>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <h2 class="h4 fw-bolder">Die besten Tipps für den Schneeschuhkauf</h2>
                        <p>Eine Schneeschuh-Ausrüstung ist zwar im Vergleich mit anderen Wintersportarten kostengünstig in der Anschaffung, stellt aber natürlich trotzdem einen gewissen finanziellen Aufwand dar.</p>
                        <div class="card mb-5 mb-xl-0" style="height: 500px">
                            <div class="hero5-image">
                                <div class="card-body p-5">
                                    <div class="mb-3">
                                        <img src="products/Trab-Gavia-85-Ride-10-Stelvio-85-B103704-00-320836.jpg" style="width:90%;height:400px; opacity:0">
                                    </div>
                                    <div class="d-grid"> <a class="text-center" style="color:white" href="#!">
                                            Jetzt entdecken
                                            <i class="bi bi-arrow-right"></i>
                                        </a></div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>


            </div>
        </div>
    </section>

    <!-- Pricing section-->
    <section class="bg-light py-5 border-bottom">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h2 class="fw-bolder">Top-Angebot</h2>
                <p class="lead mb-0">Top Angebote, Blitzangebote und Aktionen</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <!-- Pricing card free-->
                <div class="col-lg-6 col-xl-4">
                    <div class="card mb-5 mb-xl-0">
                        <div class="card-body p-5">
                            <div class="small text-uppercase fw-bold text-muted">MARTINI CRISTALLO Wanderjacke</div>
                            <div class="mb-3">
                                <img src="https://www.hervis.at/medias/sys_master/images/images/h1d/h5f/17415004061726/Martini-CRISTALLO-Da-3103251-00-401643.jpg" alt="Top seller" width="100%">
                                <span class="display-4 fw-bold">€ 249,90</span>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    <strong>Primaloft® Gold Wattierung im Frontbereich</strong>
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    2-Wege Frontzipp
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    2 Eingrifftaschen mit Zipp
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    elastische Einfassung an Kapuze
                                </li>
                                <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                    atmungsaktiv
                                </li>
                                <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                    feuchtigkeitsableitend
                                </li>
                                <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                    bietet optimale Bewegungsfreiheit
                                </li>
                                <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                    geringes Packmaß
                                </li>
                            </ul>
                            <div class="d-grid"><a class="btn btn-outline-primary" href="#!">Zum Einkaufswagen hinzufügen</a></div>
                        </div>
                    </div>
                </div>
                <!-- Pricing card pro-->
                <div class="col-lg-6 col-xl-4">
                    <div class="card mb-5 mb-xl-0">
                        <div class="card-body p-5">
                            <div class="small text-uppercase fw-bold">
                                <i class="bi bi-star-fill text-warning"></i>
                                MAMMUT AENERGY PANTS
                            </div>
                            <div class="mb-3">
                                <img src="https://www.hervis.at/medias/sys_master/images/images/hda/hfc/17466414596126/Mammut-Aenergy-IN-Hybrid-Pants-3074895-00-404234.jpg" alt="Top seller" style="width:278px; height:423px">
                                <span class="display-4 fw-bold">€ 184,99</span>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    <strong>Hybride Stoffkombination für optimale Performance</strong>
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Taillenbundverstellung
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Beinabschluss mit Zwickel
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    leicht
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    wind- und wasserabweisend
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    schnelltrocknend
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    atmungsaktiv
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Fair Wear
                                </li>
                            </ul>
                            <div class="d-grid"><a class="btn btn-primary" href="#!">Zum Einkaufswagen hinzufügen</a></div>
                        </div>
                    </div>
                </div>
                <!-- Pricing card enterprise-->
                <div class="col-lg-6 col-xl-4">
                    <div class="card">
                        <div class="card-body p-5">
                            <div class="small text-uppercase fw-bold text-muted">Transalp 82 inkl. Alpinst 8</div>
                            <div class="mb-3">
                                <img src="https://www.hervis.at/medias/sys_master/images/images/h25/hfd/26950141345822/Fischer-Transalp-82-Alpinst-8-Transalp-82-B949730-00-437366.jpg" alt="Top seller" style="width:278px; height:423px">
                                <span class="display-4 fw-bold">€ 809,99</span>
                            </div>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    <strong>Carbon-verstärkter Vorderbacken</strong>
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    schnürbarer Innenschuh
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Holzkern
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    BOA® Fit System
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Sonstiges Bindung: 1400g bei Gr. 26,5
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    Schuhtyp: Touring-Pin
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check text-primary"></i>
                                    ALPINIST heel - U-bow soft,
                                </li>
                                <li class="mb-2">
                                <i class="bi bi-check text-primary"></i>
                                    geringes Packmaß
                                </li>
                            </ul>
                            <div class="d-grid"><a class="btn btn-outline-primary" href="#!">Zum Einkaufswagen hinzufügen</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <!-- Testimonials section-->
    <section class="py-5 border-bottom">
        <div class="container px-5 my-5 px-5">
            <div class="text-center mb-5">
                <h2 class="fw-bolder">Kundenrezensionen</h2>
                <p class="lead mb-0">Erlebe jetzt die besten Momente unserer Kunden in der Alpinen Welt.</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-6">
                    <!-- Testimonial 1-->
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                                <div class="ms-4">
                                    <p class="mb-1">Der von uns gewünschte Skihelm war in der Filiale in Liezen nicht mehr lagernd, die Verkäuferin war sehr freundlich und hat sofort nachgesehen, ob er online verfügbar ist und hat ihn dann für uns bestellt. Hat alles gut geklappt, haben den Helm noch rechtzeitig vor Weihnachten erhalten.</p>
                                    <div class="small text-muted">- Client Name, Location</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonial 2-->
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="d-flex">
                                <div class="flex-shrink-0"><i class="bi bi-chat-right-quote-fill text-primary fs-1"></i></div>
                                <div class="ms-4">
                                    <p class="mb-1">Kostenloser Versand bei Abholung im Shop, gute Preise, Tolles Personal. Zudem hatte ich einmal etwas falsches als Zusatz zu einem Produkt bestellt und ohne etwas zu sagen, haben sie dennoch, das richtige montiert. Zwar musste ich die Differenz zahlen, aber dafür war es Top.</p>
                                    <div class="small text-muted">- Client Name, Location</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php include ("footer.php") ?>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

    <?php include("popup.php")?>

</body>

</html>