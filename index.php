<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buttoncone</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="./assets/img/buttonconeFavicon.png">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
           <a class="navbar-brand me-auto d-flex align-items-center" href="index.html">
           <img src="./assets/img/" alt="Logo" class="navbar-img">
           </a>
           <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
              <div class="offcanvas-header">
                 <h5 class="offcanvas-title d-flex align-items-center" id="offcanvasNavbarLabel">
                    <img src="./assets/img/" alt="Buttoncone Logo">
                 </h5>
                 <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                 <ul class="navbar-nav ms-auto pe-3">
                    <li class="nav-item">
                       <a class="nav-link active mx-lg-2" aria-current="page" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                       <a class="nav-link mx-lg-2" aria-current="page" href="">Items</a>
                    </li>
                 </ul>
              </div>
           </div>
           <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
           </button>
        </div>
     </nav>

    <div class="scallop-box">
        <p>Inside the wavy box!</p>
    </div>


</body>
</html>