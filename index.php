<?php
$quotes = [
    '"Every moment is a fresh beginning." — T.S. Eliot',
    '"Do what you can, with what you have, where you are." — Theodore Roosevelt',
    '"Creativity is intelligence having fun." — Albert Einstein',
    '"Happiness is handmade."',
    '"In a world full of trends, I want to remain a classic."',
    '"The best way to get things done is to begin." — Unknown',
    '"Art is not a thing, it is a way." — Elbert Hubbard',
    '"Made with love and a little bit of yarn."',
    '"The only way to do great work is to love what you do." — Steve Jobs',
    '"Crochet is cheaper than therapy and you get a blanket out of it."'
];

// Pick one at random
$quote = $quotes[array_rand($quotes)];
?>


<?php
   $hour = date("H");
   if ($hour < 12) {
       $greeting = "Good morning!";
   } elseif ($hour < 18) {
       $greeting = "Good afternoon!";
   } else {
       $greeting = "Good evening!";
   }
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>buttoncone</title>
      <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <link rel="stylesheet" href="./assets/css/style.css">
      <link rel="icon" type="image/x-icon" href="./assets/img/buttonconeFav.png">
   </head>
   <body>
      <!-- Navigation Bar -->
      <nav class="navbar navbar-expand-lg fixed-top">
         <div class="container-fluid">
            <a class="navbar-brand me-auto d-flex align-items-center" href="index.php?home_clicked=1">
            <img src="./assets/img/buttonconeLogo.png" alt="Logo" class="navbar-img">
            </a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
               <div class="offcanvas-header">
                  <h5 class="offcanvas-title d-flex align-items-center" id="offcanvasNavbarLabel">
                     <img src="./assets/img/buttonconeLogo.png" alt="Buttoncone Logo">
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
               </div>
               <div class="offcanvas-body">
                  <ul class="navbar-nav ms-auto pe-3">
                     <li class="nav-item">
                        <a class="nav-link active mx-lg-2" aria-current="page" href="index.php?home_clicked=1">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link mx-lg-2" aria-current="page" href="./pages/items/index.php">Items</a>
                     </li>
                  </ul>
               </div>
            </div>
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
         </div>
      </nav>

      <section class="hero-section">
         <div class="scallop-box">
            <div class="scallop-container">
            <h2 class="text-center greeting"><?= $greeting ?></h2>
            <h3 class="hero-txt">Explore our handmade crochet collection — crafted with love and detail</h3>
            </div>
         </div>
      </section>

      <section class="divider-section">
         <div alt="divider" class="divider"></div>
      </section>

      <section class="quote-section">
        <div class="quote-container">
            <?= $quote ?>
        </div>
      </section>

      <section class="about-section">
         <div class="about-container">
            <div>WHO WE ARE</div>
            <div></div>
         </div>
      </section>
      
      <section class="specialties-section">
         <div class="section-title">
            OUR SPECIALTIES
         </div>
      </section>

      <!-- Footer -->
      <footer class="footer">
         <div class="container">
            <footer class="py-5">
               <div class="row">
                  <div class="col-6 col-md-2 mb-3">
                     <ul class="footer flex-column list-unstyled">
                        <li class="footer-item mb-2"><a href="index.php?home_clicked=1" class="footer-link p-0 text-body-secondary">Home</a></li>
                        <li class="footer-item mb-2"><a href="./pages/items/index.php" class="footer-link p-0 text-body-secondary">Items</a></li>
                     </ul>
                  </div>
                  <div class="col-6 col-md-2 mb-3">
                     <h5>Web Designer</h5>
                     <h6>Shane D. Oxina</h6>
                  </div>
                  <div class="col-md-7 offset-md-1 mb-3">
                     <img src="./assets/img/buttonconeLogo.png" alt="Buttoncone Logo">
                  </div>
               </div>
               <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                  <p>Copyright &copy; 2025 buttoncone. All rights reserved.</p>
               </div>
            </footer>
         </div>
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="./assets/js/script.js"></script>
   </body>
</html>