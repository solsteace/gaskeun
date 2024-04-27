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

// Image upload
const dropArea = document.getElementById("drop-area");
const inputFile = document.getElementById("input-file");
const imgView = document.getElementById("img-view");

inputFile.addEventListener("change", uploadImage);

function uploadImage() {
    let imgLink = URL.createObjectURL(inputFile.files[0]);
    imgView.style.backgroundImage = `url(${imgLink})`;
    imgView.textContent = "";
    imgView.style.border = 0;
    imgView.style.width = "300px";
    // checkbox.dispatchEvent(new Event("change"));
}

dropArea.addEventListener("dragover", function (e) {
    e.preventDefault();
});

dropArea.addEventListener("drop", function (e) {
    e.preventDefault();
    inputFile.files = e.dataTransfer.files;
    uploadImage();
});

// Maps
var southWest = L.latLng(-11.0086, 95.0129),
    northEast = L.latLng(-8.225, 103.008),
    bounds = L.latLngBounds(southWest, northEast);

var lastClickedLocationPickUp = null;
var lastClickedLocationDropOff = null;
var markerPickUp = null;
var markerDropOff = null;

// Pickup Map
document.getElementById("pickup-toggle").addEventListener("click", function () {
    var map = L.map("pickup-map", {
        maxZoom: 20,
    }).setView([-6.9143518, 107.6024663], 15);

    if (lastClickedLocationPickUp) {
        map.removeLayer(markecomrPickUp);
    }

    L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution:
            '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);

    // Trik biar map-nya refresh (force resize window), karena kalo engga map-nya laggy af
    setTimeout(function () {
        window.dispatchEvent(new Event("resize"));
    }, 1000);

    map.on("click", function (event) {
        lastClickedLocationPickUp = event.latlng;

        if (markerPickUp) {
            map.removeLayer(markerPickUp);
        }

        markerPickUp = L.marker(lastClickedLocationPickUp).addTo(map);
    });

    document
        .getElementById("pickup-confirm")
        .addEventListener("click", function () {
            if (lastClickedLocationPickUp) {
                fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lastClickedLocationPickUp.lat}&lon=${lastClickedLocationPickUp.lng}`
                )
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById("pickup-location").value =
                            data.display_name;
                    })
                    .catch((error) => console.error(error));
            }
        });
});

// Dropoff Map
document
    .getElementById("dropoff-toggle")
    .addEventListener("click", function () {
        var map = L.map("dropoff-map", {
            maxZoom: 20,
        }).setView([-6.9143518, 107.6024663], 15);

        if (lastClickedLocationDropOff) {
            map.removeLayer(markerDropOff);
        }

        L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        }).addTo(map);

        // Trik biar map-nya refresh (force resize window), karena kalo engga map-nya laggy af
        setTimeout(function () {
            window.dispatchEvent(new Event("resize"));
        }, 1000);

        // Add a click event listener to the map
        map.on("click", function (event) {
            // Save the clicked location
            lastClickedLocationDropOff = event.latlng;

            // Remove the old marker if it exists
            if (markerDropOff) {
                map.removeLayer(markerDropOff);
            }

            // Add a new marker at the clicked location
            markerDropOff = L.marker(lastClickedLocationDropOff).addTo(map);
        });

        // Add a click event listener to the button
        document
            .getElementById("dropoff-confirm")
            .addEventListener("click", function () {
                // Save the last clicked location when the button is clicked
                if (lastClickedLocationDropOff) {
                    fetch(
                        `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lastClickedLocationDropOff.lat}&lon=${lastClickedLocationDropOff.lng}`
                    )
                        .then((response) => response.json())
                        .then((data) => {
                            document.getElementById("dropoff-location").value =
                                data.display_name;
                        })
                        .catch((error) => console.error(error));
                }
            });
    });

// Data validation
function convertDateFormat(input) {
    // Return reformatted date format to US format (MM-DD-YYYY)
    let [day, month, year] = input.split("-");
    return `${month}-${day}-${year}`;
}

document
    .getElementById("confirmButton")
    .addEventListener("click", async function(event) {
        // Prevent the form from being submitted
        event.preventDefault();

        // Reset to initial state
        document.getElementById("confirmationPopUp__back").style.display = "none";
        document.getElementById("confirmationPopUp__close").disabled = true;
        document.getElementById("confirmButton").disabled = true;
        document.getElementById("confirmationPopUp__msgTop")
                .textContent = "Pesanan anda sedang diproses!";
        document.getElementById("confirmationPopUp__msgBottom")
                .textContent = "Mohon menunggu hingga proses selesai";

        var name = document.getElementById("nama-lengkap");
        var email = document.getElementById("email");
        var phone = document.getElementById("no-telp");
        var startDate = document.getElementById("start-date");
        var endDate = document.getElementById("end-date");
        var phone = document.getElementById("phone");
        var emergencyPhone = document.getElementById("phone-emergency");
        var simFile = document.getElementById("input-file");
        var agreementCheckbox = document.getElementById("setuju");
        var pickupX = 0.0;
        var pickupY = 0.0;
        var dropoffX = 0.0;
        var dropoffY = 0.0;

        var emailRegex = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        var phoneRegex = /^08[0-9]{6,}$/;

        let isValid = true;

        if (name.value === "") {
            document.getElementById("empty-name").style.display = "block";
        } else {
            document.getElementById("empty-name").style.display = "none";
        }

        if (email.value === "") {
            document.getElementById("empty-email").style.display = "block";
        } else if (!emailRegex.test(email.value)) {
            document.getElementById("empty-email").style.display = "none";
            document.getElementById("invalid-email").style.display = "block";
            isValid = false;
        } else {
            document.getElementById("empty-email").style.display = "none";
            document.getElementById("invalid-email").style.display = "none";
        }

        if (lastClickedLocationPickUp !== null) {
            pickupX = lastClickedLocationPickUp.lat;
            pickupY = lastClickedLocationPickUp.lng;
        }

        if (lastClickedLocationDropOff !== null) {
            dropoffX = lastClickedLocationDropOff.lat;
            dropoffY = lastClickedLocationDropOff.lng;
        }

        if (startDate.value === "") {
            document.getElementById("empty-start-date").style.display = "block";
            isValid = false;
        } else {
            document.getElementById("empty-start-date").style.display = "none";
        }

        if (endDate.value === "") {
            document.getElementById("empty-return-date").style.display =
                "block";
            isValid = false;
        } else {
            document.getElementById("empty-return-date").style.display = "none";
        }

        if (isValid) {
            const startDateValue = new Date(convertDateFormat(startDate.value));
            const endDateValue = new Date(convertDateFormat(endDate.value));

            if (endDateValue < startDateValue) {
                const invalidDates =
                    document.getElementsByClassName("invalid-date");
                for (var i = 0; i < invalidDates.length; i++) {
                    invalidDates[i].style.display = "block";
                }
                isValid = false;
            } else {
                const invalidDates =
                    document.getElementsByClassName("invalid-date");
                for (var i = 0; i < invalidDates.length; i++) {
                    invalidDates[i].style.display = "none";
                }
            }
        }

        if (phone.value === "") {
            document.getElementById("empty-phone").style.display = "block";
        } else if (!phoneRegex.test(phone.value)) {
            document.getElementById("empty-phone").style.display = "none";
            document.getElementById("invalid-phone").style.display = "block";
            isValid = false;
        } else {
            document.getElementById("empty-phone").style.display = "none";
            document.getElementById("invalid-phone").style.display = "none";
        }

        if (emergencyPhone.value === "") {
            document.getElementById("empty-phone-darurat").style.display =
                "block";
        } else if (!phoneRegex.test(emergencyPhone.value)) {
            document.getElementById("empty-phone-darurat").style.display =
                "none";
            document.getElementById("invalid-phone-darurat").style.display =
                "block";
            isValid = false;
        } else if (emergencyPhone.value === phone.value) {
            document.getElementById("empty-phone-darurat").style.display =
                "none";
            document.getElementById("invalid-phone-darurat").style.display =
                "none";
            document.getElementById("same-phone-darurat").style.display =
                "block";
            isValid = false;
        } else {
            document.getElementById("empty-phone-darurat").style.display =
                "none";
            document.getElementById("invalid-phone-darurat").style.display =
                "none";
        }

        if (simFile.files.length === 0) {
            document.getElementById("empty-file").style.display = "block";
            isValid = false;
        } else {
            document.getElementById("empty-file").style.display = "none";
        }

        if (!agreementCheckbox.checked) {
            document.getElementById("empty-setuju").style.display = "block";
        } else {
            document.getElementById("empty-setuju").style.display = "none";
        }

        if (isValid) {
            console.log("Name: ", name.value);
            console.log("Email: ", email.value);
            console.log("Phone: ", phone.value);
            console.log("Start Date: ", startDate.value);
            console.log("End Date: ", endDate.value);
            console.log("Emergency Phone: ", emergencyPhone.value);
            console.log("SIM File: ", simFile.value);

            if (pickupX !== 0.0 && pickupY !== 0.0) {
                console.log("Pickup coordinate: ", pickupX, pickupY);

                const pickupLink = `https://www.google.com/maps/place/${pickupX},${pickupY}`;
                console.log(pickupLink);
            } else {
                // datanya jadi null
            }

            if (dropoffX !== 0.0 && dropoffY !== 0.0) {
                console.log("Dropoff coordinate: ", dropoffX, dropoffY);

                const dropoffLink = `https://www.google.com/maps/place/${dropoffX},${dropoffY}`;
                console.log(dropoffLink);
            } else {
                // datanya jadi null
            }
        }

        /* TODO: Move this to the section where all input have been verified */
        // Ref: https://stackoverflow.com/questions/35325370/how-do-i-post-a-x-www-form-urlencoded-request-using-fetch
        const pembayaranId = (
            await fetch("/api/pembayaran", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8" },
                body: [`${encodeURIComponent("status")}=${encodeURIComponent("belum_lunas")}`]
            }).then(res => {
                if(!res.ok) throw new Error("Something is wrong");
                return res.json();
            }).then(res => res.insertID)
            .catch(err => {
                document.getElementById("confirmationPopUp__msgTop")
                        .textContent = "Mohon maaf, pesanan Anda gagal diproses";
                document.getElementById("confirmationPopUp__msgBottom")
                        .textContent = "Silakan perbarui laman dan lakukan pemesanan kembali";
            })
        )

        if(pembayaranId != undefined) {
            const formData = new FormData();
            Object.entries({  // Change into data retrieved from form
                "id_pemesan": LOGGED_USER, 
                "id_mobil": BOOKED_CAR, 
                "id_pembayaran": pembayaranId,
                "SIM_peminjam" : document.getElementById("input-file").files[0], 
                "nama_peminjam" : "Jono Surono",
                "tanggal_peminjaman" : "2024-02-01", 
                "tanggal_pengembalian" : "2024-03-01",
                "titik_antar": `${pickupX} ${pickupY}`, 
                "titik_jemput" : `${dropoffX} ${dropoffY}`
            }).map(([key, value]) => {
                formData.append(key, value)
            });

            console.log(formData)

            await fetch("/api/pesanan", {
                method: "POST",
                body:  formData           
            }).then(res => {
                if(!res.ok) throw new Error("Something is wrong");

                document.getElementById("confirmationPopUp__back").style.display = "auto";
                document.getElementById("confirmationPopUp__msgTop")
                        .textContent = "Terima Kasih, pesanan Anda telah kami terima.";
                document.getElementById("confirmationPopUp__msgBottom")
                        .textContent = "Silahkan cek email Anda untuk melanjutkan proses pembayaran.";
                return res.json()
            }).then(res => console.log(res))
            .catch(err => {
                document.getElementById("confirmationPopUp__msgTop")
                        .textContent = "Mohon maaf, pesanan Anda gagal diproses";
                document.getElementById("confirmationPopUp__msgBottom")
                        .textContent = "Silakan perbarui laman dan lakukan pemesanan kembali";
            })
        }

    document.getElementById("confirmationPopUp__close").disabled = false;
    document.getElementById("confirmButton").disabled = false;
});
