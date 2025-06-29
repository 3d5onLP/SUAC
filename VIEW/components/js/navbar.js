document.addEventListener('DOMContentLoaded', function() {

    // --- Dropdown do Perfil ---
    const profileToggle = document.getElementById('profileToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (profileToggle && dropdownMenu) {
        profileToggle.addEventListener('click', function(event) {
            dropdownMenu.classList.toggle('show');
            event.stopPropagation();
        });

    }

    // --- FAB Menu --
    const fabMenu = document.getElementById('fab-menu');
    const navList = document.querySelector('.nav-list'); // Ajuste o seletor se o seu menu responsivo tiver outra classe

    if (fabMenu && navList) {
        fabMenu.addEventListener('click', function (e) {
            navList.classList.toggle('active');
            e.stopPropagation();
        });

    }

    // --- Sistema de avaliação com estrelas ---
    document.querySelectorAll('.stars').forEach(starContainer => {
        const stars = starContainer.querySelectorAll('.star');

        stars.forEach((star, index) => {
            star.addEventListener('click', e => {
                e.stopPropagation();
                const rating = index + 1;
                starContainer.setAttribute('data-rating', rating);
                updateStars(starContainer, rating);
            });
        });

        const initialRating = parseInt(starContainer.dataset.rating) || 0;
        updateStars(starContainer, initialRating);
    });
});

// --- Expansão dos Cards ---
function toggleCard(event, cardElement) {
    if (
        event.target.closest(".star") ||
        event.target.tagName === "BUTTON" ||
        event.target.tagName === "A" ||
        event.target.classList.contains("contact-btn")
    ) {
        event.stopPropagation();
        return;
    }

    const isCurrentlyExpanded = cardElement.classList.contains("expanded");

    document.querySelectorAll(".card.expanded").forEach(otherCard => {
        if (otherCard !== cardElement) {
            otherCard.classList.remove("expanded");
        }
    });

    cardElement.classList.toggle("expanded", !isCurrentlyExpanded);
}

// --- Fechar cards E DROPDOWN ao clicar fora ---
document.addEventListener("click", function (e) {
    const clickedInsideCard = e.target.closest(".card"); 
    const clickedInsideDropdown = e.target.closest(".profile-menu");
    const clickedInsideFabMenu = e.target.closest("#fab-menu");
    const clickedInsideNavList = e.target.closest(".nav-list"); 

    // Fecha o dropdown do perfil se o clique não foi dentro dele ou do toggle
    if (!clickedInsideDropdown) {
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (dropdownMenu && dropdownMenu.classList.contains('show')) {
            dropdownMenu.classList.remove('show');
        }
    }

    // Fecha o menu FAB se o clique não foi dentro dele ou do botão
    if (!clickedInsideFabMenu && !clickedInsideNavList) {
        const navList = document.querySelector('.nav-list');
        if (navList && navList.classList.contains('active')) {
            navList.classList.remove('active');
        }
    }

    // Fecha os cards expandidos 
    if (!clickedInsideCard) { 
        document.querySelectorAll(".card.expanded").forEach(card => {
            card.classList.remove("expanded");
        });
    }
});

function updateStars(container, rating) {
    const stars = container.querySelectorAll('.star');
    stars.forEach((star, i) => {
        star.classList.toggle('active', i < rating);
    });
}