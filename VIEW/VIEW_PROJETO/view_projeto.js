const navMenu = document.getElementById("nav-menu");
const toggleMenu = document.getElementById("toggle-menu");
const closeMenu = document.getElementById("close-menu");

toggleMenu.addEventListener("click", () => {
    navMenu.classList.toggle("show");
});
closeMenu.addEventListener("click", () => {
    navMenu.classList.toggle("show");
});

// Seleciona todos os itens da nav que contêm imagem e link
const navItems = document.querySelectorAll('.nav-item');

navItems.forEach(item => {
  const link = item.querySelector('.nav-link');
  const icon = item.querySelector('img');

  if (link && icon) {
    // Cria um tooltip usando o atributo title do link
    icon.title = link.textContent.trim();
  }
});