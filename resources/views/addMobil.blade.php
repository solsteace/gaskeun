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
    <link href="{{ asset('css/addMobil.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" />
    <title>Admin Tambah Mobil</title>
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
            <div class="container mt-3">
                <h2>
                    Tambah Mobil
                </h2>
                <div class="card shadow-sm px-4 bg-white mt-4">
                    <form action="/admin/mobil/add-mobil" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
                                <label for="brand">Brand</label>
                                <div class="input-group mt-1">
                                    <div class="input-group-text p-1"><i class="las la-car-side"></i></div>
                                    <input type="text" id="brand" name="brand" class="form-control @error('brand') is-invalid @enderror" required value="{{ old('brand') }}">
                                    @error('brand')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
                                <label for="model">Model</label>
                                <div class="input-group mt-1">
                                    <div class="input-group-text p-1"><i class="las la-car-side"></i></div>
                                    <input type="text" id="model" name="model" class="form-control @error('model') is-invalid @enderror" required value="{{ old('model') }}">
                                    @error('model')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
                                <label for="transmisi">Transmisi</label>
                                <div class="input-group mt-1">
                                    <div class="input-group-text p-1"><i class="las la-cog"></i></div>
                                    <select id="transmisi" name="transmisi" class="form-select @error('transmisi') is-invalid @enderror" required>
                                        <option value="" disabled selected></option>
                                        <option value="matic" {{ old('transmisi') == 'matic' ? 'selected' : '' }}>Matic
                                        </option>
                                        <option value="manual" {{ old('transmisi') == 'manual' ? 'selected' : '' }}>
                                            Manual</option>
                                        <option value="lainnya" {{ old('transmisi') == 'lainnya' ? 'selected' : '' }}>
                                            Lainnya</option>
                                    </select>
                                    @error('transmisi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
                                <label for="nomor_polisi">Plat Nomor</label>
                                <div class="input-group mt-1">
                                    <div class="input-group-text p-1"><i class="las la-hashtag"></i></div>
                                    <input type="text" id="nomor_polisi" name="nomor_polisi" class="form-control @error('nomor_polisi') is-invalid @enderror" required value="{{ old('nomor_polisi') }}">
                                    @error('nomor_polisi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
                                <label for="kapasitas">Kapasitas Penumpang</label>
                                <div class="input-group mt-1">
                                    <div class="input-group-text p-1"><i class="las la-user-friends"></i></div>
                                    <input type="number" id="kapasitas" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror" inputmode="numeric" required value="{{ old('kapasitas') }}">
                                    @error('kapasitas')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
                                <label for="harga_sewa">Harga Sewa (per hari)</label>
                                <div class="input-group mt-1">
                                    <div class="input-group-text">Rp</div>
                                    <input type="number" id="harga_sewa" name="harga_sewa" class="form-control @error('harga_sewa') is-invalid @enderror" inputmode="numeric" required value="{{ old('harga_sewa') }}">
                                    @error('harga_sewa')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
                                <label for="bahan_bakar">Bahan Bakar</label>
                                <div class="input-group mt-1">
                                    <div class="input-group-text p-1">
                                        <i class="las la-gas-pump"></i>
                                    </div>
                                    <select id="bahan_bakar" name="bahan_bakar" class="form-select @error('bahan_bakar') is-invalid @enderror" required>
                                        <option value="" disabled selected></option>
                                        <option value="bensin" {{ old('bahan_bakar') == 'bensin' ? 'selected' : '' }}>Bensin</option>
                                        <option value="diesel" {{ old('bahan_bakar') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="listrik" {{ old('bahan_bakar') == 'listrik' ? 'selected' : '' }}>Listrik</option>
                                    </select>
                                    @error('bahan_bakar')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
                                <label for="status">Status</label>
                                <div class="input-group mt-1">
                                    <div class="input-group-text p-1">
                                        <i class="las la-check-circle"></i>
                                    </div>
                                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                                        <option value="" disabled selected></option>
                                        <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="tidak_tersedia" {{ old('status') == 'tidak_tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                                        {{-- <option value="dipinjam" {{ old('status') == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option> --}}
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-4 pt-3">
                                <label for="image">Gambar</label>
                                <div class="input-group mt-1">
                                    <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 pt-3">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="row mb-4">
                            <button type="submit" class="btn button-36 show-alert-confirm-submit" id="submit-mobil">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        @include('sweetalert::alert')
    @endif
    <script src="{{ asset('js/addMobil.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script type="text/javascript">
        $('.show-alert-confirm-submit').click(function(event){
            var form =  $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                title: "Yakin Data Sudah Benar?",
                icon: "info",
                type: "info",
                buttons: ["Cancel","Ya"],
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