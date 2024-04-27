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
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-box-arrow-left"></i>
                    </button>
                </form>
            </div>
        </aside>


        <div class="main p-4">
            <div class="d-flex justify-content-between align-items-center ms-1">
                <h2>
                    Daftar Mobil
                </h2>
            </div>

            <div class="row mt-2 align-items-center justify-content-between">

                <div class="col">
                        <a href="/admin/mobil" type="button" class="btn btn-outline-primary">All</a>
                        <button type="button" class="btn btn-outline-success mx-2" onclick="window.location.href = `{{ route('addMobil') }}`;">Tambah mobil</button>
                </div>

                <div class="col-auto">
                    <form class="form-inline d-flex" method="GET">
                        <div class="input-group" style="width: 300px;">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">
                                <i class="bi bi-search bi-sm" style="font-size: 1rem;"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="row">
                <!-- Dummy Card for Available Car 1 -->
                @foreach ($data as $item)
                <div class="col-md-6 col-lg-4 col-xl-3 pt-4">
                    <div class="card shadow bg-white">
                        @if ($item->status == "tersedia")
                        <div class="card-header text-center bg-success text-white">
                            Tersedia
                        </div>
                        @endif
                        @if ($item->status == "tidak_tersedia" && $item->tanggal_pengembalian != '')
                        <div class="card-header text-center bg-danger text-white">
                            Akan Tersedia Pada {{$item->tanggal_pengembalian}}
                        </div>
                        @endif
                        @if ($item->status == "tidak_tersedia" && $item->tanggal_pengembalian == '')
                        <div class="card-header text-center bg-danger text-white">
                            Sementara Tidak Ditawarkan
                        </div>
                        @endif

                        <img id="car-image" src="{{ asset('storage/' . $item->path) }}" class="card-img-top rounded-0" alt="Car Image">
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
                                <p class="fw-medium">{{$item->bahan_bakar}}</p>
                            </div>
                            <div style="display: flex;">
                                <div style="width: 40px;"><i class="fa-solid fa-hashtag"></i></div>
                                <p class="fw-medium">{{$item->nomor_polisi}}</p>
                            </div>
                            <div class="d-grid gap-2 pt-2" style="grid-template-columns: repeat(auto-fit, minmax(0, 1fr));">
                                @if ($item->status == "tersedia")
                                <form action="/admin/mobil/{{$item->id_mobil}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger w-100 show-alert-delete-box">Hapus</button>
                                </form>
                                @endif
                                @if ($item->status == "tidak_tersedia" && $item->tanggal_pengembalian != '')
                                <form action="/admin/mobil/{{$item->id_mobil}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger w-100 show-alert-delete-box disabled">Hapus</button>
                                </form>
                                @endif
                                @if ($item->status == "tidak_tersedia" && $item->tanggal_pengembalian == '')
                                <form action="/admin/mobil/{{$item->id_mobil}}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger w-100 show-alert-delete-box">Hapus</button>
                                </form>
                                @endif
                                <a href="/admin/mobil/edit-mobil/{{$item->id_mobil}}" class="btn btn-primary w-100">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </div>
    @include('sweetalert::alert')
    <script src="{{ asset('js/mobil.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="text/javascript">
        $('.show-alert-delete-box').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Yakin Hapus Mobil?",
                icon: "warning",
                type: "warning",
                buttons: ["Cancel", "Ya"],
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>