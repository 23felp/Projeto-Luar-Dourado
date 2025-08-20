<?php
session_start();

// Verifica se o cliente está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include("config.php"); // Conexão com o banco

$email_sessao = $_SESSION['email'];

// Se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro_id = intval($_POST['livro_id']); // Convertendo para inteiro para segurança
    $dias_aluguel = intval($_POST['dias_aluguel']);
    $data_pedido = date('Y-m-d');

    // Primeiro, buscar o ID do cliente baseado no email da sessão
    $stmt_cliente = $conn->prepare("SELECT id FROM tb_cadastro WHERE email = ?");
    $stmt_cliente->bind_param("s", $email_sessao);
    $stmt_cliente->execute();
    $result_cliente = $stmt_cliente->get_result();
    
    if ($result_cliente->num_rows > 0) {
        $cliente = $result_cliente->fetch_assoc();
        $cliente_id = $cliente['id'];
        
        // Verificar se o livro existe
        $stmt_livro = $conn->prepare("SELECT id FROM tb_livros WHERE id = ?");
        $stmt_livro->bind_param("i", $livro_id);
        $stmt_livro->execute();
        $result_livro = $stmt_livro->get_result();
        
        if ($result_livro->num_rows > 0) {
            // Inserir pedido no banco
            $stmt = $conn->prepare("INSERT INTO tb_pedidos (cliente_id, livro_id, dias_aluguel, data_pedido) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $cliente_id, $livro_id, $dias_aluguel, $data_pedido);

            if ($stmt->execute()) {
                $mensagem = "Pedido realizado com sucesso!";
            } else {
                $mensagem = "Erro ao realizar o pedido.";
            }
            $stmt->close();
        } else {
            $mensagem = "Livro não encontrado.";
        }
        $stmt_livro->close();
    } else {
        $mensagem = "Cliente não encontrado.";
    }
    $stmt_cliente->close();
}

// Buscar livros para o formulário
$livros = [];
$result = $conn->query("SELECT id, titulo FROM tb_livros");
while ($row = $result->fetch_assoc()) {
    $livros[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Fazer Pedido</title>
    <link rel="stylesheet" href="aluguel.css">
</head>
<body>
     <div class="container">
    <h1>Fazer Pedido de Livro</h1>

    <?php if (isset($mensagem)): ?>
        <p><strong><?= $mensagem ?></strong></p>
    <?php endif; ?>

    <form method="POST">
        <label for="livro_id">Escolha o livro:</label><br>
        <select name="livro_id" required>
            <option value="">--Selecione--</option>
            <?php foreach ($livros as $livro): ?>
                <option value="<?= $livro['id'] ?>"><?= htmlspecialchars($livro['titulo']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="dias_aluguel">Quantidade de dias:</label><br>
        <input type="number" name="dias_aluguel" min="1" required><br><br>

        <button type="submit">Fazer Pedido</button>
    </form>
</body>
</html>
