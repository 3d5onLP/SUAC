const navMenu = document.getElementById("nav-menu"); // O menu lateral.
const toggleMenu = document.getElementById("toggle-menu");
const closeMenu = document.getElementById("close-menu");
const openBtn = document.getElementById('toggle-menu'); // Botão de abrir
const closeBtn = document.getElementById('close-menu'); // Botão de fechar
const profileToggle = document.getElementById('profileToggle');
const dropdownMenu = document.getElementById('dropdownMenu');
const menuToggle = document.getElementById('menuToggle');


// Abrir o menu ao clicar no ícone de hambúrguer
toggleMenu.addEventListener("click", () => {
  navMenu.classList.toggle("active");
});

// Fechar o menu ao clicar no "x"
closeMenu.addEventListener("click", () => {
  navMenu.classList.remove("active");
});

// Fechar o menu ao clicar fora
document.addEventListener('click', (event) => {
  const isClickInsideMenu = navMenu.contains(event.target);
  const isClickOnOpenBtn = openBtn.contains(event.target);


  // Fechar o menu se não for dentro do menu e não for o botão de abrir
  if (navMenu.classList.contains('active') && !isClickInsideMenu && !isClickOnOpenBtn) {
    navMenu.classList.remove('active');


  }
});

// Toggle do menu de perfil
profileToggle.addEventListener('click', () => {
  dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
});

// Fecha dropdown clicando fora
document.addEventListener('click', (e) => {
  if (!profileToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
    dropdownMenu.style.display = 'none';
  }
});
//Evita que cliques em botões/estrelas disparem a expansão do card.
function toggleCard(event, card) {
  if (
    event.target.closest(".star") ||
    event.target.tagName === "BUTTON" ||
    event.target.classList.contains("contact-btn")
  ) return;

  const isExpanded = card.classList.contains("expanded");  // verifica se o card já está expandido
// Fecha todos os cards abertos
  document.querySelectorAll(".card.expanded").forEach(el => el.classList.remove("expanded"));
// Se o card clicado não estava expandido, abre ele
  if (!isExpanded) {
    card.classList.add("expanded");
  }
}
//Fechar cards ao clicar fora
document.addEventListener("click", function (e) {
  const isCardClick = e.target.closest(".card");
  if (!isCardClick) {
    document.querySelectorAll(".card.expanded").forEach(card => {
      card.classList.remove("expanded");
    });
  }
});
//Sistema de avaliação com estrelas
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
});
//Atualiza a aparência das estrelas
function updateStars(container, rating) {
  const stars = container.querySelectorAll('.star');
  stars.forEach((star, i) => {
    if (i < rating) {
      star.classList.add('active');
    } else {
      star.classList.remove('active');
    }
  });
}