document.addEventListener('DOMContentLoaded', function() {

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

// --- Função auxiliar para atualizar as estrelas ---
function updateStars(container, rating) {
    const stars = container.querySelectorAll('.star');
    stars.forEach((star, i) => {
        star.classList.toggle('active', i < rating);
    });
}
