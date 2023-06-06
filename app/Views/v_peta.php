<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Candiku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css">
    <!-- Library Font Awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Library CSS -->
    <link rel="stylesheet" href="<?= base_url('awesome-marker/dist/leaflet.awesome-markers.css') ?>">
    <link rel="stylesheet" href="<?= base_url('leaflet-routing-machine/dist/leaflet-routing-machine.css') ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link rel="stylesheet" href="<?= base_url('Leaflet.markercluster-1.4.1/dist/MarkerCluster.css') ?>">
    <link rel="stylesheet" href="<?= base_url('Leaflet.markercluster-1.4.1/dist/MarkerCluster.Default.css') ?>">


    <style>
        /*Tampilan ukuran peta dengan kontainerima*/
        /* .map-container {
            padding-top: 75px;
        } */

        #map {
            /* Untuk tampilan fullscreen dengan navbar
            height tidak bis 100% karena menggunakan boostrap dan html 5 
            Agar tidak skrollinng menggunakan aritmatika*/
            height: calc(100vh - 50px);
            width: 100%;
            margin-top: 50px;
        }
    </style>

</head>

<body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg bg-dark fixed-top " data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('home/index') ?>"><i class="fa-solid fa-gopuram"></i> Candiku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">

                    <!-- Menampilkan button dengan perintah ketika sudah login maka logut, ketika logout login -->
                    <<?php if (auth()->loggedIn()) : ?> <li class="nav-item">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/index') ?>"><i class="fa-solid fa-home"></i> Home</a>
                        </li>
                        <a class="nav-link" aria-current="page" href="<?= base_url('home/input') ?>"><i class="fa-regular fa-square-plus"></i> Input</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/table') ?>"><i class="fa-solid fa-table"></i> Table</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/about') ?>" data-bs-toggle="modal" data-bs-target="#infoModal"><i class="fa-solid fa-address-card"></i> About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="<?= base_url('logout') ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url('home/index') ?>"><i class="fa-solid fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= base_url('home/peta') ?>"><i class="fa-solid fa-map-location-dot"></i> Peta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-primary" href="<?= base_url('login') ?>"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
    <!-- End NavBar -->
    <div id="map"></div>
    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-circle-info"></i>Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <<?php if (auth()->loggedIn()) : ?> <li class="nav-item">
                <div class="modal-body">
                    <!-- Tabel selang seling dengan boostrap-->
                    <table class="table table-stripd table-bordered">
                        <tr>
                            <th>User Name</th>
                            <!-- Menampilkan nama user yang login, dan usernae sebagai objek -->
                            <td><?= auth()->user()->username ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <!-- Menampilkan informasi email user yang login -->
                            <td><?= auth()->user()->email ?></td>
                        </tr>
                        <tr>
                            <th>Registered at</th>
                            <!-- Menampilkan infromasi dibuat -->
                            <td><?= auth()->user()->created_at ?></td>
                        </tr>
                    </table>
                </div>
                <?php else : ?>
                    <li class="nav-item">
                            <a class="nav-link text-primary" href="<?= base_url('login') ?>"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                        </li>
                    <?php endif; ?>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>

    <h1></h1>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-hash/0.2.1/leaflet-hash.min.js"></script>
    <script src="<?= base_url('awesome-marker/dist/leaflet.awesome-markers.js') ?>"></script>
    <script src="<?= base_url('leaflet-routing-machine/dist/leaflet-routing-machine.js') ?>"></script>
    <script src="<?= base_url('leaflet-routing-machine/dist/leaflet-routing-machine.min.js') ?>"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="<?= base_url('Leaflet.markercluster-1.4.1/dist/leaflet.markercluster-src.js') ?>"></script>
    <script>
        /* Initial Map */
        var map = L.map("map").setView([-7.777567, 110.1606899], 10);

        /* Tile Basemap */
        var basemap1 = L.tileLayer(
            "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: '<a href = "https://www.openstreetmap.org/copyright" > OpenStreetMap < /a> | <a href = "https://www.unsorry.net" target = "_blank" > unsorry @2022 < /a>',
            }
        );
        var basemap2 = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
            attribution: 'Google Satellite | <a href="https://unsorry.net" target="_blank">unsorry@2020</a>'
        });
        basemap2.addTo(map);

        /* Display zoom, latitude, longitude in URL */
        let hash = new L.Hash(map);
        /Plugin Routing Machine/
        L.Routing.control({
                position: 'bottomleft',
                showAlternatives: true,
                geocoder: L.Control.Geocoder.nominatim(),
            })
            .on("routesfound", function(e) {
                var routes = e.routes;
                alert("Found " + routes.length + " route(s).");
            })
            .addTo(map);


        /* control layer */
        var baseMaps = {
            "OpenStreetMap": basemap1,
            "Google Satellite": basemap2,
        };
        /* marker cluster */ 
        L.control.layers(baseMaps).addTo(map);


        var markers = L.markerClusterGroup();
        /* GeoJSON Point */
        var point = L.geoJson(null, {
            /*simbologi titik*/
            pointToLayer: function(feature, latlng) {
                var marker = L.marker(latlng, {
                    icon: L.AwesomeMarkers.icon({
                        icon: 'fa-solid fa-gopuram',
                        stylePrefix: 'fas',
                        prefix: 'fa',
                        /*Warna marker*/
                        markerColor: 'orange',
                        /*Warna dalam/ kopi*/
                        iconColor: '#fff'
                    })
                });
            
                return marker;
            },



            onEachFeature: function(feature, layer) {
                /* Popup dan variabel image Url untuk menampilkan gambar sesuai dengan base url */
                var imageUrl = "<?= base_url('/upload/foto/') ?>" + '/' + feature.properties.foto;
                var popupContent = "Nama : " + feature.properties.nama + "<br>" +
                    "Deskripsi : " + feature.properties.deskripsi + "<br><br>" + '<img src=' + imageUrl + ' width="200" height="200">';
                layer.on({
                    click: function(e) {
                        point.bindPopup(popupContent);
                        navigator.geolocation.getCurrentPosition(getPosition)

                        function getPosition(position) {
                            var lat = position.coords.latitude
                            var long = position.coords.longitude
                            L.marker[lat, long],
                                L.Routing.control({
                                    waypoints: [
                                        L.latLng(lat, long),
                                        L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]),
                                    ]
                                }).addTo(map)
                        }
                    },
                    mouseover: function(e) {
                        point.bindTooltip(feature.properties.nama);
                    },
                });
            },
        });
        $.getJSON("<?= base_url("api") ?>", function(data) {
            point.addData(data);
            map.addLayer(point);
            //markerclsuter
            //Add the point layer to the markers layer group
            markers.addLayer(point);
            //Add the markers layer group to the map    
            map.addLayer(markers);
        });
    </script>
</body>

</html>