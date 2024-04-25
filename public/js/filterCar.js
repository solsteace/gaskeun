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

searchButton.addEventListener("click", () => {
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

        // To do: Query
        // To do: Display the cards
    }
});
