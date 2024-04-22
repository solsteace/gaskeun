<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/favicon.png') }}"/>
    <title>Admin</title>
    <style>
    .car-card {
      margin-bottom: 20px;
    }
    .btn-new-card{
        margin-left: 930px
    } 
  </style>
</head>
<body>
<div>
    <!-- NavBar -->
      <nav class="navbar navbar-expand-lg fixed-top bg-navbar">
        <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('img/logo-navbar.png') }}" alt="Gaskeun Logo" height="35"/>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-nav-scroll ms-auto mb-2 mb-lg-0">
            <form class="d-flex" role="search" id="searching">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" style="height:30px; margin-top:14px;">
                <button class="btn btn-outline-success" type="submit" style="height:30px; margin-top:14px; padding-top:2px;">Search</button>
            </form>
            <div class="dropdown border-top" style="width: 1rem">
                <a href="#" class="d-flex align-items-center justify-content-center p-3 link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="28" height="28" class="rounded-circle">
                </a>
                
                <ul class="dropdown-menu text-small shadow" >
                    
                    <li>
                    <form action="/logout" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                    </li>
                    
                </ul>
            </div>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div class="d-flex flex-column flex-shrink-0 bg-body-tertiary" style="width: 4.5rem; height:100vh;">
    <a href="/" class="d-block p-3 link-body-emphasis text-decoration-none" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
      <img src="{{ asset('img/logo-navbar.png') }}" alt="Gaskeun Logo" width="45" height="32"></svg>
      <span class="visually-hidden">Icon-only</span>
    </a>
    <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
      <li class="nav-item">
        <a href="{{asset('admin')}}" class="nav-link py-3 border-bottom rounded-0 sideActive" aria-current="page" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Dashboard" data-bs-original-title="Dashboard">
          <svg class="bi pe-none" width="24" height="24" role="img" aria-label="Dashboard"><use xlink:href="#dashboard"></use></svg>
          <span class="nav-link-text">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{route('pesanan')}}" class="nav-link py-3 border-bottom rounded-0 sideActive" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Pesanan" data-bs-original-title="Pesanan">
          <svg class="bi pe-none" width="24" height="24" role="img" aria-label="Pesanan"><use xlink:href="#pesanan"></use></svg>
          <span class="nav-link-text">Pesanan</span>
        </a>
      </li>
      <li>
        <a href="#" class="nav-link active py-3 border-bottom rounded-0 sideActive" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Mobil" data-bs-original-title="Mobil">
          <svg class="bi pe-none" width="24" height="24" role="img" aria-label="Mobil"><use xlink:href="#mobil"></use></svg>
          <span class="nav-link-text">Mobil</span>
        </a>
      </li>
      
    </ul>
    <svg xmlns="http://www.w3.org/2000/svg">
    <symbol id="dashboard" viewBox="0 0 16 16">
      <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
    </symbol>
    <symbol id="pesanan" viewBox="0 0 16 16">
      <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
    </symbol>
    <symbol id="mobil" viewBox="0 0 16 16">
        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2"/>
    </symbol>
    
  </svg>
  </div>

  

  <!-- KONTEN -->
  <div class="container">
    <div class="content">
        <div class="mobil" id="mobil" style="margin-left:20px;">
        <div class="container my-5">
            <h2 class="mb-4">List Car</h2>
            <div class="d-flex mb-4">
                <button class="btn btn-filter" style="border:1px solid blue">All</button>
                <button class="btn btn-primary btn-new-card"> <a href="{{route('addMobil')}}" style="color: white; text-decoration: none;"><i class="bi bi-plus"></i>Add New Car</a></button>
            </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card car-card mb-4">
                    <img src="{{ asset("img/car-zenix.png") }}" class="card-img-top" alt="Mobil 1">
                    <div class="card-body">
                        <h5 class="card-title">Nama/Tipe Mobil</h5>
                        <p class="card-text">Rp 430.000 / hari</p>
                        <p class="card-text"><small class="text-muted">Updated at 4 Apr 2022, 09:00</small></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-success">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card car-card mb-4">
                    <img src="{{ asset("img/car-zenix.png") }}" class="card-img-top" alt="Mobil 1">
                    <div class="card-body">
                        <h5 class="card-title">Nama/Tipe Mobil</h5>
                        <p class="card-text">Rp 430.000 / hari</p>
                        <p class="card-text"><small class="text-muted">Updated at 4 Apr 2022, 09:00</small></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-success">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card car-card mb-4">
                    <img src="{{ asset("img/car-zenix.png") }}" class="card-img-top" alt="Mobil 1">
                    <div class="card-body">
                        <h5 class="card-title">Nama/Tipe Mobil</h5>
                        <p class="card-text">Rp 430.000 / hari</p>
                        <p class="card-text"><small class="text-muted">Updated at 4 Apr 2022, 09:00</small></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-success">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card car-card mb-4">
                    <img src="{{ asset("img/car-zenix.png") }}" class="card-img-top" alt="Mobil 1">
                    <div class="card-body">
                        <h5 class="card-title">Nama/Tipe Mobil</h5>
                        <p class="card-text">Rp 430.000 / hari</p>
                        <p class="card-text"><small class="text-muted">Updated at 4 Apr 2022, 09:00</small></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-success">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card car-card mb-4">
                    <img src="{{ asset("img/car-zenix.png") }}" class="card-img-top" alt="Mobil 1">
                    <div class="card-body">
                        <h5 class="card-title">Nama/Tipe Mobil</h5>
                        <p class="card-text">Rp 430.000 / hari</p>
                        <p class="card-text"><small class="text-muted">Updated at 4 Apr 2022, 09:00</small></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-success">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card car-card mb-4">
                    <img src="{{ asset("img/car-zenix.png") }}" class="card-img-top" alt="Mobil 1">
                    <div class="card-body">
                        <h5 class="card-title">Nama/Tipe Mobil</h5>
                        <p class="card-text">Rp 430.000 / hari</p>
                        <p class="card-text"><small class="text-muted">Updated at 4 Apr 2022, 09:00</small></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-success">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card car-card mb-4">
                    <img src="{{ asset("img/car-zenix.png") }}" class="card-img-top" alt="Mobil 1">
                    <div class="card-body">
                        <h5 class="card-title">Nama/Tipe Mobil</h5>
                        <p class="card-text">Rp 430.000 / hari</p>
                        <p class="card-text"><small class="text-muted">Updated at 4 Apr 2022, 09:00</small></p>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-danger">Delete</button>
                            <button class="btn btn-success">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>



  <script src="{{ asset('js/admin.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>