<?php
session_start();
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['email'])) {
    header("Location: inicial.php");
    exit;
}

include("config.php"); // Conexão com o banco

$email_sessao = $_SESSION['email'];

// Buscar ID do usuário logado
$stmt_cliente = $conn->prepare("SELECT id FROM tb_cadastro WHERE email = ?");
$stmt_cliente->bind_param("s", $email_sessao);
$stmt_cliente->execute();
$result_cliente = $stmt_cliente->get_result();
$usuario_logado = $result_cliente->fetch_assoc();

if (!$usuario_logado) {
    die("Usuário não encontrado!");
}

$cliente_id = $usuario_logado['id']; // Definindo a variável cliente_id corretamente
$_SESSION['id'] = $cliente_id; // Atualiza a sessão

// Consulta ao banco para buscar o histórico de aluguéis
$sql = "
    SELECT a.*, l.titulo 
    FROM tb_pedidos a
    JOIN tb_livros l ON a.livro_id = l.id
    WHERE a.cliente_id = ?
    ORDER BY a.data_pedido DESC
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cliente_id); // Agora usando a variável definida
$stmt->execute();
$result = $stmt->get_result();

// Verifica se há resultados
if ($result->num_rows === 0) {
    $sem_resultados = true;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Histórico de Aluguéis</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
       

        header {
            background-color: #1b2c51;
            color: #f8f5f0;
            padding: 2rem 0;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            border-bottom: 5px solid #b8860b;
            background-image: url('https://th.bing.com/th/id/OIP.Uvy4sMo1iWh8XGgP7yuFoQHaE8?w=298&h=199&c=7&r=0&o=7&pid=1.7&rm=3'); /* Link direto de imagem */
            background-size: cover;
            background-position: center;
            background-blend-mode: overlay;
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f3f3f3;
        }
        
        .sem-resultados {
            text-align: center;
            margin: 30px;
            font-size: 18px;
            color: #666;
        }

        nav ul a {
      margin: 0 1.5rem;
      position: left;
      color: #f8f5f0;
      text-decoration: none;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      transition: all 0.3s;
      font-weight: 500;
      letter-spacing: 0.5px;
    }

    nav ul a:hover {
      color: #b8860b;
      background-color: rgba(255, 255, 255, 0.1);
    }

    nav ul a::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      bottom: 0;
      left: 0;
      background-color: #b8860b;
      transition: width 0.3s;
    }

    nav ul a:hover::after {
      width: 100%;
    }
    </style>
</head>
 <header>
<body>
    <nav>
    <ul>
        <a href="home.php"><i class='bx bx-home'></i> Início</a>
    </ul> 
</nav>

    <h2 style="text-align:center;">Histórico de Aluguéis</h2>
    
    <?php if (isset($sem_resultados)): ?>
        <div class="sem-resultados">Nenhum aluguel encontrado em seu histórico.</div>
    <?php else: ?>
        <table>
            <tr>
                <th>Livro</th>
                <th>Dias</th>
                <th>Data do Aluguel</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['titulo']) ?></td>
                <td><?= $row['dias_aluguel'] ?> dias</td>
                <td><?= date("d/m/Y H:i", strtotime($row['data_pedido'])) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>
</body>
  </header>
</html>