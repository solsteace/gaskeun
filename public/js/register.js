function password_show_hide(elmId) {
    var x = document.getElementById(elmId);
    var show_eye = document.getElementById(`show_eye_${elmId}`);
    var hide_eye = document.getElementById(`hide_eye_${elmId}`);
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}

let form = document.getElementById("registerForm")
let button = document.getElementById("registerForm__submit")
button.addEventListener("click", async(e) => {
    e.preventDefault();

    let formIsValid = true;
    let elem;
    let warningElem;

    // Check if it's fulfilled
    ["inputNamaLengkap", "inputEmail", "inputPassword", "inputKonfirmasiPassword"].forEach((entry) => {
        elem = document.getElementById(`${entry}`)

        warningElem = document.getElementById(`warning__${entry}`);
        warningElem.textContent = ""
        if (elem.validity.valueMissing) {
            warningElem.textContent = "Wajib diisi"
        }

        formIsValid = formIsValid && !elem.validity.valueMissing;
    })

    // Check email
    elem = document.getElementById("inputEmail")
    warningElem = document.getElementById(`warning__inputEmail`);
    if (elem.validity.typeMismatch) {
        warningElem.textContent = "Masukkan email yang valid"
        formIsValid = false;
    }

    // Check password == confirmPassword
    elem = document.getElementById("inputPassword")
    warningElem = document.getElementById(`warning__inputKonfirmasiPassword`);
    let elemConfirmPass = document.getElementById("inputKonfirmasiPassword")
    if (elem.value != "" && (elem.value != elemConfirmPass.value)) {
        warningElem.textContent = "Password dan konfirmasi password tidak sama"
        formIsValid = false;
    }

    // Password too short 
    elem = document.getElementById("inputPassword")
    warningElem = document.getElementById(`warning__inputPassword`);
    if (elem.validity.tooShort) {
        warningElem.textContent = "Password minimal 8 karakter"
        formIsValid = false;
    }
})