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