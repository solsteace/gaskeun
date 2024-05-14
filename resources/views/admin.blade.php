<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
  <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  <link rel="icon" href="{{ asset('img/favicon.png') }}" />
  <title>Admin Dashboard</title>
</head>

<body>
  <div class="wrapper">
    <!-- SIDEBAR -->
    <aside id="sidebar" class="bg-sidebar">
      <div class="d-flex">
        <div class="sidebar-logo mt-3 ms-3">
          <a href="#">
            <img id="logo-img" src="{{ asset('img/logo-navbar.png') }}" alt="Gaskeun Logo" height="35" />
          </a>
        </div>
      </div>
      <ul class="sidebar-nav">
        <li class="sidebar-item">
          <a href="{{ route('admin') }}" class="sidebar-link d-flex align-items-center" id="initialFocus">
            <i class="lni lni-home"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="{{ route('pesanan') }}" class="sidebar-link d-flex align-items-center">
            <i class="lni lni-agenda"></i>
            <span>Pesanan</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="{{ route('mobil') }}" class="sidebar-link d-flex align-items-center">
            <i class="lni lni-car"></i>
            <span>Mobil</span>
          </a>
        </li>
      </ul>
      <div class="sidebar-footer mx-auto my-3">
        <form action="/logout" method="POST">
          @csrf
          <button type="submit" class="btn btn-danger">
            <i class="bi bi-box-arrow-left"></i>
          </button>
        </form>
      </div>
    </aside>


    <div class="main p-4">
      <div class="container">
        <h2>
          Dashboard
        </h2>

        <div class="row">

          <div class="col-sm-6 col-lg-3 col-xl-3">
            <div class="card text-center mt-4 shadow-sm">
              <div class="card-header text-white" style="background-color: #E6ACFF;">
                Jumlah Mobil
              </div>
              <div class="card-body">
                <h5 class="card-title fw-semibold mt-3 mb-4">{{$allCar}}</h5>
                <a href="/admin/mobil" class="btn btn-success w-100">Lihat</a>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-3 col-xl-3">
            <div class="card text-center mt-4 shadow-sm">
              <div class="card-header text-white" style="background-color: #B48BFF;">
                Jumlah Pesanan
              </div>
              <div class="card-body">
                <h5 class="card-title fw-semibold mt-3 mb-4">{{$allBooked}}</h5>
                <a href="/admin/pesanan" class="btn btn-success w-100">Lihat</a>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-3 col-xl-3">
            <div class="card text-center mt-4 shadow-sm">
              <div class="card-header text-white" style="background-color: #9476FF;">
                Mobil Tersedia
              </div>
              <div class="card-body">
                <h5 class="card-title fw-semibold mt-3 mb-4">{{$mobilTersedia}}</h5>
                <a href="/admin/mobil?search=tersedia" class="btn btn-success w-100">Lihat</a>
              </div>
            </div>
          </div>

          <div class="col-sm-6 col-lg-3 col-xl-3">
            <div class="card text-center mt-4 shadow-sm">
              <div class="card-header text-white" style="background-color: #5E53FF;">
                Mobil Tidak Tersedia
              </div>
              <div class="card-body">
                <h5 class="card-title fw-semibold mt-3 mb-4">{{$mobilTidakTersedia}}</h5>
                <a href="/admin/mobil?search=tidak_tersedia" class="btn btn-success w-100">Lihat</a>
              </div>
            </div>
          </div>

        </div>

        <div class="card shadow-sm p-4 bg-white mt-4">

          <div class="row align-items-center justify-content-between">
            <div class="col-auto">
              <h4>
                Menunggu Konfirmasi
              </h4>
            </div>
            @if ($data->isEmpty())
                <div class="col-auto">
                  <a href="/admin/pesanan?search=belum_lunas" class="btn btn-success disabled" >Lakukan Konfirmasi</a>
                </div>
            @else
              <div class="col-auto">
                <a href="/admin/pesanan?search=belum_lunas" class="btn btn-success" >Lakukan Konfirmasi</a>
              </div>
            @endif
          </div>

          @if ($data->isEmpty())
              <p>Semua pembayaran telah dikonfirmasi</p>
          @else
            @foreach ($data as $item)
                <div class="container custom-shadow mt-3">
                  <div class="row pt-3 pb-3 align-items-center justify-content-between">
                    <div class="col-auto">
                      <h5 class="card-title fw-semibold">{{$item->nama_peminjam}}</h5>
                      <p class="m-0">Pesan mobil {{$item->brand}} {{$item->model}} pada {{$item->tanggal_peminjaman}}</p>
                    </div>
                    <div class="col-auto">
                      <p class="card-price m-0 mt-2">Rp. {{ number_format($item->harga_sewa * 
                                    (date_diff(
                                        date_create($item->tanggal_peminjaman),
                                        date_create($item->tanggal_pengembalian)
                                      )->format('%a')), 0, ',', '.') }}
                      </p>
                    </div>
                  </div>
                </div>
            @endforeach
          @endif
          

        </div>
      </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>