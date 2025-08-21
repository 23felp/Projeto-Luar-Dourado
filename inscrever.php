<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <link rel="stylesheet" href="inscrever.css">
</head>
<body>
    <div class="login-container">
        <h2>Cadastro</h2>
        <!-- Formulario de cadastro-->
        <form method="post" action="processa_inscricao.php" enctype="multipart/form-data">
        <!-- Sem o enctype, o arquivo não vai-->
            <label>Foto de Perfil:</label>
            <input type="file" name="foto" accept="image/*">
            <label>Usuario:</label>
            <input type="text" name="usuario" required>
            <label>Email:</label>
            <input type="text" name="email" required>
            <label>Senha:</label>
            <input type="password" name="senha" required>
            <input type="submit" value="Cadastrar">
        </form>

        <a href="inicial.php" class="cadastro">Voltar ao inicio</a>
        
        <!-- Link login--> 
        <div class="linklogin">
        <p><a href="login.php">Já tem conta? | Faça login</a></p>
    </div>
</body>
</html>
