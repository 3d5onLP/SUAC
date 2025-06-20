document.addEventListener('DOMContentLoaded', function() {

    // --- Dropdown do Perfil ---
    const profileToggle = document.getElementById('profileToggle');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (profileToggle && dropdownMenu) {
        profileToggle.addEventListener('click', function(event) {
            dropdownMenu.classList.toggle('show');
            event.stopPropagation();
        });

        document.addEventListener('click', function(event) {
            if (!profileToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.remove('show');
            }
        });
    }

    // --- FAB Menu ---
    const fabMenu = document.getElementById('fab-menu');
    const navList = document.querySelector('.nav-list');

    if (fabMenu && navList) {
        fabMenu.addEventListener('click', function (e) {
            navList.classList.toggle('active');
            e.stopPropagation();
        });

        document.addEventListener('click', function (event) {
            if (!navList.contains(event.target) && !fabMenu.contains(event.target)) {
                navList.classList.remove('active');
            }
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

// --- Fechar cards ao clicar fora ---
document.addEventListener("click", function (e) {
    const clickedInsideCard = e.target.closest(".card");
    const clickedInsideDropdown = e.target.closest(".profile-menu");

    if (!clickedInsideCard && !clickedInsideDropdown) {
        document.querySelectorAll(".card.expanded").forEach(card => {
            card.classList.remove("expanded");
        });
    }
});

// --- Função auxiliar para atualizar as estrelas ---
function updateStars(container, rating) {
    const stars = container.querySelectorAll('.star');
    stars.forEach((star, i) => {
        star.classList.toggle('active', i < rating);
    });
}
