 let pagina = 0; // Variável para controlar a página atual

// Função que busca os editais conforme os parâmetros fornecidos
async function buscarEditais() {
  // Obtém os valores dos campos de busca (nome e campus)
  const nome = document.getElementById("searchNome").value;
  const campus = document.getElementById("searchCampus").value;

  // Cria a URL da API com os parâmetros necessários (como a página e os filtros)
  const url = new URL("https://editais-api-ccg.onrender.com/editais");
  url.searchParams.append("start", pagina); // Adiciona o parâmetro de página (começando da página 0)
  if (nome) url.searchParams.append("nome", nome); // Se o nome foi informado, adiciona como filtro
  if (campus) url.searchParams.append("campus", campus); // Se o campus foi informado, adiciona como filtro

  // Faz a requisição para a API e aguarda a resposta
  const res = await fetch(url); // Faz o pedido à API
  const data = await res.json(); // Converte a resposta para formato JSON

  // Obtém a referência para o local onde os resultados serão exibidos
  const resultado = document.getElementById("resultado");
  resultado.innerHTML = ""; // Limpa qualquer conteúdo anterior

  // Verifica se o status da resposta é "sucesso". Se não, exibe uma mensagem de erro.
  if (data.status !== "sucesso") {
    resultado.innerHTML = "<p>Nenhum edital encontrado.</p>";
    return; // Sai da função se não houver resultados
  }

  // Atualiza o número da página que está sendo exibida (mostra a página correta para o usuário)
  document.getElementById("paginaAtual").textContent = `Página ${data.pagina / 20 + 1}`;

  // Cria um "card" para cada edital encontrado e exibe no resultado
  data.resultado.forEach(edit => {
    const card = document.createElement("div"); // Cria um novo elemento de "card"
    card.className = "card"; // Aplica a classe CSS para estilizar o card
    // Define o conteúdo do card (título, descrição, campus e link para o edital)
    card.innerHTML = `
      <h3>${edit.titulo}</h3>
      <p><strong>Descrição:</strong> ${edit.descricao}</p>
      <p><strong>Campus:</strong> ${edit.campus}</p>
      <p><a href="${edit.url}" target="_blank">Ver Edital</a></p>
    `;
    resultado.appendChild(card); // Adiciona o card criado à página
  });
}

// Função para ir para a próxima página de resultados
function proximaPagina() {
  pagina += 20; // Aumenta o valor da página (pula para os próximos 20 resultados)
  buscarEditais(); // Chama a função para buscar os editais na nova página
}

// Função para voltar para a página anterior
function anteriorPagina() {
  // Verifica se a página atual é maior ou igual a 20 antes de diminuir
  if (pagina >= 20) {
    pagina -= 20; // Diminui o valor da página (volta 20 resultados)
    buscarEditais(); // Chama a função para buscar os editais na nova página
  }
}

// Função chamada automaticamente ao carregar a página
window.onload = buscarEditais; // Quando a página é carregada, chama a função para buscar os editais iniciais
