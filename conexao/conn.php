<?php

// Carrega o arquivo .env
loadEnv(__DIR__ . '/.env');

class Conexao {
    private $host;
    private $port;
    private $db;
    private $user;
    private $password;
    private $conn;

    public function __construct() {
        // Carrega as variáveis de ambiente
        $this->host = getenv('DB_HOST');
        $this->port = getenv('DB_PORT');
        $this->db = getenv('DB_DATABASE');
        $this->user = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');

        // Cria a conexão
        $this->conectar();
    }

    private function conectar() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->db}",
                $this->user,
                $this->password
            );

            // Configurações adicionais para o PDO
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            echo "Conexão bem-sucedida!";
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
    }

    public function getConexao() {
        return $this->conn;
    }
}

// Função para carregar o .env
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        throw new Exception("Arquivo .env não encontrado: $filePath");
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Ignora comentários
        }

        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
}

// Exemplo de uso
$conexao = new Conexao();
$conn = $conexao->getConexao();
