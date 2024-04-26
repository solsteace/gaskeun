<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pilih Mobil - Gaskeun</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@14.6.4/distribute/nouislider.min.css">
    <link rel="stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('img/favicon.png') }}"/>

    <script src="https://kit.fontawesome.com/98e80d3b36.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/filterCar.css') }}" rel="stylesheet">
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
        <h2 class="mb-0">Pemilihan mobil</h2>
        <p class="mb-0">Silahkan isi kriteria mobil yang Anda inginkan</p>
      </div>
    </div>

    <!-- Filter Form -->
    <div class="container mt-3">
      <div class="card shadow-sm px-4 bg-white">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
            <label for="start-date">Tanggal Ambil</label>
            <div class="input-group mt-1">
              <div class="input-group-text p-1" id="icon-start"><i class="las la-calendar-check"></i></div>
              <input type="text" id="start-date" class="form-control">
            </div>
            <div class="invalid-date text-bg-danger rounded ps-2 py-1" id="invalid-date" style="display: none;">
              Tanggal ambil harus sebelum tanggal kembali
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
            <label for="end-date">Tanggal Kembali</label>
            <div class="input-group mt-1">
              <div class="input-group-text p-1" id="icon-end"><i class="las la-calendar-times"></i></div>
              <input type="text" id="end-date" class="form-control">
            </div>
            <div class="invalid-date text-bg-danger rounded ps-2 py-1" style="display: none;">
              Tanggal kembali harus setelah tanggal kembali
            </div>
          </div>
          <div class="col-md-12 col-lg-12 col-xl-4 pt-3">
            <label for="harga-mobil">Harga Mobil (per hari)</label>
            <div id="harga-mobil" class="mt-2"></div>
            <div class="row pb-0">
              <div class="col pt-3 input-group">
                <div class="input-group-text">Rp</div>
                <input type="number" id="harga-mobil-min" class="form-control">
              </div>
              <div class="col pt-3 input-group">
                <div class="input-group-text">Rp</div>
                <input type="number" id="harga-mobil-max" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-lg-4 col-xl-4 pt-3">
            <label for="jumlah-penumpang">Jumlah Penumpang (minimum)</label>
            <div class="input-group mt-1">
              <div class="input-group-text p-1"><i class="las la-user-friends"></i></div>
              <select id="jumlah-penumpang" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8" selected>8</option>>
              </select>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-xl-4 pt-3">
            <label for="transmisi">Transmisi</label>
            <div class="input-group mt-1">
              <div class="input-group-text p-1"><i class="las la-cog"></i></div>
              <select id="transmisi" class="form-select">
                <option selected value="anyTransmission"></option>
                <option value="matic">Matic</option>
                <option value="manual">Manual</option>
              </select>
            </div>
          </div>
          <div class="col-md-4 col-lg-4 col-xl-4 pt-3">
            <label for="brand-mobil">Brand Mobil</label>
            <div class="input-group mt-1">
              <div class="input-group-text p-1"><i class="las la-car"></i></div>
              <select id="brand-mobil" class="form-select">
                <!-- Dummy Brand List -->
                <option selected value="anyBrand"></option>
                @foreach ($carBrands as $item) 
                  <option value="{{ ucwords($item->brand) }}"> {{ ucwords($item->brand) }} </option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="row pt-4 pb-3">
          <div class="d-grid gap-2 col-xl-12 mx-auto">
            <button
                type="button"
                class="btn button-36"
                id="searchButton"
            >
            Cari Mobil
            </button>
          </div>
        </div>
        <div class="row">
          <p id="error-message" class="text-danger fw-semibold text-center">*Maaf, Tanggal Ambil harus sebelum Tanggal Kembali</p>
        </div>
      </div>
    </div>

    <!-- Result Section -->
    <div class="container pt-5" id="resultCard">
      <h4 class="mb-0">Berikut mobil pilihan untuk Anda:</h4>

      <div class="row">
        @foreach ($cars as $car)
          @if($car->pesanan == null) <!--  Available Car -->
          <div class="col-md-6 col-lg-4 col-xl-3 pt-4">
            <div class="card shadow bg-white">
              <div class="card-header text-center bg-success text-white">
                Tersedia
              </div>
              <!-- TODO: load appropiate image -->
              <img id="car-image" src="{{ asset('img/car-zenix-dummyFilter.jpg') }}" class="card-img-top rounded-0" alt="Car Image">
              <div class="p-3">
                <h5 class="card-title fw-semibold"> {{$car->brand}} <br> {{$car->model}} </h5>
                <p class="card-price">Rp. {{$car->harga_sewa}}/hari</p>
                <div style="display: flex;">
                  <div style="width: 40px;"><i class="fa-solid fa-users"></i></div>
                  <p class="fw-medium">{{$car->kapasitas}} orang</p>
                </div>
                <div style="display: flex;">
                  <div style="width: 40px;"><i class="fa-solid fa-gear"></i></div>
                  <p class="fw-medium">{{$car->transmisi}}</p>
                </div>
                <div style="display: flex;">
                  <div style="width: 40px;"><i class="fa-solid fa-gas-pump"></i></div>
                  <p class="fw-medium">{{ucwords($car->bahan_bakar)}}</p>
                </div>
                <div class="d-grid pt-2">
                  <button
                    type="button"
                    class="btn button-36"
                  >
                  Pesan
                  </button>
                </div>
              </div>
            </div>
          </div>
          @else <!-- Unavailable Car -->
            <div class="col-md-6 col-lg-4 col-xl-3 pt-4">
              <div class="card shadow bg-white card-container">
                <div class="card-header text-center bg-danger text-white">
                  Akan tersedia pada {{$car->pesanan->tanggal_pengembalian}}
                </div>
                <div class="overlay rounded-1 shadow"></div>
                <img id="car-image" src="{{ asset('img/car-zenix-dummyFilter.jpg') }}" class="card-img-top rounded-0 card-image" alt="Car Image">
                <div class="p-3 card-content">
                  <h5 class="card-title fw-semibold">{{$car->brand}}<br>{{$car->model}}</h5>
                  <p class="card-price">Rp. {{$car->harga_sewa}}/hari</p>
                  <div style="display: flex;">
                    <div style="width: 40px;"><i class="fa-solid fa-users"></i></div>
                    <p class="fw-medium"> {{$car->kapasitas}} orang</p>
                  </div>
                  <div style="display: flex;">
                    <div style="width: 40px;"><i class="fa-solid fa-gear"></i></div>
                    <p class="fw-medium">{{$car->transmisi}}</p>
                  </div>
                  <div style="display: flex;">
                    <div style="width: 40px;"><i class="fa-solid fa-gas-pump"></i></div>
                    <p class="fw-medium">{{ucwords($car->bahan_bakar)}}</p>
                  </div>
                  <div class="d-grid pt-2">
                    <button
                      type="button"
                      class="btn button-36-disabled text-white-50"
                      disabled
                    >
                    Pesan
                    </button>
                  </div>
                </div>
              </div>
            </div>
          @endif
        @endforeach

      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.6.4/distribute/nouislider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/wnumb@1.2.0/wNumb.js"></script>
    <script src="{{ asset('js/filterCar.js') }}"></script>
  </body>
</html>