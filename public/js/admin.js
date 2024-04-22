const navLinks = document.querySelectorAll('.nav-link');
navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
        // Remove active class from all siblings
        navLinks.forEach(sibling => sibling.classList.remove('active'));

        // Add active class to the clicked element
        this.classList.add('active');

    });

});