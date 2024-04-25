<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/booking.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/favicon.png') }}"/>
    <script src="https://kit.fontawesome.com/98e80d3b36.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Navbar -->
    <div>
      <nav class="navbar navbar-expand-lg fixed-top bg-navbar">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="{{ asset('img/logo-navbar.png') }}" alt="Gaskeun Logo" height="35" />
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-nav-scroll ms-auto mb-2 mb-lg-0">
              <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('index') }}">Beranda</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Mobil Kami</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link active" href="#" aria-current="page">Pemesanan</a>
              </li>
              @auth
              <li class="nav-item mx-2">
                <form action="/logout" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-danger">Logout</button>
                </form>
              </li>
              @else
              <li class="nav-item ms-2 me-4">
                <a class="nav-link" href="{{ route('login') }}">Sign In</a>
              </li>
              @endauth
            </ul>
          </div>
        </div>
      </nav>
    </div>
    

    <div class="container mt-5">
        <h2 class="row p-3">Mobil Kamu</h2>

        <div class="row mx-2">
            <div class="col">
                <img id="car-image" src="{{ asset('img/car-zenix.png') }}" alt="" class="img-fluid">
            </div>
            <div class="col d-flex align-items-center p-0">
                <div class="container p-4 flex-grow-1 my-4">
                    <h3>Innova</h3>
                    <p>Fitur mobil:</p>
                    <p>Berkapasitas 1998 cc, serta Diesel 2393 cc. Kijang Innova tersedia dengan transmisi Manual, konsumsi BBM Kijang Innova mencapai 9.7 kmpl untuk perkotaan, 13.6 kmpl saat menjelajah perjalanan luar kota. Kijang Innova adalah MPV 7 seater dengan panjang 4735 mm, lebar 1830 mm, wheelbase 2750 mm.</p>
                        
                    <div style="display: block;">
                        <i class="fa-solid fa-users"></i>
                        <p style="
                        display: inline;
                        margin-left: 8px;
                        font-weight: bold;
                        ">4 orang</p>
                    </div>

                    <div style="display: block;">
                        <i class="fa-solid fa-gear"></i>
                        <p style="
                        display: inline;
                        margin-left: 8px;
                        font-weight: bold;
                        ">Manual</p>
                    </div>
                        
                    <div style="display: block;">
                        <i class="fa-solid fa-gas-pump"></i>
                        <p style="
                        display: inline;
                        margin-left: 8px;
                        font-weight: bold;
                        ">Bensin</p>
                    </div>
                </div>
            </div>

            <div class="container p-4 custom-shadow flex-grow-1 mt-4">
                <h3>Syarat dan Ketentuan</h3>
                    <ul class="mt-3">
                        <li>Wajib berusia minimal 21 tahun dan memiliki SIM A yang masih berlaku.</li>
                        <li>Menunjukkan KTP dan SIM asli saat pengambilan mobil.</li>
                        <li>Memberikan deposit sebagai jaminan keamanan.</li>
                        <li>Bertanggung jawab atas kerusakan mobil selama masa sewa.</li>
                        <li>Mematuhi peraturan lalu lintas yang berlaku.</li>
                        <li>Pemesanan dapat dilakukan melalui website dan aplikasi.</li>
                        <li>Pembayaran sewa dilakukan secara offline.</li>
                        <li>Penyewa bertanggung jawab atas segala kerusakan yang terjadi pada mobil selama masa sewa.</li>
                        <li>Rental mobil tidak bertanggung jawab atas kehilangan barang bawaan penyewa.</li>
                    </ul>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Saya menyetujui semua Syarat & Ketentuan yang berlaku
                        </label>
                    </div>
            </div>
        </div>


        <!--
        <div class="row justify-content-between">
            <div class="col p-0 mx-3 d-flex flex-column">
                <img src="{{ asset('img/car-zenix.png') }}" alt="" class="img-fluid">
                <div class="container p-4 custom-shadow flex-grow-1" style="border: 2px solid #979797;">
                    <h3>Innova</h3>
                    <p>Fitur mobil:</p>
                    <p>Berkapasitas 1998 cc, serta Diesel 2393 cc. Kijang Innova tersedia dengan transmisi Manual, konsumsi BBM Kijang Innova mencapai 9.7 kmpl untuk perkotaan, 13.6 kmpl saat menjelajah perjalanan luar kota. Kijang Innova adalah MPV 7 seater dengan panjang 4735 mm, lebar 1830 mm, wheelbase 2750 mm.</p>
                    
                    <div style="display: block;">
                        <i class="fa-solid fa-users"></i>
                        <p style="
                        display: inline;
                        margin-left: 8px;
                        font-weight: bold;
                        ">4 orang</p>
                    </div>

                    <div style="display: block;">
                        <i class="fa-solid fa-gear"></i>
                        <p style="
                        display: inline;
                        margin-left: 8px;
                        font-weight: bold;
                        ">Manual</p>
                    </div>
                    
                    <div style="display: block;">
                        <i class="fa-solid fa-gas-pump"></i>
                        <p style="
                        display: inline;
                        margin-left: 8px;
                        font-weight: bold;
                        ">Bensin</p>
                    </div>

                </div>
            </div>


            <div class="col p-0 mx-3 mt-4 d-flex flex-column">
                <div class="container p-4 custom-shadow" style="border: 2px solid #979797;">
                    <h3>Syarat dan Ketentuan</h3>
                    <ul class="mt-3">
                        <li>Wajib berusia minimal 21 tahun dan memiliki SIM A yang masih berlaku.</li>
                        <li>Menunjukkan KTP dan SIM asli saat pengambilan mobil.</li>
                        <li>Memberikan deposit sebagai jaminan keamanan.</li>
                        <li>Bertanggung jawab atas kerusakan mobil selama masa sewa.</li>
                        <li>Mematuhi peraturan lalu lintas yang berlaku.</li>
                        <li>Pemesanan dapat dilakukan melalui website dan aplikasi.</li>
                        <li>Pembayaran sewa dilakukan secara offline.</li>
                        <li>Penyewa bertanggung jawab atas segala kerusakan yang terjadi pada mobil selama masa sewa.</li>
                        <li>Rental mobil tidak bertanggung jawab atas kehilangan barang bawaan penyewa.</li>
                    </ul>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Saya menyetujui semua Syarat & Ketentuan yang berlaku
                        </label>
                    </div>
                </div>

                <div class="container p-5 custom-shadow flex-grow-1 mt-4" style="border: 2px solid #979797;">
                    Unggah KTP dan SIM anda
                </div>
            </div>
            

        </div>
        -->

        <div class="d-flex justify-content-center my-5">
            <button type="button" class="button-36 btn-block" id="gas-button" disabled>GASS!</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/booking.js') }}"></script>
</body>
</html>