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
    <link href="{{ asset('css/mobil.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" />
    <title>Admin Mobil</title>
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
                    <a href="{{ route('pesanan') }}" class="sidebar-link d-flex align-items-center">
                        <i class="lni lni-agenda"></i>
                        <span>Pesanan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('mobil') }}" class="sidebar-link d-flex align-items-center" id="initialFocus">
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
            <div class="d-flex justify-content-between align-items-center ms-1 mt-4">
                <h2>
                    Daftar Mobil
                </h2>
                <button 
                type="button" 
                class="btn btn-primary button-36" 
                onclick="window.location.href = `{{ route('addMobil') }}`;"
                >Tambah mobil</button>
                
            </div>

            <div class="row">
                <!-- Dummy Card for Available Car 1 -->
                @foreach ($mobil as $item)
                <div class="col-md-6 col-lg-4 col-xl-3 pt-4">
                    <div class="card shadow bg-white">
                        @if ($item->status == "tersedia")
                            <div class="card-header text-center bg-success text-white">
                                {{$item->status}}
                            </div>
                        @else
                            <div class="card-header text-center bg-danger text-white">
                                {{-- Akan tersedia pada DD-MM-YYYY --}}
                                {{$item->status}}
                            </div>
                        @endif
                        
                        <img src="{{ asset('storage/' . $item->path) }}" class="card-img-top rounded-0" alt="Car Image">
                        <div class="p-3">
                            <h5 class="card-title fw-semibold">{{$item->brand}}<br>{{$item->model}}</h5>
                            <p class="card-price">Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}/hari</p>
                            <div style="display: flex;">
                                <div style="width: 40px;"><i class="fa-solid fa-users"></i></div>
                                <p class="fw-medium">{{$item->kapasitas}} orang</p>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 40px;"><i class="fa-solid fa-gear"></i></div>
                                <p class="fw-medium">{{$item->transmisi}}</p>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 40px;"><i class="fa-solid fa-gas-pump"></i></div>
                                <p class="fw-medium">Bensin</p>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 40px;"><i class="fa-solid fa-hashtag"></i></div>
                                <p class="fw-medium">{{$item->nomor_polisi}}</p>
                            </div>
                            <div class="d-grid gap-2 pt-2" style="grid-template-columns: repeat(auto-fit, minmax(0, 1fr));">
                                <button type="button" class="btn btn-danger">Hapus</button>
                                <button type="button" class="btn btn-primary" onclick="window.location.href = `{{ route('editMobil') }}`;">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>

        </div>
    </div>
    <script src="{{ asset('js/mobil.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>