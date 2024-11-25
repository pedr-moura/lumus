document.addEventListener("DOMContentLoaded", () => {
    const outros_carouselInner = document.querySelector(".outros_carousel-inner");
    const outros_produtos = Array.from(outros_carouselInner.querySelectorAll(".outros_produto"));
    const outros_indicatorsContainer = document.querySelector(".outros_carousel-indicators");
    const outros_leftArrow = document.querySelector(".outros_left");
    const outros_rightArrow = document.querySelector(".outros_right");
    const outros_produtosPorPagina = 4;
    let outros_currentPage = 0;

    // Calcular total de páginas
    const outros_totalPages = Math.ceil(outros_produtos.length / outros_produtosPorPagina);

    // Ajustar largura dos produtos para que eles apareçam 4 por vez
    outros_produtos.forEach((produto) => {
        produto.style.flex = `0 0 calc(100% / ${outros_produtosPorPagina})`;
    });

    // Criar indicadores (bolinhas) dinamicamente
    for (let i = 0; i < outros_totalPages; i++) {
        const indicator = document.createElement("div");
        indicator.classList.add("outros_indicator-produtos");
        if (i === 0) indicator.classList.add("active");
        indicator.addEventListener("click", () => goToPage(i));
        outros_indicatorsContainer.appendChild(indicator);
    }

    const outros_indicators = Array.from(outros_indicatorsContainer.querySelectorAll(".outros_indicator-produtos"));

    // Função para mover para uma página específica
    const goToPage = (pageIndex) => {
        outros_currentPage = pageIndex;
        outros_carouselInner.style.transform = `translateX(-${pageIndex * 100}%)`;

        // Atualizar o estado dos indicadores
        outros_indicators.forEach((indicator, index) => {
            indicator.classList.toggle("active", index === outros_currentPage);
        });

        // Atualizar a visibilidade das setas
        updateArrows();
    };

    // Função para atualizar a visibilidade das setas
    const updateArrows = () => {
        outros_leftArrow.style.opacity = outros_currentPage === 0 ? "0" : "1";
        outros_rightArrow.style.opacity = outros_currentPage === outros_totalPages - 1 ? "0" : "1";
    };

    // Navegação com setas
    outros_leftArrow.addEventListener("click", () => {
        if (outros_currentPage > 0) goToPage(outros_currentPage - 1);
    });

    outros_rightArrow.addEventListener("click", () => {
        if (outros_currentPage < outros_totalPages - 1) goToPage(outros_currentPage + 1);
    });

    // Inicializar na primeira página
    goToPage(0);
});
