<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form action="../functions/registro/process.php" method="POST">
        <label for="name">Nome:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Telefone:</label><br>
        <input type="text" id="phone" name="phone" required><br><br>

        <label for="password">Senha:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <?php 
        if (isset($_GET['auth'])) {
            echo "<label for='password'>Repita a senha:</label><br>
                  <input type='password' id='validatepassword' name='validatepassword' placeholder='As senhas não conferem' required><br><br>";
        }else {
            echo "<label for='password'>Repita a senha:</label><br>
                  <input type='password' id='validatepassword' name='validatepassword' required><br><br>";
        }
        ?>

        <button id="submit">Cadastrar</button>
    </form>
</body>
</html>
