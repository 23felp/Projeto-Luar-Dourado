<?php
$erro = $_GET['erro'] ?? ''; //Pega mensagem de erro (se existir ) passada por GET
?>
<link rel="stylesheet" href="login.css">
    <div class="login-container">
        <h2>Login</h2>
        <!--Exibe mensagem de erro , se houver-->
        <?php if ($erro): ?>
            <p class="erro"><?php echo htmlspecialchars($erro); ?></p>
        <?php endif; ?>
        <form method="post" action="processa_login.php">
            <label>Email:</label>
            <input type="text" name="email" required>
            <label>Senha:</label>
            <input type="password" name="senha" required>
            <input type="submit" value="Entrar">
        </form>
        <div class="cadastro">
        <p><a href="inscrever.php">Não tem conta? | Cadastre-se</a></p>
    </div>