<?php
session_start();
include("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];
    $id_usuario = $_SESSION['id'];

    // 1. Primeiro buscar a senha atual do banco
    $stmt = $conn->prepare("SELECT senha FROM tb_cadastro WHERE id = ?");
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->bind_result($senha_hash);
    $stmt->fetch();
    $stmt->close();

    // 2. Verificar se a senha atual está correta
    if (password_verify($senha_atual, $senha_hash)) {
        // 3. Se correta, atualizar para a nova senha
        $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("UPDATE tb_cadastro SET senha = ? WHERE id = ?");
        $stmt->bind_param("si", $nova_senha_hash, $id_usuario);
        
        if ($stmt->execute()) {
            show_message("Senha alterada com sucesso!", true);
        } else {
            show_message("Erro ao atualizar senha no banco de dados.", false);
        }
    } else {
        show_message("Senha atual incorreta!", false);
    }
} else {
    show_message("Acesso inválido ao script.", false);
}

function show_message($message, $success) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alteração de Senha</title>
        <style>
            body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            
            .alert-container {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
                padding: 30px;
                max-width: 500px;
                width: 90%;
                text-align: center;
            }
            
            .alert-success {
                color: #155724;
                background-color: #d4edda;
                border: 1px solid #c3e6cb;
                padding: 15px;
                border-radius: 4px;
                margin-bottom: 20px;
            }
            
            .alert-error {
                color: #721c24;
                background-color: #f8d7da;
                border: 1px solid #f5c6cb;
                padding: 15px;
                border-radius: 4px;
                margin-bottom: 20px;
            }
            
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background-color: #3498db;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                transition: background-color 0.3s;
                border: none;
                cursor: pointer;
                font-size: 16px;
                margin-top: 15px;
            }
            
            .btn:hover {
                background-color: #2980b9;
            }
            
            h2 {
                color: #2c3e50;
                margin-top: 0;
            }
        </style>
    </head>
    <body>
        <div class="alert-container">
            <h2>Alteração de Senha</h2>
            
            <?php if ($success): ?>
                <div class="alert-success"><?= $message ?></div>
                <a href="perfil.php" class="btn">Voltar ao Perfil</a>
            <?php else: ?>
                <div class="alert-error"><?= $message ?></div>
                <a href="perfil.php" class="btn">Tentar Novamente</a>
            <?php endif; ?>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>