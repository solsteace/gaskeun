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
          <a class="navbar-brand" href="{{ route('index') }">
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

    <!-- Filter Title -->
    <div class="container">
      <div class="row"> 
        <h2 class="mb-0">Riwayat pesanan</h2>
        <p class="mb-0">Hubungi kami jika Anda memiliki pertanyaan.</p>
      </div>
    </div>

    <div class="container" id="historyCard">
      @foreach ($books as $book) 
      <div class="row">
        <div class="col-12 pt-4">
          <div class="card shadow bg-white">
              <div class="row">
              <div class="col-md-12 col-lg-3 col-xl-3">
                <img class="img-fluid img-cover" src="{{ asset('img/car-zenix-dummyFilter.jpg') }}" alt="Car Image">
              </div>
              <div class="col-md-6 col-lg-5 col-xl-5 px-4">
                <h5 class="card-title fw-semibold fs-2 pt-3"> {{$book->brand}} {{$book->model}}</h5>
                <div style="display: flex;" class="pt-2">
                  <div style="width: 40px;"><i class="fa-solid fa-users"></i></div>
                  <p class="fw-medium"> {{$book->nomor_polisi}} </p>
                </div>
                <div style="display: flex;" class="mb-0">
                  <div style="width: 40px;"><i class="fa-solid fa-gear"></i></div>
                  <p class="fw-medium">{{$book->transmisi}}</p>
                </div>
                <div style="display: flex;" class="pb-3">
                  <div style="width: 40px;"><i class="fa-solid fa-gas-pump"></i></div>
                  <p class="fw-medium mb-0">{{$book->bahan_bakar}}</p>
                </div>
              </div>
              <div class="col-md-6 col-lg-4 col-xl-4 px-4">
                <table>
                  <tr>
                    <td>Ambil</td>
                    <td>: {{$book->tanggal_peminjaman}}</td>
                  </tr>
                  <tr>
                    <td>Balik</td>
                    <td>: {{$book->tanggal_pengembalian}}</td>
                  </tr>
                  <tr> <!-- ref: https://www.w3schools.com/php/phptryit.asp?filename=tryphp_func_date_diff -->
                    <td>Total</td>
                    <td>: Rp. {{ $book->harga_sewa * 
                                (date_diff(
                                    date_create($book->tanggal_peminjaman),
                                    date_create($book->tanggal_pengembalian)
                                  )->format('%a')
                                )
                              }}
                    </td>
                  </tr>
                </table>
                
                @if ($book->status == "lunas") <!-- If status pembayaran is paid -->
                  <div class="d-grid mt-3">
                    <button
                      type="button"
                      class="btn button-36"
                    >
                      <a href="" style="text-decoration: none; color: white">
                        Pesan Lagi
                      </a>
                    </button>
                  </div>
                @else <!-- If status pembayaran is unpaid -->
                  <div class="d-flex align-items-center justify-content-center unpaid bg-danger text-white mt-3">
                    Belum dibayar
                  </div>
                @endif
              </div>
          </div>
        </div>
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
  </body>
</html>