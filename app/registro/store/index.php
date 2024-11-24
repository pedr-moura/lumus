<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criação da Loja</title>
</head>
<body>
<h1>Olá, 

<?php
require_once('../../functions/sessao/validation.php');

echo $_SESSION['user_name']

?>! </h1>
    <form action="../../functions/registro/criarLoja/process.php" method="GET">
        <div class="prim_section">
            <h1>Dados principais</h1>

            <label for="name_store">Nome da loja:</label><br>
            <input type="text" id="name_store" name="name_store" required><br><br>

            <label for="identify">CPF ou CNPJ:</label><br>
            <input type="text" id="identify" name="identify" maxlength="18" placeholder="CPF ou CNPJ" oninput="mascaraDocumento(this)" required>
            <br><br>

            <!-- LOGICA PARA PASSAR O CPF/CNPJ -->
            <script>
                function mascaraIdentify(campo) {
                var valor = campo.value.replace(/\D/g, ""); // Remove tudo que não for número

                // Se tiver 11 dígitos, é CPF
                if (valor.length <= 11) {
                    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
                    valor = valor.replace(/(\d{3})(\d)/, "$1.$2");
                    valor = valor.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
                } 
                // Se tiver 14 dígitos, é CNPJ
                else {
                    valor = valor.replace(/^(\d{2})(\d)/, "$1.$2");
                    valor = valor.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
                    valor = valor.replace(/\.(\d{3})(\d)/, ".$1/$2");
                    valor = valor.replace(/(\d{4})(\d{1,2})$/, "$1-$2");
                }

                campo.value = valor;
                }
            </script>

            <label for="store_contact">Contato (Whatsapp)</label><br>
            <input type="text" name="store_contact" id="store_contact" required><br><br>
        </div>

        <div class="sec_section">
            <h1>Pagamentos</h1>

            <label for="store_pix_key">Chave PIX para receber pagamentos</label><br>
            <input type="text" name="store_pix_key" id="store_pix_key"><br><br>

             <label for="store_whatsapp_enc">
             <input type="checkbox" name="store_whatsapp_enc" id="store_whatsapp_enc" value="1" checked>
             Direcionar clientes para seu Whatsapp
            </label><br><br>

        </div>

        <div class="terc_section">
            <h1>Mais detalhes</h1>

            <label for="segment">Qual seu segmento?</label><br>
            <select id="segment" name="segment">
                <option value="moda">Moda</option>
                <option value="eletronicos">Eletrônicos</option>
                <option value="alimentos">Alimentos</option>
                <option value="saude">Saúde</option>
                <option value="beleza">Beleza</option>
                <option value="esportes">Esportes</option>
                <option value="casa">Casa e Decoração</option>
                <option value="livros">Livros</option>
                <option value="brinquedos">Brinquedos</option>
                <option value="automoveis">Automóveis</option>
                <option value="pet">Pet Shop</option>
                <option value="tecnologia">Tecnologia</option>
                <option value="artesanato">Artesanato</option>
                <option value="musicainstrumentos">Instrumentos Musicais</option>
                <option value="jardinagem">Jardinagem</option>
                <option value="outros">Outros</option>
            </select>

        </div>

            <label>
            <!-- $accept_terms = isset($_POST['accept_terms']) ? 1 : 0; // 1 se marcada, 0 se não marcada -->
            <input type="checkbox" name="accept_terms" value="1" checked>
            Aceito os termos e condições
            </label><br><br>
        <button id="submit">Cadastrar</button>
    </form>
</body>
</html>
