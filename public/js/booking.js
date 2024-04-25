const checkbox = document.getElementById("flexCheckDefault");
const submitButton = document.getElementById("gas-button");

checkbox.addEventListener("change", function () {
    submitButton.disabled = !(this.checked && inputFile.files.length > 0);
});
