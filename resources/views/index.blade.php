<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gaskeun</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+Sundanese:wght@400..700&display=swap">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('img/favicon.png') }}"/>
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">

    <script>
      var imgHero = "{{ asset('img/img-hero.png') }}";
      var imgHeroExtended = "{{ asset('img/img-hero-extended.png') }}";
      var imgBgBandung = "{{ asset('img/bg-bandung.png') }}";
      var imgBgBandungSmal = "{{ asset('img/bg-bandung-small.png') }}";
      var imgMiniMania = "{{ asset('img/img-miniMania.png') }}";
      var imgResto = "{{ asset('img/img-resto.png') }}";
      var imgBraga = "{{ asset('img/img-braga.png') }}";
    </script>
  </head>
  <body>
    <!-- Navbar -->
    <div>
      <nav class="navbar navbar-expand-lg fixed-top bg-navbar">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="{{ asset('img/logo-navbar.png') }}" alt="Gaskeun Logo" height="35" />
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav navbar-nav-scroll ms-auto mb-2 mb-lg-0">
              <li class="nav-item mx-2">
                <a class="nav-link active" href="#" aria-current="page">Beranda</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Mobil Kami</a>
              </li>
              <li class="nav-item mx-2">
                <a class="nav-link" href="#">Pemesanan</a>
              </li>
              <li class="nav-item ms-2 me-4">
                <a class="nav-link" href="#">Sign In</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

    <!-- Hero Section -->
    <div class="hero">
      <div class="container-fluid">
        <div class="row no-gutters align-items-center">
          <div class="col-sm-12 col-md-8 col-lg-7 col-xl-6 no-padding">
            <img src="{{ asset('img/img-hero.png') }}" alt="Hero Image" class="img-fluid" />
          </div>
          <div class="col-sm-12 col-md-4 col-lg-5 col-xl-6 pr-5">
            <h1 class="h1-hero-resp">Jelajahi Bandung<br \>dengan <span id="changing-word">Gaskeun.</span></h1>
            <button
                type="button"
                class="btn button-36 btn-lg mt-2 btn-hero-resp"
            >
              Pesan Sekarang
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Hero Section (under 768p) -->
    <!-- <div class="hero">
      <div class="container pt-5">
        <div class="row">
          <div class="col-sm-12 pr-5">
            <h1 class="h1-hero-resp">Jelajahi Bandung<br \>dengan <span id="changing-word">Gaskeun.</span></h1>
            <button
                type="button"
                class="btn button-36 btn-lg mt-2 btn-hero-resp"
            >
              Pesan Sekarang
            </button>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row no-gutters align-items-center">
          <div class="col-sm-12 no-padding">
            <img src="{{ asset('img/img-hero-extended.png') }}" alt="Hero Image Extended" class="img-fluid" />
          </div> 
        </div>
      </div>
    </div> -->

    <!-- Hero Section (under 576 p) -->
    <!-- <div class="hero">
      <div class="container py-5">
        <div class="row">
          <div class="col-sm-12">
            <h1 class="h1-hero-resp">Jelajahi Bandung<br \>dengan <span id="changing-word">Gaskeun.</span></h1>
            <p class="p-hero-resp"></p>
            <button
                type="button"
                class="btn button-36 btn-lg mt-2 btn-hero-resp"
            >
              Pesan Sekarang
            </button>
          </div>
        </div>
      </div>
    </div> -->

    <!-- Kenapa Bandung Section -->
    <div class="kenapa-bandung">
      <div class="container-fluid py-4 pb-5 background-bandung">
        <div class="container">
          <div class="row text-center">
            <h2>Kenapa Bandung?</h2>
            <p>
              Ada banyak alasannya
            </p>
          </div>
          <div class="row mt-3 align-items-center">
            <div class="col-md-12 col-lg-6 col-xl-6">
              <div id="carouselExampleAutoplaying" class="carousel slide carousel-shadow rounded-2" data-bs-ride="carousel">
                <div class="carousel-inner rounded-2">
                  <div class="carousel-item active">
                    <img src="{{ asset('img/img-miniMania.png') }}" class="d-block w-100" alt="Mini Mania Lembang">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('img/img-resto.png') }}" class="d-block w-100" alt="Makanan Sunda Bumbu Desa">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('img/img-braga.png') }}" class="d-block w-100" alt="Braga Malam Hari">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
              </div>
            <div class="col-md-12 col-lg-6 col-xl-6">
                <p><span class="txt-sundanese">Bandung (ᮘᮔ᮪ᮓᮥᮀ)</span> adalah kota yang dipenuhi dengan objek wisata yang membuat kota ini menjadi salah satu magnet wisata utama di Pulau Jawa.</p>
                <p>Kota kembang ini selalu memikat hati para pelacong, dari udara sejuk, pemandangan indah, hingga kuliner yang lezat, Bandung menawarkan pengalaman wisata yang tak terlupakan.</p>
                <p>Rasakan kenyamanan saat Anda dan orang terkasih ada di Bandung. Baik itu liburan keluarga, petualangan bersama teman, atau perjalanan bisnis, kami punya pilihan mobil yang pas untuk setiap momen Anda.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Kenapa Bandung Section (under 992px) -->
    <!-- <div class="kenapa-bandung">
      <div class="container-fluid py-4 pb-5 background-bandung-small">
        <div class="container">
          <div class="row text-center">
            <h2>Kenapa Bandung?</h2>
            <p>
              Ada banyak alasannya
            </p>
          </div>
          <div class="row mt-3 align-items-center">
            <div class="col-md-12 col-lg-6 col-xl-6">
              <div id="carouselExampleAutoplaying" class="carousel slide carousel-shadow rounded-2" data-bs-ride="carousel">
                <div class="carousel-inner rounded-2">
                  <div class="carousel-item active">
                    <img src="{{ asset('img/img-miniMania.png') }}" class="d-block w-100" alt="Mini Mania Lembang">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('img/img-resto.png') }}" class="d-block w-100" alt="Makanan Sunda Bumbu Desa">
                  </div>
                  <div class="carousel-item">
                    <img src="{{ asset('img/img-braga.png') }}" class="d-block w-100" alt="Braga Malam Hari">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
              </div>
            <div class="col-md-12 col-lg-6 col-xl-6 mt-4">
                <p><span class="txt-sundanese">Bandung (ᮘᮔ᮪ᮓᮥᮀ)</span> adalah kota yang dipenuhi dengan objek wisata yang membuat kota ini menjadi salah satu magnet wisata utama di Pulau Jawa.</p>
                <p>Kota kembang ini selalu memikat hati para pelacong, dari udara sejuk, pemandangan indah, hingga kuliner yang lezat, Bandung menawarkan pengalaman wisata yang tak terlupakan.</p>
                <p>Rasakan kenyamanan saat Anda dan orang terkasih ada di Bandung. Baik itu liburan keluarga, petualangan bersama teman, atau perjalanan bisnis, kami punya pilihan mobil yang pas untuk setiap momen Anda.</p>
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <!-- Kenapa Kita Section -->
    <div class="container pt-5 text-center">
      <div class="row">
        <h2>Kenapa Memilih Gaskeun?</h2>
        <p>
          Berikut adalah mengapa kami adalah pilihan terbaik Anda
        </p>
      </div>
      <div class="row mb-5">
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 mt-4">
          <img src="{{ asset("img/icon-lightning.png") }}" class="img-fluid" alt="Lightning" height="10">
          <h4 class="mt-3">Mudah dan Cepat</h4>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 mt-4">
          <img src="{{ asset("img/icon-price.png") }}" class="img-fluid" alt="Lightning" height="10">
          <h4 class="mt-3">Harga Terjangkau</h4>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 mt-4">
          <img src="{{ asset("img/icon-check.png") }}" class="img-fluid" alt="Lightning" height="10">
          <h4 class="mt-3">Kondisi Mobil Prima</h4>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 mt-4">
          <img src="{{ asset("img/icon-smiley.png") }}" class="img-fluid" alt="Lightning" height="10">
          <h4 class="mt-3">Pelayanan Prima</h4>
        </div>
      </div>
    </div>

    <!-- Mobil Kami Section-->
    <div class="container pt-1">
      <div class="row text-center">
        <h2>Armada Kami</h2>
        <p>
          Pilihan mobil yang lengkap untuk setiap perjalanan
        </p>
      </div>
      <div class="row pt-4 pb-5">
        <div class="slick-carousel">
          <div class="card our-car-card pb-3">
            <img src="{{ asset("img/car-zenix.png") }}" class="card-img-top" alt="Innova Zenix">
            <div class="card-body">
              <h5 class="card-title">Toyota<br \>Innova Zenix</h5>
              <p class="card-text">RpXXX.XXX / hari</p>
            </div>
          </div>
          <div class="card our-car-card pb-3">
            <img src="{{ asset("img/car-brio.png") }}" class="card-img-top" alt="Brio">
            <div class="card-body">
              <h5 class="card-title">Honda<br \>Brio</h5>
              <p class="card-text">RpXXX.XXX / hari</p>
            </div>
          </div>
          <div class="card our-car-card pb-3">
            <img src="{{ asset("img/car-cKlasse.png") }}" class="card-img-top" alt="C-Class">
            <div class="card-body">
              <h5 class="card-title">Mercedes<br \>C-Class</h5>
              <p class="card-text">RpXXX.XXX / hari</p>
            </div>
          </div>
          <div class="card our-car-card pb-3">
            <img src="{{ asset("img/car-sigra.png") }}" class="card-img-top" alt="Sigra">
            <div class="card-body">
              <h5 class="card-title">Daihatsu<br \>Sigra</h5>
              <p class="card-text">RpXXX.XXX / hari</p>
            </div>
          </div>
          <div class="card our-car-card pb-3">
            <img src="{{ asset("img/car-tototArogan.png") }}" class="card-img-top" alt="Mobil Arogan">
            <div class="card-body">
              <h5 class="card-title">Mitsubishi<br \>Pajero Sport</h5>
              <p class="card-text">RpXXX.XXX / hari</p>
            </div>
          </div>
          <div class="card our-car-card pb-3">
            <img src="{{ asset("img/car-neunelf.png") }}" class="card-img-top" alt="Porsche 911">
            <div class="card-body">
              <h5 class="card-title">Porsche<br \>911 Cabriolet</h5>
              <p class="card-text">RpXXX.XXX / hari</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Testimony -->
    <div class="container p-4 text-center">
      <h2>Testimonial</h2>
      <p>
        Berbagai review positif dari pelanggan kami
      </p>

      <div class="row mt-4">
        <div class="col-lg-0 col-xl-1"></div>
        <div class="col-lg-12 col-xl-10" align="center">
          <div
            id="carouselTestimonial"
            class="carousel slide"
            data-bs-touch="false"
          >
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div
                  class="card shadow-sm p-3 bg-light rounded testi-width"
                >
                  <div class="row card-body mt-2">
                    <div class="col-xl-1"></div>
                    <div class="col-xl-3 my-2">
                      <img
                        src="{{ asset("img/testi-rans.png") }}"
                        alt="Person"
                        width="149"
                        height="170"
                      />
                    </div>
                    <div class="col-xl-7 my-2">
                      <img
                        src="{{ asset("img/icon-testimonial.png") }}"
                        alt="Rating"
                        width="100"
                      />
                      <p class="mt-3">
                        "Aku dan Nagita baru saja menggunakan jasa rental mobil dari gaskeun ini, untuk liburan di Bandung. Harganya terjangkau dan mobilnya berkualitas. Terima kasih Gaskeunn!!"
                      </p>
                      <p class="fw-semibold">Rafi Ahmad</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div
                  class="card shadow-sm p-3 bg-light rounded testi-width"
                >
                  <div class="row card-body mt-2">
                    <div class="col-xl-1"></div>
                    <div class="col-xl-3 my-2">
                      <img
                        src="{{ asset("img/testi-hotman.png") }}"
                        alt="Person"
                        width="149"
                        height="170"
                      />
                    </div>
                    <div class="col-xl-7 my-2">
                      <img
                        src="{{ asset("img/icon-testimonial.png") }}"
                        alt="Rating"
                        width="100"
                      />
                      <p class="mt-3">
                        "Sewa mobil di Gaskeun mudah sekali, prosesnya cepat, mobilnya bersih, terawat dengan baik, Hotman sangat puas dengan layanan Gaskeun"
                      </p>
                      <p class="fw-semibold">Hotman Paris</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div
                  class="card shadow-sm p-3 bg-light rounded testi-width"
                >
                  <div class="row card-body mt-2">
                    <div class="col-xl-1"></div>
                    <div class="col-xl-3 my-2">
                      <img
                        src="{{ asset("img/testi-andre.png") }}"
                        alt="Person"
                        width="149"
                        height="170"
                      />
                    </div>
                    <div class="col-xl-7 my-2">
                      <img
                        src="{{ asset("img/icon-testimonial.png") }}"
                        alt="Rating"
                        width="100"
                      />
                      <p class="mt-3">
                        "Baru aja camping ke Bandung bareng keluarga pake mobil dari Gaskeun. Harganya murah banget, mobilnya oke. Pokoknya puas banget deh sewa mobil di sini!"
                      </p>
                      <p class="fw-semibold">Andre Taulani</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <button
              class="carousel-control-prev carousel-control-prev-black"
              type="button"
              data-bs-target="#carouselTestimonial"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon carousel-control-icon-black"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next carousel-control-next-black"
              type="button"
              data-bs-target="#carouselTestimonial"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="col-lg-0 col-xl-1"></div>
      </div>
    </div>

    <!-- Footer -->
    <!-- To do later -->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/index.js') }}"></script>
  </body>
</html>