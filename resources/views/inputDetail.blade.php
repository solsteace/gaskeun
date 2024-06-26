<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Peminjaman - Gaskeun</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href= "https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css" >
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <link rel="icon" href="{{ asset('img/favicon.png') }}"/>
    <script src="https://kit.fontawesome.com/98e80d3b36.js" crossorigin="anonymous"></script>
    <link href="{{ asset('css/inputDetail.css') }}" rel="stylesheet">

    <!-- https://stackoverflow.com/questions/41391862/how-to-access-php-session-variable-in-javascript -->
    <?php
        $script = "<script> const BOOKED_CAR={$_GET['carId']};";
        if(Auth::check()) {
          $userId = Auth::id();
          $script = "{$script}const LOGGED_USER={$userId};";
        }
        echo $script . "</script";
          
    ?>
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

    <!-- Detail Title -->
    <div class="container">
      <div class="row"> 
        <h2 class="mb-0">Detail Pemesanan</h2>
        <p class="mb-0">Silahkan isi data pemesanan berikut, data Anda akan kami jaga kerahasiaannya.</p>
      </div>
    </div>

    <!-- Filter Form -->
    <div class="container mt-3">
      <div class="card shadow-sm px-4 bg-white">
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xl-6 pt-3">
            <label for="nama-lengkap" class="form-label">Nama lengkap (sesuai KTP)</label>
            <div class="input-group mt-1">
              <div class="input-group-text p-1"><i class="las la-user-alt"></i></div>
              <input type="text" id="nama-lengkap" class="form-control">
            </div>
            <div class="text-bg-danger rounded ps-2 py-1" id="empty-name" style="display: none;">
              Belum diisi
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-6 pt-3">
            <label for="email" class="form-label">Alamat email</label>
            <div class="input-group mt-1">
              <div class="input-group-text p-1"><i class="las la-envelope"></i></div>
              <input type="email" id="email" class="form-control">
            </div>
            <div class="text-bg-danger rounded ps-2 py-1" id="empty-email" style="display: none;">
              Belum diisi
            </div>
            <div class="text-bg-danger rounded ps-2 py-1" id="invalid-email" style="display: none;">
              Format email belum sesuai
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xl-6 pt-3">
            <label for="pickup-location" class="form-label mb-0">Lokasi Pengambilan</label>
            <div class="form-text mt-0 mb-2 text-warning">Kosongkan jika ingin mengambil mobil sewa di kantor Gaskeun.</div>
            <div class="row">
              <div class="col-xl-10">
                <input type="text" id="pickup-location" class="form-control">
              </div>
              <div class="col-xl-2">
                <div class="d-grid">
                  <button type="button" class="btn button-36" data-bs-toggle="modal" data-bs-target="#pickup-modal" id="pickup-toggle">
                    <i class="las la-map-marked-alt"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-6 pt-3">
            <label for="dropoff-location" class="form-label mb-0">Lokasi Pengembalian</label>
            <div class="form-text mt-0 mb-2 text-warning">Kosongkan jika ingin mengembalikan mobil sewa di kantor Gaskeun.</div>
            <div class="row">
              <div class="col-xl-10">
                <input type="text" id="dropoff-location" class="form-control">
              </div>
              <div class="col-xl-2">
                <div class="d-grid">
                  <button type="button" class="btn button-36" data-bs-toggle="modal" data-bs-target="#dropoff-modal" id="dropoff-toggle">
                    <i class="las la-map-marked-alt"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xl-6 pt-3">
            <label for="start-date">Tanggal Ambil</label>
            <div class="input-group mt-1">
              <div class="input-group-text p-1" id="icon-start"><i class="las la-calendar-check"></i></div>
              <input type="text" id="start-date" class="form-control">
            </div>
            <div class="text-bg-danger rounded ps-2 py-1" id="empty-start-date" style="display: none;">
              Belum diisi
            </div>
            <div class="invalid-date text-bg-danger rounded ps-2 py-1" id="invalid-date" style="display: none;">
              Tanggal ambil harus sebelum tanggal kembali
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-6 pt-3">
            <label for="end-date">Tanggal Kembali</label>
            <div class="input-group mt-1">
              <div class="input-group-text p-1" id="icon-end"><i class="las la-calendar-times"></i></div>
              <input type="text" id="end-date" class="form-control">
            </div>
            <div class="text-bg-danger rounded ps-2 py-1" id="empty-return-date" style="display: none;">
              Belum diisi
            </div>
            <div class="invalid-date text-bg-danger rounded ps-2 py-1" style="display: none;">
              Tanggal kembali harus setelah tanggal kembali
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-6 col-xl-6 pt-3">
            <label for="phone">No Telepon</label>
            <div class="form-text mt-0 mb-2">Contoh: 085125315665</div>
            <div class="input-group">
              <div class="input-group-text p-1" id="icon-start"><i class="las la-phone"></i></div>
              <input type="text" id="phone" class="form-control">
            </div>
            <div class="text-bg-danger rounded ps-2 py-1" id="empty-phone" style="display: none;">
              Belum diisi
            </div>
            <div class="text-bg-danger rounded ps-2 py-1" id="invalid-phone" style="display: none;">
              Format no telepon belum sesuai
            </div>
          </div>
          <div class="col-md-6 col-lg-6 col-xl-6 pt-3">
            <label for="phone-emergency">No Telepon Darurat</label>
            <div class="form-text mt-0 mb-2">Contoh: 081227627654</div>
            <div class="input-group">
              <div class="input-group-text p-1" id="icon-end"><i class="las la-phone-volume"></i></div>
              <input type="text" id="phone-emergency" class="form-control">
            </div>
            <div class="text-bg-danger rounded ps-2 py-1" id="empty-phone-darurat" style="display: none;">
              Belum diisi
            </div>
            <div class="text-bg-danger rounded ps-2 py-1" id="invalid-phone-darurat" style="display: none;">
              Format no telepon belum sesuai
            </div>
            <div class="text-bg-danger rounded ps-2 py-1" id="same-phone-darurat" style="display: none;">
              No telepon darurat tidak boleh sama
            </div>
          </div>
        </div>
        <div class="row">
          <label class="pt-3">Surat Izin Mengemudi kategori A</label>
          <div class="form-text mt-0">Pastikan identitas dan foto pada SIM Anda dapat terlihat dengan jelas</div>
          <div class="col-md-12 col-lg-12 col-xl-12">
            <label class="d-flex justify-content-center mt-3" for="input-file" id="drop-area">
              <input type="file" accept="image/*" id="input-file" hidden>
              <div id="img-view">
                <img src="{{ asset("img/icon-upload.png") }}">
                <p>Seret dan lepas atau klik disini untuk upload SIM anda</p>
                <span>Upload foto SIM</span>
              </div>
            </label>
            <div class="text-bg-danger rounded ps-2 py-1" id="empty-file" style="display: none;">
              SIM belum diupload
            </div>
          </div>
        </div>
        <div class="row pt-4 ps-3 pe-3">
          <div class="col form-check">
            <input type="checkbox" class="form-check-input" id="setuju">
            <label class="form-check-label text-warning" for="setuju">Saya menyetujui bahwa data diri yang saya berikan akan disimpan dan digunakan oleh PT Gaskeun sesuai dengan kebijakan privasi yang berlaku.</label>
          </div>
          <div class="text-bg-danger rounded ps-2 py-1" id="empty-setuju" style="display: none;">
            Belum menyetujui kebijakan privasi
          </div>
        </div>
        <div class="row pt-4 pb-3">
          <div class="d-grid gap-2 col-xl-12 mx-auto">
            <button
                type="button"
                class="btn button-36"
                id="confirmButton"
                data-bs-toggle="modal"
                id="confirm-toggle"
            >
              Konfirmasi Pemesanan
            </button>
          </div>
        </div>
        <div class="row">
          <p class="invalid-date text-danger fw-semibold text-center" style="display: none;">*Maaf, Tanggal Ambil harus sebelum Tanggal Kembali</p>
        </div>
      </div>
    </div>

    <!-- Pickup Modal -->
    <div class="modal fade" id="pickup-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Klik pada peta untuk memilih pengambilan mobil</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="pickup-cancel"></button>
          </div>
          <div class="modal-body">
            <div id="pickup-map"></div>
          </div>
          <div class="modal-footer">
            <p class="text-warning m-0 me-3">Catatan: pengambilan di luar kantor tidak dipungut biaya tambahan</p>
            <button type="button" class="btn button-36" data-bs-dismiss="modal" id="pickup-confirm">Pilih lokasi</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Dropoff Modal -->
    <div class="modal fade" id="dropoff-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5">Klik pada peta untuk memilih pengembalian mobil</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="dropoff-cancel"></button>
          </div>
          <div class="modal-body">
            <div id="dropoff-map"></div>
          </div>
          <div class="modal-footer">
            <p class="text-warning m-0 me-3">Catatan: pengembalian di luar kantor tidak dipungut biaya tambahan</p>
            <button type="button" class="btn button-36" data-bs-dismiss="modal" id="dropoff-confirm">Pilih lokasi</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Konfirmasi Modal -->
    <div class="modal fade" id="confirm-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" disabled id="confirmationPopUp__close"></button>
          </div>
          <div class="modal-body" >
            <p class="text-center mb-1" id="confirmationPopUp__msgTop"> Pesanan anda sedang diproses! </p>
            <p class="text-center mb-1" id="confirmationPopUp__msgBottom"> Mohon menunggu hingga proses selesai</p>
            <img src="{{ asset('img/icon-loading.gif') }}" id="confirmationPopUp__icon" class="mx-auto d-block" alt="confirmed" height=150 width=150>
          </div>
          <div class="modal-footer d-flex justify-content-center" style="display: none;">
            <a href="{{ route('history') }}" class="btn button-36 d-flex align-items-center justify-content-center disabled" id="confirmationPopUp__back" style="pointer-events: none;">Memproses...</a>
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

    <script>
      var iconConfirm = "{{ asset('img/icon-confirm.png') }}";
      var iconDecline = "{{ asset('img/icon-decline.png') }}";
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/wnumb@1.2.0/wNumb.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('js/inputDetail.js') }}"></script>
  </body>
</html>
