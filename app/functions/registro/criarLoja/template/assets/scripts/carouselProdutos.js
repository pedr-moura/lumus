document.addEventListener("DOMContentLoaded", () => {
    const carouselInner = document.querySelector(".carousel-produtos .carousel-inner");
    const produtos = Array.from(carouselInner.querySelectorAll(".produto"));
    const indicatorsContainer = document.querySelector(".carousel-produtos .carousel-indicators");
    const leftArrow = document.querySelector(".left");
    const rightArrow = document.querySelector(".right");
    const produtosPorPagina = 4;
    let currentPage = 0;

    // Calcular total de páginas
    const totalPages = Math.ceil(produtos.length / produtosPorPagina);



    // Ajustar largura dos produtos para que eles apareçam 4 por vez
    produtos.forEach((produto) => {
        produto.style.flex = `0 0 calc(100% / ${produtosPorPagina})`;
    });

    // Criar indicadores (bolinhas) dinamicamente
    for (let i = 0; i < totalPages; i++) {
        const indicator = document.createElement("div");
        indicator.classList.add("indicator-produtos");
        if (i === 0) indicator.classList.add("active");
        indicator.addEventListener("click", () => goToPage(i));
        indicatorsContainer.appendChild(indicator);
    }

    const indicators = Array.from(indicatorsContainer.querySelectorAll(".indicator-produtos"));

    // Função para mover para uma página específica
    const goToPage = (pageIndex) => {
        currentPage = pageIndex;
        carouselInner.style.transform = `translateX(-${pageIndex * 100}%)`;

        // Atualizar o estado dos indicadores
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle("active", index === currentPage);
        });

        // Atualizar a visibilidade das setas
        updateArrows();
    };

    // Função para atualizar a visibilidade das setas
    const updateArrows = () => {
        if (currentPage === 0) {
            leftArrow.style.opacity = "0"; // Esconde a seta esquerda
        } else {
            leftArrow.style.opacity = "1"; // Exibe a seta esquerda

        }

        if (currentPage === totalPages - 1) {
            rightArrow.style.opacity = "0"; // Esconde a seta direita
        } else {
            rightArrow.style.opacity = "1"; // Exibe a seta direita
 
        }
    };

    // Navegação com setas
    leftArrow.addEventListener("click", () => {
        if (currentPage > 0) goToPage(currentPage - 1);
    });

    rightArrow.addEventListener("click", () => {
        if (currentPage < totalPages - 1) goToPage(currentPage + 1);
    });

    // Inicializar na primeira página
    goToPage(0);
});
