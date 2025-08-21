<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include("config.php");

$email_sessao = $_SESSION['email'];

// Primeiro, obtenha o ID do usuário
$stmt = $conn->prepare("SELECT id FROM tb_cadastro WHERE email = ?");
$stmt->bind_param("s", $email_sessao);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user['id'];

// Exclua os pedidos associados
$stmt_delete_pedidos = $conn->prepare("DELETE FROM tb_pedidos WHERE cliente_id = ?");
$stmt_delete_pedidos->bind_param("i", $user_id);
$stmt_delete_pedidos->execute();

// Agora exclua o usuário
$stmt_delete_user = $conn->prepare("DELETE FROM tb_cadastro WHERE id = ?");
$stmt_delete_user->bind_param("i", $user_id);

if ($stmt_delete_user->execute()) {
    session_destroy();
    show_message("Conta excluída com sucesso.", true);
} else {
    show_message("Erro ao excluir conta: " . $conn->error, false);
}

$stmt_delete_user->close();
$conn->close();

function show_message($message, $success) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Exclusão de Conta</title>
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
            <h2>Exclusão de Conta</h2>
            
            <?php if ($success): ?>
                <div class="alert-success"><?= $message ?></div>
                <a href="inicial.php" class="btn">Voltar para o Início</a>
            <?php else: ?>
                <div class="alert-error"><?= $message ?></div>
                <a href="perfil.php" class="btn">Voltar ao Perfil</a>
            <?php endif; ?>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>