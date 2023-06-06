<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Candiku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

  <!-- Option 1: Include in HTML -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <!-- Library Font Awsome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  <style>
    .collapse.show {
      visibility: visible;
    }

    /* animasi hover */
    .col {
      transition: transform 0.3s ease;
    }

    .col:hover {
      transform: scale(1.05);
    }

    /* backgrorund hero */
    .main-bg {
      background-image: url("https://i.ibb.co/Mk8Z085/4556727.jpg");
      background-size: cover;
      background-position: center;
    }
  </style>
</head>

<body>
  <!-- navbar -->
  <nav class="navbar bg-dark navbar-expand-lg bg-zinc-900 opacity-80 fixed-top" data-bs-theme="dark">
    <div class="container-fluid px-5">
      <a class="navbar-brand" href="<?= base_url('home/index') ?>"><i class="fa-solid fa-gopuram"></i> Candiku</a>
      <button class="navbar-toggler" id="navButton" onclick="handleClick()" type="button" title="navbarButton" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item text-white hover:disabled">
            <a class="nav-link active " page" href="<?= base_url('home/index') ?>">Home</a>
          </li>
          <li class="nav-item text-white">
            <a class="nav-link " href="<?= base_url('home/about') ?>">About Us</a>
          </li>

        </ul>
        <?php if (auth()->loggedIn()) : ?>
          <div class="dropdown">
            <button class="btn btn bg-amber-500 text-white hover:bg-amber-600 rounded-lg dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <?= auth()->user()->username ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item  hover:bg-amber-800" href="<?= base_url('home/input') ?>">Input Data</a></li>
              <li><a class="dropdown-item hover:bg-amber-800" href="<?= base_url('home/table') ?>">Table</a></li>
              <li><a class="dropdown-item hover:bg-amber-800" href="<?= base_url('home/peta') ?>">Peta</a></li>
              <li><a class="dropdown-item text-white bg-amber-600 hover:bg-amber-500 me-2 " href="<?= base_url('logout') ?>">Log Out</a>
            </ul>
          </div>
        <?php else : ?>
          <div class="dropdown">
            <button class="btn btn bg-amber-500 text-white hover:bg-amber-600 rounded-lg dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Register
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item text-white bg-amber-600 hover:bg-amber-500 me-2 " href="<?= base_url('login') ?>">Login</a>
            </ul>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </nav>
  <!-- Hero -->
  <main class="main-bg">
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <h1 class="display-4 fw-normal">CANDIKU</h1>
        <p class="lead fw-normal">Trace the ancient path: Unveiling Indonesia's Candi Treasures with WebGIS</p>
      </div>
      <div class="product-device shadow-sm d-none d-md-block"></div>
      <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
  </main>
  <!-- image with search place -->
  <div class="pt-32 pb-20 px-5 bg-zinc-700">
    <div class="w-full container flex justify-between space-y-3 flex-col lg:space-x-3 lg:space-y-0 lg:flex-row">
      <div class="w-full">
        <input type="text" id="searchInput" class="form-control rounded-lg" placeholder="Search place" aria-label="City" />
      </div>
      <button type="button" id="searchButton" class="w-1/3 btn bg-amber-500 text-white hover:bg-amber-600 rounded-lg">Search<i class="bi bi-search mx-2"></i></i></button>
    </div>
  </div>


  <!-- list places dengan perulangan setiap mengabil dataobjek  -->
  <div class="pb-20 px-5">
    <div class="container">
      <h4 class="font-medium text-2xl mt-5">List Tample</h4>
      <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
        <?php foreach ($dataobjek as $d) : ?>
          <div class="col">
            <div class="card h-[400px] w-full">
              <div class="card-header">
                <h5 class="font-medium text-xl"><?= $d['nama'] ?></h5>
                <span class="text-gray-600 flex items-center space-x-1">

                </span>
              </div>
              <div class="card-body flex flex-column justify-between">
                <div class="row">
                  <div class="col-6">
                    <img src="<?= base_url('upload/foto/') . '/' . $d['foto'] ?>" class="card-img-top" width="100px" alt="...">
                  </div>
                </div>
                <div class="card-text">
                  <p class="line-clamp-2"> <?= $d['deskripsi'] ?></p>
                </div>
                <div class="flex justify-end mt-3 space-x-2">
                  <a type="button" class="btn bg-amber-500 text-white hover:bg-amber-600 " href="<?= base_url('home/peta') ?>#15/<?= $d['latitude'] ?>/<?= $d['longitude'] ?>">View Maps</a>
                </div>
              </div>
              <div class="card-footer text-muted">
                <div class="flex justify-between">
                  <span class="flex space-x-1 items-center">
                    <i class="bi bi-geo-alt"></i>
                    <h7 class="card-text">Latitude : <?= $d['latitude'] ?></h7>
                  </span>
                  <span class="flex space-x-1 items-center">
                    <i class="bi bi-geo-alt"></i>
                    <h7 class="card-text">Longitude : <?= $d['longitude'] ?></h7>
                  </span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <!-- footer -->
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
      <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
          <svg class="bi" width="30" height="24">
            <use xlink:href="#bootstrap"></use>
          </svg>
        </a>
        <span class="mb-3 mb-md-0 text-muted">© 2023 Company, Inc</span>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>

    <script>
      const element = document.getElementById("navbar");
      const navButton = document.getElementById("navButton");

      const handleClick = (event) => {
        navButton.classList.toggle('collapsed')
        element.classList.toggle("show");
        let x = navButton.getAttribute("aria-expanded");
        if (x == "true") {
          x = "false"
        } else {
          x = "true"
        }
        navButton.setAttribute("aria-expanded", x);
      }

      function updateSize() {
        if (window.innerWidth <= 980) {
          element.classList.remove('show')
        } else {
          element.classList.add('show')
        }
      }

      window.addEventListener("resize", updateSize);

      document.addEventListener('click', handleClick());
    </script>
    <script>
      document.getElementById("searchButton").addEventListener("click", function() {
        var searchInput = document.getElementById("searchInput").value.toLowerCase();
        var cards = document.getElementsByClassName("card");

        for (var i = 0; i < cards.length; i++) {
          var card = cards[i];
          var searchPlace = card.getElementsByClassName("font-medium text-xl")[0].textContent.toLowerCase();


          if (searchPlace.includes(searchInput)) {
            //jika terpenuhi display block akan tertampil
            card.style.display = "block";
          } else {
            card.style.display = "none";
          }
        }
      });
    </script>

</body>

</html>