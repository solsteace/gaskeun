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
          <a class="navbar-brand" href="{{ route('index') }}">
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
                <a class="nav-link active" href="#" aria-current="page">Pemesanan</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="{{ route('history') }}">Pesanan Saya</a>
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


    @if(Session::has("err"))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{Session::get("err")}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

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
                <option value="8">8</option>>
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

      <div class="row" id="availableCars">
        @foreach ($cars as $car)
          @if( 
            $car->status == "tersedia" 
            && (
              !($car->pesanan()->exists())
              || !($car->pesanan()
                  ->where('status', 'belum_selesai')
                  ->exists()
                )  
            )
          ) <!--  Available Car -->
          <div class="col-md-6 col-lg-4 col-xl-3 pt-4">
            <div class="card shadow bg-white">
              <div class="card-header text-center text-white" style="background-color: #52B788;">
                Tersedia
              </div>
              <!-- TODO: load appropiate image -->
              <img id="car-image" src="{{ asset( 'storage/' . $car->image()->first()->path ) }}" class="card-img-top rounded-0" alt="Car Image">
              <div class="p-3">
                <h5 class="card-title fw-semibold"> {{$car->brand}} <br> {{$car->model}} </h5>
                <p class="card-price">Rp. {{$car->harga_sewa}}/hari</p>
                <div style="display: flex;">
                  <div style="width: 40px;"><i class="fa-solid fa-users"></i></div>
                  <p class="fw-medium">{{$car->kapasitas}} orang</p>
                </div>
                <div style="display: flex;">
                  <div style="width: 40px;"><i class="fa-solid fa-gear"></i></div>
                  <p class="fw-medium">{{ucwords($car->transmisi)}}</p>
                </div>
                <div style="display: flex;">
                  <div style="width: 40px;"><i class="fa-solid fa-gas-pump"></i></div>
                  <p class="fw-medium">{{ucwords($car->bahan_bakar)}}</p>
                </div>
                <div class="d-grid pt-2">
                  <a class="btn button-36 d-flex align-items-center justify-content-center" href="{{ route('booking', ['carId' => $car->id]) }}" role="button">Pesan</a>
                </div>
              </div>
            </div>
          </div>
          @else <!-- Unavailable Car -->
            <div class="col-md-6 col-lg-4 col-xl-3 pt-4">
              <div class="card shadow bg-white card-container">
                <div class="card-header text-center text-white" style="background-color: #FF6969;">
                  @if($car->pesanan()->exists())
                    Akan tersedia pada {{
                      ($car->pesanan()
                        ->where('status', "belum_selesai")
                        ->first()->tanggal_pengembalian
                      )
                    }}
                  @else
                    Sementara tidak ditawarkan
                  @endif
                </div>
                <div class="overlay rounded-1 shadow"></div>
                <img id="car-image" src="{{ asset( 'storage/' . $car->image()->first()->path ) }}" class="card-img-top rounded-0 card-image" alt="Car Image">
                <div class="p-3 card-content">
                  <h5 class="card-title fw-semibold">{{$car->brand}}<br>{{$car->model}}</h5>
                  <p class="card-price">Rp. {{$car->harga_sewa}}/hari</p>
                  <div style="display: flex;">
                    <div style="width: 40px;"><i class="fa-solid fa-users"></i></div>
                    <p class="fw-medium"> {{$car->kapasitas}} orang</p>
                  </div>
                  <div style="display: flex;">
                    <div style="width: 40px;"><i class="fa-solid fa-gear"></i></div>
                    <p class="fw-medium">{{ucwords($car->transmisi)}}</p>
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

    <!-- Footer -->
    <div class="footer mt-5">
      <div class="container">
        <div class="row">
          <div class="col-7 col-sm-5 col-md-4 col-lg-3 col-xl-2 mt-5">
            <img src="{{ asset("img/logo-footer.png") }}" class="img-fluid" alt="Logo White">
            <p class="m-0 ms-4">&copy; 2024 PT Gaskeun</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 col-lg-4 col-xl-4">
            <h4 class="mt-4 mb-0">Alamat</h3>
            <p>Menara Embun Pagi<br>Jl. Sukabirus No.110, Citeureup, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat 40257</p>

            <h4 class="mt-4 mb-0">Jam Kerja</h3>
            <p class="mb-0">00:00 - 23:59 (24 jam)</p>
            <p>Senin - Minggu (setiap hari)</p>
          </div>
          <div class="com-md-0 col-lg-2 col-xl-2"></div>
          <div class="col-md-12 col-lg-6 col-xl-6">
            <h4 class="mt-4 mb-0">Pusat bantuan</h3>
            <table>
              <tr>
                <td class="fw-medium">Bantuan Pemesanan</td>
                <td class="ps-3">022-20271564</td>
              </tr>
              <tr>
                <td class="fw-medium">Bantuan Perjalanan</td>
                <td class="ps-3">022-20431245</td>
              </tr>
              <tr>
                <td class="fw-medium">Bantuan Website</td>
                <td class="ps-3">022-20180523</td>
              </tr>
            </table>

            <h4 class="mt-4 mb-1">Ikuti Kami</h4>
            <div class="row-4 mb-5">
              <a href="https://www.facebook.com" target="_blank"><img src="{{ asset("img/icon-facebook.png") }}" alt="Facebook icon" height=35 width=35 class="me-3"/></a>
              <a href="https://www.instagram.com" target="_blank"><img src="{{ asset("img/icon-instagram.png") }}" alt="Instagram icon" height=35 width=35 class="me-3"/></a>
              <a href="https://twitter.com" target="_blank"><img src="{{ asset("img/icon-x.png") }}" alt="X icon" height=35 width=35 class="me-3"/></a>
              <a href="https://wa.me/yourphonenumber" target="_blank"><img src="{{ asset("img/icon-whatsapp.png") }}" alt="Whatsapp icon" height=35 width=35 class="me-3"/></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/nouislider@14.6.4/distribute/nouislider.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/wnumb@1.2.0/wNumb.js"></script>
    <script src="{{ asset('js/filterCar.js') }}"></script>
  </body>
</html>