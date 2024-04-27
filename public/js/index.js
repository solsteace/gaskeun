$(document).ready(function () {
    $(".btn-hero-resp").click(function () {
        window.location.href = "/cars";
    });
});

// Dynamic wording for the hero section
var words = [
    "<span class='changing-word-width'>Keluarga.</span>",
    "<span class='changing-word-width'>Nyaman.</span>",
    "<span class='changing-word-width'>Gaya.&nbsp;</span>",
];
var index = 0;
function changeWord() {
    var cw = document.getElementById("changing-word");
    cw.style.opacity = "0";
    setTimeout(function () {
        cw.innerHTML = words[index];
        cw.style.opacity = "1";
        index++;
        if (index == words.length) index = 0;
    }, 1000);
}
setInterval(changeWord, 4000);

// Slick carousel for the "armada kami" section
$(document).ready(function () {
    var slider = $(".slick-carousel");

    slider.slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        prevArrow:
            '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow:
            '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        centerMode: true,
        centerPadding: "60px",
        focusOnSelect: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerMode: false,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    centerMode: false,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    centerMode: false,
                },
            },
        ],
    });

    setInterval(function () {
        slider.slick("slickPrev");
    }, 5000); // Autoplay speed
});

// Temporary hide the testimonial carousel control icons
document
    .querySelectorAll(
        ".carousel-control-next-black, .carousel-control-prev-black"
    )
    .forEach(function (button) {
        button.addEventListener("click", function () {
            document
                .querySelectorAll(
                    ".carousel-control-next-black, .carousel-control-prev-black"
                )
                .forEach(function (btn) {
                    btn.classList.add("hidden");
                });

            setTimeout(function () {
                document
                    .querySelectorAll(
                        ".carousel-control-next-black, .carousel-control-prev-black"
                    )
                    .forEach(function (btn) {
                        btn.classList.remove("hidden");
                    });
            }, 700);
        });
    });

// Responsive divs content
var originalHero = `
<div class="container-fluid">
    <div class="row no-gutters align-items-center">
        <div class="col-sm-12 col-md-8 col-lg-7 col-xl-6 no-padding">
            <img src="${imgHero}" alt="Hero Image" class="img-fluid" />
        </div>
        <div class="col-sm-12 col-md-4 col-lg-5 col-xl-6 pr-5">
            <h1 class="h1-hero-resp">Jelajahi Bandung<br \>dengan <span id="changing-word">Gaskeun.</span></h1>
            <p class="p-hero-resp"></p>
            <button type="button" class="btn button-36 btn-lg mt-2 btn-hero-resp">Pesan Sekarang</button>
        </div>
    </div>
</div>
`;
var originalKenapaBandung = `
<div class="container-fluid py-4 pb-5 background-bandung">
    <div class="container">
        <div class="row text-center">
            <h2>Kenapa Bandung?</h2>
            <p>Ada banyak alasannya</p>
        </div>
        <div class="row mt-3 align-items-center">
            <div class="col-md-12 col-lg-6 col-xl-6">
                <div id="carouselExampleAutoplaying" class="carousel slide carousel-shadow rounded-2" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-2">
                        <div class="carousel-item active">
                            <img src="${imgMiniMania}" class="d-block w-100" alt="Mini Mania Lembang">
                        </div>
                        <div class="carousel-item">
                            <img src="${imgResto}" class="d-block w-100" alt="Makanan Sunda Bumbu Desa">
                        </div>
                        <div class="carousel-item">
                            <img src="${imgBraga}" class="d-block w-100" alt="Braga Malam Hari">
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
`;

$(window).on("load resize", function () {
    var windowSize = $(window).width();

    // Hero content adjustment
    if (windowSize < 576) {
        $(".hero").html(`
        <div class="container py-5">
            <div class="row">
                <div class="col-sm-12">
                    <h1 class="h1-hero-resp">Jelajahi Bandung<br \>dengan <span id="changing-word">Gaskeun.</span></h1>
                    <p class="p-hero-resp"></p>
                    <button type="button" class="btn button-36 btn-lg mt-2 btn-hero-resp">Pesan Sekarang</button>
                </div>
            </div>
        </div>
    `);
    } else if (windowSize < 768) {
        $(".hero").html(`
        <div class="container pt-5">
            <div class="row">
                <div class="col-sm-12 pr-5">
                    <h1 class="h1-hero-resp">Jelajahi Bandung<br \>dengan <span id="changing-word">Gaskeun.</span></h1>
                    <p class="p-hero-resp"></p>
                    <button type="button" class="btn button-36 btn-lg mt-2 btn-hero-resp">Pesan Sekarang</button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row no-gutters align-items-center">
                <div class="col-sm-12 no-padding">
                    <img src="${imgHeroExtended}" alt="Hero Image Extended" class="img-fluid" />
                </div> 
            </div>
        </div>
    `);
    } else {
        $(".hero").html(originalHero);
    }

    // Kenapa Bandung content adjustment
    if (windowSize < 992) {
        $(".kenapa-bandung").html(`
        <div class="container-fluid py-4 pb-5 background-bandung-small">
            <div class="container">
                <div class="row text-center">
                    <h2>Kenapa Bandung?</h2>
                    <p>Ada banyak alasannya</p>
                </div>
                <div class="row mt-3 align-items-center">
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <div id="carouselExampleAutoplaying" class="carousel slide carousel-shadow rounded-2" data-bs-ride="carousel">
                            <div class="carousel-inner rounded-2">
                                <div class="carousel-item active">
                                    <img src="${imgMiniMania}" class="d-block w-100" alt="Mini Mania Lembang">
                                </div>
                                <div class="carousel-item">
                                    <img src="${imgResto}" class="d-block w-100" alt="Makanan Sunda Bumbu Desa">
                                </div>
                                <div class="carousel-item">
                                    <img src="${imgBraga}" class="d-block w-100" alt="Braga Malam Hari">
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
    `);
    } else {
        $(".kenapa-bandung").html(originalKenapaBandung);
    }

    // Font size adjustment
    if (windowSize < 576) {
        $(".h1-hero-resp").css("font-size", "4em");
    } else if (windowSize < 768) {
        $(".h1-hero-resp").css("font-size", "3.6em");
    } else if (windowSize < 900) {
        $(".h1-hero-resp").css("font-size", "3.2em");
    } else if (windowSize < 1040) {
        $(".h1-hero-resp").css("font-size", "3.6em");
    } else if (windowSize < 1090) {
        $(".h1-hero-resp").css("font-size", "3.8em");
    } else if (windowSize < 1276) {
        $(".h1-hero-resp").css("font-size", "4em");
    } else {
        $(".h1-hero-resp").css("font-size", "4.3em");
    }
});
