<?php
date_default_timezone_set('Asia/Manila');
$hour = date("H");
if ($hour < 12) {
    $greeting = "Good morning!";
} elseif ($hour < 18) {
    $greeting = "Good afternoon!";
} elseif ($hour >= 18) {
    $greeting = "Good evening!";
}
?>

<?php
$items = [
  ['name' => 'Crochet Cardigan', 'category' => 'clothing', 'img' => './assets/img/crochet-cardigan.jpg'],
  ['name' => 'Bunny Plushie', 'category' => 'plushie', 'img' => './assets/img/crochet-bunny.jpg'],
  ['name' => 'Tulip Bag', 'category' => 'bags', 'img' => './assets/img/crochet-tulip-bag.jpg'],
  ['name' => 'Crochet Hat', 'category' => 'clothing', 'img' => './assets/img/crochet-hat.jpg'],
  ['name' => 'Penguin Plushie', 'category' => 'plushie', 'img' => './assets/img/crochet-penguin.jpg'],
  ['name' => 'Water Lily Bag', 'category' => 'bags', 'img' => './assets/img/crochet-lily.jpg'],
];
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
            <a class="navbar-brand me-auto d-flex align-items-center" href="../../index.php">
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
                        <a class="nav-link mx-lg-2" aria-current="page" href="../../index.php">Home</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link active mx-lg-2" aria-current="page" href="index.php">Items</a>
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
               <div class="greeting-block">
                  <h2 class="text-center greeting"><?= $greeting ?></h2>
               </div>
            <h3 class="hero-txt">Check out our collection</h3>

    <!-- Filter Buttons -->
    <div class="btn-group mb-5" role="group">
      <a href="#clothing" class="btn item-btn clothing-btn">Clothing</a>
      <a href="#plushie" class="btn item-btn plushie-btn">Plushie</a>
      <a href="#bags" class="btn item-btn bags-btn">Bags</a>
    </div>
            </div>
         </div>
      </section>

      <section class="divider-section-2">
         <div alt="divider" class="divider2"></div>
      </section>

      <section class="items-section py-5">
  <div class="container text-center">
    <h2 class="mb-4 display-6 encircled-title">Our Crochet Items</h2>

    <!-- Grouped Items by Category -->
    <?php
    $categories = ['clothing', 'plushie', 'bags'];
    foreach ($categories as $cat):
    ?>
      <div id="<?php echo $cat; ?>" class="mb-5">
        <h3 class="mb-4 text-capitalize"><?php echo $cat; ?></h3>
        <div class="row justify-content-center">
          <?php foreach ($items as $item): ?>
            <?php if ($item['category'] === $cat): ?>
              <div class="col-md-6 col-lg-4 mb-4 d-flex">
                <div class="card w-100 crochet-card shadow-sm">
                  <img src="<?php echo $item['img']; ?>" class="card-img-top" alt="<?php echo $item['name']; ?>">
                  <div class="card-body text-start">
                    <h5 class="card-title"><?php echo $item['name']; ?></h5>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>



   <!-- Footer -->
      <footer class="footer">
         <div class="container">
            <footer class="py-5">
               <div class="row">
                  <div class="col-6 col-md-2 mb-3">
                     <ul class="footer flex-column list-unstyled">
                        <li class="footer-item mb-2"><a href="../../index.php" class="footer-link p-0 text-body-secondary">Home</a></li>
                        <li class="footer-item mb-2"><a href="index.php" class="footer-link p-0 text-body-secondary">Items</a></li>
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