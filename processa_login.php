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
<<<<<<< HEAD
            // Definir TODAS as variáveis de sessão necessárias
            $_SESSION['logado'] = true;
            $_SESSION['id'] = $user['id']; // Adicionado - necessário para sidebar
            $_SESSION['email'] = $user['email'];
            $_SESSION['usuario'] = $user['usuario']; // Adicionado - necessário para sidebar
            $_SESSION['foto_nome'] = $user['foto_nome']; // Adicionado - necessário para sidebar
            
=======
            $_SESSION['logado'] = true;
            $_SESSION['email'] = $user['email'];
>>>>>>> 22a0ff52cfac5c6b899e1b607f3392e87e1ae875
            header("Location: home.php");
            exit;
        }
    }

<<<<<<< HEAD
    header("Location: login.php?erro=Usuário ou senha inválidos!");
    exit;
}
?>
=======
    header("Location: login.php?erro=Usuário ou senha inválidos");
    exit;
}
?>
>>>>>>> 22a0ff52cfac5c6b899e1b607f3392e87e1ae875
