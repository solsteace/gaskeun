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
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </aside>


    <div class="main p-4">
      <div class="container mt-3">
        <h2>
          Daftar Pesanan
        </h2>
        <div class="card shadow-sm p-4 bg-white">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th class="text-center align-middle" scope="col">#</th>
                  <th class="text-center align-middle" scope="col">Nama Peminjam</th>
                  <th class="text-center align-middle" scope="col">Tanggal Pinjam</th>
                  <th class="text-center align-middle" scope="col">Tanggal Pengembalian</th>
                  <th class="text-center align-middle" scope="col">Durasi Peminjaman</th>
                  <th class="text-center align-middle" scope="col">Pembayaran</th>
                  <th class="text-center align-middle" scope="col">Status Pembayaran</th>
                  <th class="text-center align-middle" scope="col">SIM</th>
                  <th class="text-center align-middle" scope="col">Titik Antar</th>
                  <th class="text-center align-middle" scope="col">Titik Jemput</th>
                  <th class="text-center align-middle" scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th class="text-center align-middle" scope="row">1</th>
                  <td class="text-center align-middle">Deaz</td>
                  <td class="text-center align-middle">30/04/2024</td>
                  <td class="text-center align-middle">04/05/2024</td>
                  <td class="text-center align-middle">4 hari</td>
                  <td class="text-center align-middle">Transfer</td>
                  <td class="text-center align-middle">Lunas</td>
                  <td class="text-center align-middle">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal">
                      <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 1rem;"></i>
                    </a>
                  </td>
                  <td class="text-center align-middle">Bikini Bottom</td>
                  <td class="text-center align-middle">Rock Bottom</td>
                  <td class="text-center align-middle">
                    <button type="button" class="btn btn-sm btn-success">Konfirmasi</button>
                  </td>
                </tr>
                <tr>
                  <th class="text-center align-middle" scope="row">2</th>
                  <td class="text-center align-middle">Setyo</td>
                  <td class="text-center align-middle">30/04/2024</td>
                  <td class="text-center align-middle">04/05/2024</td>
                  <td class="text-center align-middle">4 hari</td>
                  <td class="text-center align-middle">Debit</td>
                  <td class="text-center align-middle">Lunas</td>
                  <td class="text-center align-middle">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal">
                      <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 1rem;"></i>
                    </a>
                  </td>
                  <td class="text-center align-middle">Fontaine</td>
                  <td class="text-center align-middle">Liyue</td>
                  <td class="text-center align-middle">
                    <button type="button" class="btn btn-sm btn-success">Konfirmasi</button>
                  </td>
                </tr>
                <tr>
                  <th class="text-center align-middle" scope="row">3</th>
                  <td class="text-center align-middle">Nugroho</td>
                  <td class="text-center align-middle">30/04/2024</td>
                  <td class="text-center align-middle">04/05/2024</td>
                  <td class="text-center align-middle">4 hari</td>
                  <td class="text-center align-middle">QRIS</td>
                  <td class="text-center align-middle">Belum lunas</td>
                  <td class="text-center align-middle">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal">
                      <i class="fa-solid fa-arrow-up-right-from-square" style="font-size: 1rem;"></i>
                    </a>
                  </td>
                  <td class="text-center align-middle">Azkaban</td>
                  <td class="text-center align-middle">Diagon Alley</td>
                  <td class="text-center align-middle">
                    <button type="button" class="btn btn-sm btn-success">Konfirmasi</button>
                  </td>
                </tr>
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
                  <img src="{{ asset('img/deaz.jpeg') }}" class="img-fluid" alt="Preview Image">
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