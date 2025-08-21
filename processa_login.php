<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM tb_cadastro WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $user = $resultado->fetch_assoc();
        if (password_verify($senha, $user['senha'])) {
            // Definir TODAS as variáveis de sessão necessárias
            $_SESSION['logado'] = true;
            $_SESSION['id'] = $user['id']; // Adicionado - necessário para sidebar
            $_SESSION['email'] = $user['email'];
            $_SESSION['usuario'] = $user['usuario']; // Adicionado - necessário para sidebar
            $_SESSION['foto_nome'] = $user['foto_nome']; // Adicionado - necessário para sidebar
            
            header("Location: home.php");
            exit;
        }
    }

    header("Location: login.php?erro=Usuário ou senha inválidos!");
    exit;
}
?>