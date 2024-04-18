const checkbox = document.getElementById('flexCheckDefault');
const submitButton = document.getElementById('gas-button');

const dropArea = document.getElementById("drop-area");
const inputFile = document.getElementById("input-file");
const imgView = document.getElementById("img-view");

inputFile.addEventListener('change',uploadImage);

function uploadImage() {
    let imgLink = URL.createObjectURL(inputFile.files[0]);
    imgView.style.backgroundImage = `url(${imgLink})`;
    imgView.textContent = "";
    imgView.style.border = 0;
    checkbox.dispatchEvent(new Event('change'));
}

dropArea.addEventListener('dragover',function(e){
    e.preventDefault();
});
dropArea.addEventListener('drop',function(e){
    e.preventDefault();
    inputFile.files = e.dataTransfer.files;
    uploadImage();
});

checkbox.addEventListener('change', function() {
    submitButton.disabled = !(this.checked && inputFile.files.length > 0);
});