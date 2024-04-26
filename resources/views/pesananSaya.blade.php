<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pesanan Saya - Gaskeun</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('img/favicon.png') }}"/>

    <script src="https://kit.fontawesome.com/98e80d3b36.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/pesananSaya.css') }}" rel="stylesheet">
  </head>
  <body>
    <!-- Navbar -->
    <div>
      <nav class="navbar navbar-expand-lg fixed-top bg-navbar">
        <div class="container">
          <a class="navbar-brand" href="{{ url("/") }}">
            <img src="{{ asset('img/logo-navbar.png') }}" alt="Gaskeun Logo" height="35" />
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-nav-scroll ms-auto mb-2 mb-lg-0">
              <li class="nav-item mx-2">
                <a class="nav-link" href="{{ url("/") }}">Beranda</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link active" href="#" aria-current="page">Pemesanan</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Pesanan Saya</a>
              </li>
              <li class="nav-item ms-2 me-4">
                <a class="nav-link" href="{{ route('login') }}">Sign In</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>    

    <!-- Filter Title -->
    <div class="container">
      <div class="row"> 
        <h2 class="mb-0">Riwayat pesanan</h2>
        <p class="mb-0">Hubungi kami jika Anda memiliki pertanyaan.</p>
      </div>
    </div>
 
    <div class="container" id="historyCard">
      <div class="row">
        <div class="col-12 pt-4">
          <div class="card shadow bg-white">
            <div class="row">
            <div class="col-md-12 col-lg-3 col-xl-3">
              <img class="img-fluid img-cover" src="{{ asset('img/car-zenix-dummyFilter.jpg') }}" alt="Car Image">
            </div>
            <div class="col-md-6 col-lg-5 col-xl-5 px-4">
              <h5 class="card-title fw-semibold fs-2 pt-3">Toyota Zenix</h5>
              <div style="display: flex;" class="pt-2">
                <div style="width: 40px;"><i class="fa-solid fa-users"></i></div>
                <p class="fw-medium">D 1111 CAS</p>
              </div>
              <div style="display: flex;" class="mb-0">
                <div style="width: 40px;"><i class="fa-solid fa-gear"></i></div>
                <p class="fw-medium">Matic</p>
              </div>
              <div style="display: flex;" class="pb-3">
                <div style="width: 40px;"><i class="fa-solid fa-gas-pump"></i></div>
                <p class="fw-medium mb-0">Bensin</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-4 px-4">
              <table>
                <tr>
                  <td>Ambil</td>
                  <td>: DD-MM-YYYY</td>
                </tr>
                <tr>
                  <td>Balik</td>
                  <td>: DD-MM-YYYY</td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td>: Rp.XXX.XXX</td>
                </tr>
              </table>
              
              <!-- If status pembayaran is paid -->
              <!-- <div class="d-grid mt-3">
                <button
                  type="button"
                  class="btn button-36"
                >
                  <a href="" style="text-decoration: none; color: white">
                    Pesan Lagi
                  </a>
                </button>
              </div> -->

              <!-- If status pembayaran is unpaid -->
              <div class="d-flex align-items-center justify-content-center unpaid bg-danger text-white mt-3">
                Belum dibayar
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  </body>
</html>