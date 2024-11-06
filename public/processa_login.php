<?php
session_start();

// Conecte-se ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzaria"; // Nome do banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o email e a senha estão corretos
    $sql = "SELECT * FROM administradores WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Sucesso no login
        $_SESSION['email'] = $email;
        header("Location: index2.html");  // Redireciona para a página principal
        exit();
    } else {
        // Login falhou, mensagem de erro
        $login_error = "Email ou senha incorretos";
        header("Location: login.php?error=" . urlencode($login_error)); // Volta para o login com erro
        exit();
    }
}
?>
