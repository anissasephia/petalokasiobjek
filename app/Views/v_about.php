<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Candiku</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.7/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
  <!-- Library Font Awsome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .container {
      padding-top: 75px;
    }
  </style>
  <style>
    /* animasi hover */
    .about-box {
      transition: transform 0.3s ease;
    }

    .about-box:hover {
      transform: scale(1.05);
    }
  </style>
</head>

<body class="bg-gradient-to-r from-blue-500 to-purple-500">
  <nav class="navbar bg-dark navbar-expand-lg bg-zinc-900 opacity-80 fixed-top" data-bs-theme="dark">
    <div class="container-fluid px-5">
      <a class="navbar-brand" href="<?= base_url('home/index') ?>"><i class="fa-solid fa-gopuram"></i> Candiku</a>
      <button class="navbar-toggler" id="navButton" onclick="handleClick()" type="button" title="navbarButton" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse collapse" id="navbar">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item text-white hover:disabled">
            <a class="nav-link " page" href="<?= base_url('home/index') ?>">Home</a>
          </li>
          <li class="nav-item text-white">
            <a class="nav-link active " href="<?= base_url('home/about') ?>">About Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="min-h-screen flex items-center justify-center">
    <div class="max-w-md bg-white p-8 shadow-lg rounded-lg about-box">
      <h2 class="text-3xl font-bold mb-4">About Us</h2>
      <p class="text-gray-700 mb-6">Candiku merupakan webiste untuk input data spasial lokasi candi</p>
      <p class="text-gray-700 mb-6"><strong>Email:</strong> <a href="mailto:iniayamkumana@gmail.com">Candiku@gmail.com</a></p>
      <p class="text-gray-700 mb-6"><strong>Address:</strong> Jalan C Simanjutak No .76A, Gondokusuman 55281 Catur tunggal Daerah Istimewa Yogyakarta</p>
    </div>
  </div>
</body>

</html>