<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include("config.php"); // Conexão com o banco

// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['novo_usuario'])) {
    $novo_usuario = trim($_POST['novo_usuario']);
    $id = $_SESSION['id'];
    
    // Obter o nome antigo do usuário
    $stmt_old = $conn->prepare("SELECT usuario FROM tb_cadastro WHERE id = ?");
    $stmt_old->bind_param("i", $id);
    $stmt_old->execute();
    $result = $stmt_old->get_result();
    $usuario_antigo = $result->fetch_assoc()['usuario'];

    // Validação do nome de usuário
    if (empty($novo_usuario)) {
        show_message("O nome de usuário não pode estar vazio.", false);
        exit;
    }

    // Atualização no banco de dados
    $stmt = $conn->prepare("UPDATE tb_cadastro SET usuario = ? WHERE id = ?");
    $stmt->bind_param("si", $novo_usuario, $id);

    if ($stmt->execute()) {
        $_SESSION['usuario'] = $novo_usuario; // Atualiza a sessão
        show_message("Nome de usuário alterado com sucesso!", true, $usuario_antigo, $novo_usuario);
    } else {
        show_message("Erro ao atualizar: " . $conn->error, false);
    }
} else {
    show_message("Acesso inválido ao script.", false);
}

function show_message($message, $success, $old_name = null, $new_name = null) {
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alteração de Usuário</title>
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
            
            .change-details {
                margin: 15px 0;
                padding: 10px;
                background-color: #f8f9fa;
                border-radius: 4px;
                text-align: left;
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
            <h2>Alteração de Usuário</h2>
            
            <?php if ($success): ?>
                <div class="alert-success"><?= $message ?></div>
                <div class="change-details">
                    <p><strong>Nome antigo:</strong> <?= htmlspecialchars($old_name) ?></p>
                    <p><strong>Nome novo:</strong> <?= htmlspecialchars($new_name) ?></p>
                </div>
                <a href="perfil.php" class="btn">Voltar ao Perfil</a>
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