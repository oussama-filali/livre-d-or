document.addEventListener("DOMContentLoaded", function () {
    // Gestion du modal
    const modal = document.querySelector(".login-modal");
    const btn = document.querySelector(".login-btn");
    const span = document.querySelector(".close");

    btn.onclick = () => modal.style.display = "block";
    span.onclick = () => modal.style.display = "none";
    window.onclick = (event) => {
        if (event.target === modal) modal.style.display = "none";
    };

    // Gestion des onglets
    window.openTab = function(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Ouvrir l'onglet par défaut
    document.getElementById("defaultOpen").click();

    // Défilement automatique des images
    const images = document.querySelectorAll('.image-container img');
    let currentIndex = 0;

    function showNextImage() {
        images[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].classList.add('active');
    }

    setInterval(showNextImage, 3000); // Changer d'image toutes les 3 secondes
});