const checkbox = document.getElementById("flexCheckDefault");
const submitButton = document.getElementById("gas-button");
const warningDiv = document.querySelector(".text-danger");

checkbox.addEventListener("change", function () {
    submitButton.disabled = !this.checked;
    if (this.checked) {
        warningDiv.style.display = "none";
    }
});


submitButton.addEventListener("click", function (event) {
    if (!checkbox.checked) {
        event.preventDefault();
        warningDiv.style.display = "block";
    }
});