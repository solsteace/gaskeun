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
  <link href="{{ asset('css/pesanan.css') }}" rel="stylesheet">
  <link rel="icon" href="{{ asset('img/favicon.png') }}" />
  <title>Admin Pesanan</title>
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
          <a href="{{ route('admin') }}" class="sidebar-link d-flex align-items-center">
            <i class="lni lni-home"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="sidebar-item">
          <a href="{{ route('pesanan') }}" class="sidebar-link d-flex align-items-center" id="initialFocus">
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
      <div class="container mt-3">
        <h2>
          Daftar Pesanan
        </h2>
        <div class="card shadow-sm p-4 bg-white mt-4">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center align-middle" scope="col">#</th>
                  <th class="text-center align-middle" scope="col">Nama Peminjam</th>
                  <th class="text-center align-middle" scope="col">Mobil</th>
                  <th class="text-center align-middle" scope="col">Tanggal Pinjam</th>
                  <th class="text-center align-middle" scope="col">Tanggal Pengembalian</th>
                  <th class="text-center align-middle" scope="col">Durasi Peminjaman</th>
                  <th class="text-center align-middle" scope="col">Pembayaran</th>
                  <th class="text-center align-middle" scope="col">Status Pembayaran</th>
                  <th class="text-center align-middle" scope="col">Titik Antar</th>
                  <th class="text-center align-middle" scope="col">Titik Jemput</th>
                  <th class="text-center align-middle" scope="col">SIM</th>
                  <th class="text-center align-middle" scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($data as $index => $item)
                <tr>
                  <th class="text-center align-middle" scope="row">{{ $index + 1 }}</th>
                  <td class="text-center align-middle">{{$item->nama}}</td>
                  <td class="text-center align-middle">{{$item->nomor_polisi}}</td>
                  <td class="text-center align-middle">{{$item->tanggal_peminjaman}}</td>
                  <td class="text-center align-middle">{{$item->tanggal_pengembalian}}</td>
                  <td class="text-center align-middle">{{\Carbon\Carbon::parse($item->tanggal_pengembalian)->diffInDays(\Carbon\Carbon::parse($item->tanggal_peminjaman))}} hari</td>
                  <td class="text-center align-middle">Transfer</td>
                  <td class="text-center align-middle">{{$item->status}}</td>
                  <td class="text-center align-middle">
                    <a href="https://www.google.com/maps/place/{{$item->titik_antar}}" target="_blank">
                      <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 1rem;"></i>
                    </a>
                  </td>
                  <td class="text-center align-middle">
                    <a href="https://www.google.com/maps/place/{{$item->titik_jemput}}" target="_blank">
                      <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 1rem;"></i>
                    </a>
                  </td>
                  <td class="text-center align-middle">
                    <a href="#" class="modal-trigger" data-bs-toggle="modal" data-bs-target="#imageModal" data-image-url="{{ asset('storage/' . $item->SIM_peminjam) }}">
                      <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 1rem;"></i>
                    </a>
                  </td>
                  <td class="text-center align-middle">
                    <button type="button" class="btn btn-sm btn-success">Konfirmasi</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <!-- pop up image (SIM Preview) -->
          <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="imageModalLabel">SIM Preview</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <img id="modalImage" src="" class="img-fluid" alt="Preview Image">
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  @include('sweetalert::alert')
  <script src="{{ asset('js/pesanan.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>