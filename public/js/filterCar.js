// Date input formats
flatpickr("#start-date", {
    dateFormat: "d-m-Y",
    minDate: "today",
    maxDate: new Date().fp_incr(60),
});

flatpickr("#end-date", {
    dateFormat: "d-m-Y",
    minDate: "today",
    maxDate: new Date().fp_incr(60),
});

// Harga mobil slider
var hargaMobilSlider = document.getElementById("harga-mobil");

noUiSlider.create(hargaMobilSlider, {
    start: [0, 999999],
    connect: true,
    step: 1000,
    range: {
        min: 0,
        max: 999999,
    },
    format: wNumb({
        decimals: 0,
        thousand: ".",
    }),
});

var hargaMobilMin = document.getElementById("harga-mobil-min");
var hargaMobilMax = document.getElementById("harga-mobil-max");

hargaMobilSlider.noUiSlider.on("update", function (values, handle) {
    var value = values[handle];
    if (handle) {
        hargaMobilMax.value = value;
    } else {
        hargaMobilMin.value = value;
    }
});

hargaMobilMin.addEventListener("change", function () {
    hargaMobilSlider.noUiSlider.set([this.value, null]);
});

hargaMobilMax.addEventListener("change", function () {
    hargaMobilSlider.noUiSlider.set([null, this.value]);
});

// Data validation
const searchButton = document.getElementById("searchButton");
const startDateInput = document.getElementById("start-date");
const endDateInput = document.getElementById("end-date");
const errorMessage = document.getElementById("error-message");

function convertDateFormat(input) {
    // Return reformatted date format to US format (MM-DD-YYYY)
    let [day, month, year] = input.split("-");
    return `${month}-${day}-${year}`;
}

function convertDateFormatYMD(input) {
    // Return reformatted date format to US format (MM-DD-YYYY)
    let [day, month, year] = input.split("-");
    return `${year}-${month}-${day}`;
}

function generateCarCard(data) {
    const activeBook = data.pesanan
                            .filter(entry => entry["status"] == "belum_selesai")
    const carIsAvailable = (
        data.status == "tersedia" &&
        (
            data.pesanan.length == 0
            || activeBook.length == 0
        )
    )

    const div0 = document.createElement("div");
    ["col-md-6", "col-lg-4", "col-xl-3", "pt-4"]
        .forEach(elemClass => div0.classList.add(elemClass));

    const div1 = document.createElement("div");
    ["card", "shadow", "bg-white", "card-container"]
        .forEach(elemClass => div1.classList.add(elemClass));
    
    const div2_0 = document.createElement("div");
    if(carIsAvailable) {
        div2_0.textContent = "Tersedia";
        ["card-header", "text-center", "bg-success", "text-white"]
            .forEach(elemClass => div2_0.classList.add(elemClass));
    } else {
        div2_0.textContent = (activeBook.length == 0?
                            "Sementara tidak ditawarkan"
                            : `Akan tersedia pada ${activeBook[0].tanggal_pengembalian}`
        );

        ["card-header", "text-center", "bg-danger", "text-white"]
            .forEach(elemClass => div2_0.classList.add(elemClass));
    }

    const div2_1 = document.createElement("div");
    ["overlay", "rounded-1", "shadow"]
        .forEach(elemClass => div2_1.classList.add(elemClass));

    const img = document.createElement("img");
    img.src = `/storage/${data.carImgPath}`;
    img.id = "car-image";
    img.alt = "Car Image";
    ["card-img-top", "rounded-0", "card-image"]
        .forEach(elemClass => img.classList.add(elemClass));

    const div2_2 = document.createElement("div");
    ["p-3", "card-content"].forEach(elemClass => div2_2.classList.add(elemClass));
  
    const h5 = document.createElement("h5");
    h5.innerHTML = `${data.brand} <br> ${data.model}`;
    ["card-title", "fw-semibold"].forEach(elemClass => h5.classList.add(elemClass));

    const p3_0 = document.createElement("p");
    p3_0.textContent = `Rp. ${data.harga_sewa}/hari`;
    p3_0.classList.add("card-price");

    const div3_0 = document.createElement("div");
    div3_0.style = "display: flex;";

    const div4_0 = document.createElement("div");
    div4_0.style = "width: 40px;";

    const i5_0 = document.createElement("i");
    ["fa-solid", "fa-users"].forEach(elemClass => i5_0.classList.add(elemClass));

    const p4_0 = document.createElement("p");
    p4_0.textContent = `${data.kapasitas} orang`;
    ["fw-medium"].forEach(elemClass => p4_0.classList.add(elemClass));


    const div3_1 = document.createElement("div");
    div3_1.style = "display: flex;";

    const div4_1 = document.createElement("div");
    div4_1.style = "width: 40px;";

    const i5_1 = document.createElement("i");
    ["fa-solid", "fa-gear"].forEach(elemClass => i5_1.classList.add(elemClass));

    const p4_1 = document.createElement("p");
    p4_1.textContent = `${data.transmisi}`;
    ["fw-medium"].forEach(elemClass => p4_1.classList.add(elemClass));


    const div3_2 = document.createElement("div");
    div3_2.style = "display: flex;";

    const div4_2 = document.createElement("div");
    div4_2.style = "width: 40px;";

    const i5_2 = document.createElement("i");
    ["fa-solid", "fa-gas-pump"].forEach(elemClass => i5_2.classList.add(elemClass));

    const p4_2 = document.createElement("p");
    p4_2.textContent = `${data.bahan_bakar}`;
    ["fw-medium"].forEach(elemClass => p4_2.classList.add(elemClass));


    const div3_3 = document.createElement("div");
    ["d-grid", "pt-2"].forEach(elemClass => div3_3.classList.add(elemClass));
    
    const button = document.createElement("button");
    button.type = "button";
    button.disabled = !carIsAvailable;
    button.textContent = "Pesan";
    if(carIsAvailable) {
        const a = document.createElement("a");
        a.href = `/booking?carId=${data.id}`;
        a.style.textDecoration = "none";
        a.style.color = "white";
        a.textContent = "Pesan"

        button.innerHTML = "";
        button.appendChild(a);

        ["btn", "button-36"]
            .forEach(elemClass => button.classList.add(elemClass));
    } else {
        ["btn", "button-36-disabled", "text-white-50"]
            .forEach(elemClass => button.classList.add(elemClass));
    }

    div3_3.appendChild(button);
    div4_2.appendChild(i5_2);
    [div4_2, p4_2].forEach(elem => div3_2.appendChild(elem));
    div4_1.appendChild(i5_1);
    [div4_1, p4_1].forEach(elem => div3_1.appendChild(elem));
    div4_0.appendChild(i5_0);
    [div4_0, p4_0].forEach(elem => div3_0.appendChild(elem));

    [h5, p3_0, div3_0, div3_1, div3_2, div3_3]
        .forEach(elem => div2_2.appendChild(elem));

    [div2_0, div2_1, img, div2_2]
        .forEach(elem => {
            if( !(carIsAvailable && elem == div2_1) ) {
                div1.appendChild(elem)
            }
        });

    div0.appendChild(div1);
    return div0;;
}

searchButton.addEventListener("click", async() => {
    const startDate = new Date(convertDateFormat(startDateInput.value));
    const endDate = new Date(convertDateFormat(endDateInput.value));

    if (endDate < startDate) {
        const invalidDates = document.getElementsByClassName("invalid-date");
        for (var i = 0; i < invalidDates.length; i++) {
            invalidDates[i].style.display = "block";
        }
    } else {
        const invalidDates = document.getElementsByClassName("invalid-date");
        for (var i = 0; i < invalidDates.length; i++) {
            invalidDates[i].style.display = "none";
        }

        const minPriceInput = document.getElementById("harga-mobil-min");
        const maxPriceInput = document.getElementById("harga-mobil-max");
        const numPassengersInput = document.getElementById("jumlah-penumpang");
        const transmissionSelect = document.getElementById("transmisi");
        const brandSelect = document.getElementById("brand-mobil");

        // startDate (udh dideclare di atas) (format: MM-DD-YYYY)
        // endDate (udh dideclare di atas)
        const minPrice = Number(minPriceInput.value);
        const maxPrice = Number(maxPriceInput.value);
        const numPassengers = Number(numPassengersInput.value);
        const transmission = transmissionSelect.value;
        const brand = brandSelect.value;

        // To do: Query (Adjust its data with the one retrieved from form)
        await fetch("/api/mobilFilter", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8" },
            body: Object.entries({  
                    "brand": brand == "anyBrand"? null: brand,
                    "transmission" : transmission == "anyTransmission"? null: transmission, 
                    "numPassengers" : numPassengers,
                    "minPrice": minPrice*1000, // Somehow the FE returns a float
                    "maxPrice": maxPrice*1000, // Somehow the FE returns a float
                    "startDate": startDateInput.value == ""? null: convertDateFormatYMD(startDateInput.value),
                    "endDate": endDateInput.value == ""? null: convertDateFormatYMD(endDateInput.value)
                }).map(([key, value]) => 
                    value == null? null : `${encodeURIComponent(key)}=${encodeURIComponent(value)}`
                ).filter(value => value != null)
                 .join("&")
        }).then(res => {
            if(!res.ok) throw new Error("Something is wrong")
            return res.json();
        }).then(res => {
            // To do: Display the cards
            const carList = document.getElementById("availableCars")
            carList.innerHTML = "";
            Object.entries(res).forEach(([_, data]) => {
                data["transmisi"] = data["transmisi"][0].toUpperCase() + data["transmisi"].substring(1);
                data["bahan_bakar"] = data["bahan_bakar"][0].toUpperCase() + data["bahan_bakar"].substring(1);
                carList.appendChild(generateCarCard(data))
            })
        })
        .catch(err => console.log(err))

    }
});
