<?php
session_start();
// Inclui o arquivo de conexão
require_once('../../../../conexao/conn.php');
require_once('criarLoja.php');

if ($_GET['name_store'] && $_GET['identify'] && $_GET['store_contact'] && $_GET['store_pix_key'] && $_GET['store_whatsapp_enc'] && $_GET['accept_terms']) {
   
    if (isset($_SESSION['user_name'])) {

        // id = auto incrementado
        // name-store = $_GET['name_store'] -> nome da loja
        // identify = $_GET['identify'] -> CPF ou CNPJ
        // segment = $_GET['segment'] -> segmento da loja 
        // create-url = $_SESSION['create_url'] -> Caminho criado pelo criarPastaLoja
        // store-pix-key = $_GET['store_pix_key'] -> Pix para pagamentos
        // store-whatsapp-enc = $_GET['store_whatsapp_enc'] -> Validação para Whatsapp da loja
        criarPastaLoja();
        $create_url = $_SESSION['create_url'];

        // color-background -> default
        // color=background-secondary -> default
        // color-primary -> default
        // color-secondary -> default
        // color-text -> default
        // show-logo-store -> default

        // show-contact-number-store = $_GET['store_contact'] -> Whatsapp da loja
        // show-contact-name-store = $_SESSION['user_name']
        // user-email = $_SESSION['email']
        // validador para registro da loja -> $_GET['accept_terms'] -> Validação para criação da loja







        // try {
        //     // Prepara a query de inserção
        //     $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, type) VALUES (:name, :email, :phone, :password, :type)");
        //     $stmt->bindParam(':name', $name);
        //     $stmt->bindParam(':email', $email);
        //     $stmt->bindParam(':phone', $phone);
        //     $stmt->bindParam(':password', $hashedPassword);
        //     $stmt->bindParam(':type', $typeUser);

        //     // Executa a query
        //     if ($stmt->execute()) {
            
        //         header("Location: ../../../app/registro/store/");
        //         exit();

        //     } else {
        //         echo "Erro ao cadastrar usuário.";
        //     }
        // } catch (PDOException $e) {
        //     // Trata erros de duplicação de e-mail, entre outros
        //     if ($e->getCode() == 23000) {
        //         echo "E-mail já cadastrado. Tente novamente.";
        //     } else {
        //         echo "Erro: " . $e->getMessage();
        //     }
        // }
    } else {
        // Redireciona para página de registro com erro de validação
        header("Location: ../../../../app/registro/?auth=false");
        exit(); // Certifique-se de terminar o script após redirecionar
    }
} else {
    echo "Preencha todos os campos corretamente.";
}
