<?php
session_start();
// Inclui o arquivo de conexão
require_once('../../../conexao/conn.php');

// Receber dados do formulário para criar nova loja
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

// Substituir FILTER_SANITIZE_STRING
$password = $_POST['password'];
$validate_password = $_POST['validatepassword'];

$typeUser = "Vendedor";

$valid = 0;

if ($password == $validate_password) { $valid = 1; } else {
    // Redireciona para página de registro com erro de validação
    header("Location: ../../../app/registro/?auth=false");
    exit(); 
}

if ($name && $email && $password && $phone) {
    if ($valid == 1) {

        // Criptografa a senha
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Prepara a query de inserção
            $stmt = $conn->prepare("INSERT INTO users (name, email, phone, password, type) VALUES (:name, :email, :phone, :password, :type)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':type', $typeUser);

            // Executa a query
            if ($stmt->execute()) {
                echo "Usuário cadastrado com sucesso!";

                $nameParts = explode(" ", $name);
                $firstName = $nameParts[0];

                $_SESSION['user_name'] = $firstName;
                $_SESSION['email'] = $email;
                $_SESSION['phone'] = $phone;
            
                header("Location: ../../../app/registro/store/");
                exit();

            } else {
                echo "Erro ao cadastrar usuário.";
            }
        } catch (PDOException $e) {
            // Trata erros de duplicação de e-mail, entre outros
            if ($e->getCode() == 23000) {
                echo "E-mail já cadastrado. Tente novamente.";
            } else {
                echo "Erro: " . $e->getMessage();
            }
        }
    } else {

    }
} else {
    echo "Preencha todos os campos corretamente.";
}
