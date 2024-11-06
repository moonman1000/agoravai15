<?php
session_start();

// Conecte-se ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzaria";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifique a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se o email já está cadastrado
    $sql = "SELECT * FROM administradores WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Insere o novo administrador no banco de dados
        $sql = "INSERT INTO administradores (email, senha) VALUES ('$email', '$senha')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['email'] = $email;
            header("Location: index.html");
            exit();
        } else {
            echo "Erro: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Email já cadastrado.";
    }
}
?>
