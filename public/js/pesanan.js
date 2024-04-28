// sidebar stuff START
function toggleSidebar() {
    const sidebar = document.querySelector("#sidebar");
    const logoImg = document.getElementById("logo-img");
    const viewportWidth = window.innerWidth;
    const mainContent = document.querySelector(".main");

    if (viewportWidth < 900) {
        sidebar.classList.remove("expand");
        logoImg.src = "../../img/favicon.png";
        mainContent.style.marginLeft = "70px";
    } else {
        sidebar.classList.add("expand");
        logoImg.src = "../../img/logo-navbar.png";
        mainContent.style.marginLeft = "210px";
    }
}
toggleSidebar();
window.addEventListener("resize", toggleSidebar);
document.addEventListener("DOMContentLoaded", function() {
    const initialFocus = document.getElementById("initialFocus");
    initialFocus.classList.add("active");
});
document.addEventListener("DOMContentLoaded", function() {
    const sidebarLinks = document.querySelectorAll(".sidebar-link");
    sidebarLinks.forEach(function(link) {
        link.addEventListener("click", function() {
            sidebarLinks.forEach(function(link) {
                link.classList.remove("active");
            });
            this.classList.add("active");
        });
    });
});
// sidebar stuff END




// sim preview START
document.addEventListener('DOMContentLoaded', function() {
    const modalTriggerElements = document.querySelectorAll('.modal-trigger');
    const modalImage = document.getElementById('modalImage');

    modalTriggerElements.forEach(function(element) {
      element.addEventListener('click', function() {
        const imageUrl = this.getAttribute('data-image-url');
        modalImage.src = imageUrl;
      });
    });
  });
// sim preview END
