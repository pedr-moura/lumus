<?php

function removerEspacos($nome) {
    return str_replace(' ', '', $nome);
}

function gerarStringAleatoria($tamanho) {

    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_';
    $stringAleatoria = '';
    
    // Gera a string aleatória
    for ($i = 0; $i < $tamanho; $i++) {
        $indiceAleatorio = rand(0, strlen($caracteres) - 1);
        $stringAleatoria .= $caracteres[$indiceAleatorio];
    }
    
    return $stringAleatoria;
}

function copiarArquivos($origem, $destino) {

    if (!is_dir($origem)) { throw new Exception("O diretório de origem não existe: $origem");}

    if (!is_dir($destino)) { mkdir($destino, 0777, true);}

    $itens = scandir($origem);
    foreach ($itens as $item) {
        if ($item === '.' || $item === '..') {
            continue; 
        }

        $origemCaminho = $origem . DIRECTORY_SEPARATOR . $item;
        $destinoCaminho = $destino . DIRECTORY_SEPARATOR . $item;

        if (is_dir($origemCaminho)) {
            // Recursão para subdiretórios
            copiarArquivos($origemCaminho, $destinoCaminho);
        } else {
            // Copia o arquivo
            copy($origemCaminho, $destinoCaminho);
        }
    }
}

function criarPastaLoja() {
    if (isset($_GET['name_store'])) {
        // Recupera o nome da loja da variável $_GET
        $nomeLoja = $_GET['name_store'];

        removerEspacos($nomeLoja);

        $tamanho = 5;
        $complemento = gerarStringAleatoria($tamanho);

        $diretorio = "../../../../in/" . $nomeLoja . "-" . $complemento;

        // Verifica se a pasta já existe
        if (!file_exists($diretorio)) {
            // Cria a pasta
            if (mkdir($diretorio, 0777, true)) {

                try {
                    $origem = __DIR__ . '/template'; // Caminho para a pasta template
                    copiarArquivos($origem, $diretorio);
                    echo "Arquivos copiados com sucesso de '$origem' para '$diretorio'.";
                } catch (Exception $e) {
                    echo "Erro: " . $e->getMessage();
                }

                $_SESSION['create_url'] = $diretorio;
                header("Location: $diretorio");
                exit(); 
            } else {

            }
        } else {
            echo "A pasta '{$nomeLoja}' já existe.";
        }
    } else {
        echo "O nome da loja não foi fornecido.";
    }
}
?>
