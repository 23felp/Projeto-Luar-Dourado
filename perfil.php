<?php
session_start();

if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true || !isset($_SESSION['email'])) {
    header("Location: login.php");
    exit;
}

include("config.php");

$email_sessao = $_SESSION['email'];

$stmt = $conn->prepare("SELECT id, usuario, email, foto_nome FROM tb_cadastro WHERE email = ?");
$stmt->bind_param("s", $email_sessao);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    session_destroy();
    header("Location: login.php");
    exit;
}

$usuario = $result->fetch_assoc();

$id = $usuario['id'];
$nome_usuario = htmlspecialchars($usuario['usuario']);
$email = htmlspecialchars($usuario['email']);
$foto_nome = $usuario['foto_nome'];

$_SESSION['id'] = $id;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - Luar Dourado</title>
    <link rel="stylesheet" href="perfil.css">
     <section id="inicio"></section>
</head>
  <header> <!-- Cabeçalho da página -->
    <h1>Biblioteca Luar Dourado</h1> <!-- Título principal -->    
</header>

  <div class="inicial-nav">
  <nav class="menu-princ">
     <!-- Menu de navegação -->
        <!-- Cada link leva a uma seção da mesma página -->

        <ul>
        <a href="home.php">Início</a>
        </ul>

      </nav>
  <body>
</head>
<body>
    <div class="profile-container">
        <header>
        <h2>Meu Perfil</h2>
         </header>

        
        <div class="profile-info">
            <div class="profile-picture">
                <?php if ($foto_nome && file_exists("fotos/$foto_nome")): ?>
                    <img src="fotos/<?= htmlspecialchars($foto_nome) ?>" alt="Foto de perfil">
                <?php else: ?>
                    <span>Sem foto</span>
                <?php endif; ?>
            </div>
            <p><strong>Email:</strong> <?= $email ?></p>
        </div>

        <div class="profile-forms">
            <h3>Alterar Foto</h3>
            <form method="post" action="alterar_foto.php" enctype="multipart/form-data">
                <input type="file" name="foto" accept="image/jpeg,image/png" required>
                <button type="submit">Enviar Foto</button>
            </form>

            <h3>Alterar Nome de Usuário</h3>
            <form method="post" action="alterar_usuario.php">
                <input type="text" name="novo_usuario" value="<?= $nome_usuario ?>" required maxlength="50">
                <button type="submit">Atualizar Nome</button>
            </form>

            <h3>Alterar Senha</h3>
            <form method="post" action="alterar_senha.php">
                <input type="password" name="senha_atual" placeholder="Senha atual" required>
                <input type="password" name="nova_senha" placeholder="Nova senha (mínimo 6 caracteres)" required>
                <button type="submit">Atualizar Senha</button>
            </form>

            <form method="post" action="logout.php">
                <button type="submit" name="sair">Sair</button>
            </form>

            <form method="post" action="excluir_conta.php" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?');">
                <button type="submit" name="excluir">Excluir Conta</button>
            </form>
        </div>
    </div>
   

    <footer>
        <p>© 2025 Luar Dourado - Acervo Literário - Todos os direitos reservados</p>
    </footer>
</body>
</html>