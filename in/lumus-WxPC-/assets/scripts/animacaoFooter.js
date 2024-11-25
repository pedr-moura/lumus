function toggleSection() {
    var section = document.getElementById("expandable-section");
    var outline = document.getElementById("set_outline");

    // Verifica se a seção está visível ou não
    if (section.style.maxHeight === "0px" || section.style.maxHeight === "") {
        // Se estiver oculta, define uma altura suficiente para mostrar o conteúdo
        let height = section.scrollHeight + 50
        section.style.maxHeight = height + "px"; // Expande a seção para o tamanho do conteúdo
        outline.style.transform = "rotateZ(270deg)";
    } else {
        // Caso contrário, oculta a seção novamente
        section.style.maxHeight = "0px"; // Contraí a seção
        outline.style.transform = "rotateZ(90deg)";
    }
}
