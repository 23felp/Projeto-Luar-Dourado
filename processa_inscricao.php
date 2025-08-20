<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // segurança! crifanado a senha

    $foto_nome = ''; // Inicializa a variável que vai guardar o caminho do arquivo. Começa vazia, para o caso de nenhum arquivo ser enviado.
    //Verifica se o usuário enviou o arquivo (isset($_FILES['foto'])) e se não houve erro no upload (error == 0).
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
      $foto_tmp = $_FILES['foto']['tmp_name']; //Aqui pegamos o caminho do arquivo temporário no servidor. O PHP guarda o arquivo enviado numa pasta temporária. Antes de usar, precisamos mover esse arquivo para a pasta correta.
      $foto_nome = 'fotos/' . uniqid() . '_' . $_FILES['foto']['name'];//Montamos o nome final do arquivo que será salvo: 'fotos/' é a pasta onde vamos guardar as imagens. uniqid() gera um ID único pra evitar sobrescrever imagens com nomes iguais. $_FILES['foto']['name'] é o nome original do arquivo enviado. Exemplo do resultado: fotos/66f0a12345_meufile.png
      move_uploaded_file($foto_tmp, $foto_nome); //move_uploaded_file() move o arquivo do caminho temporário para o caminho final que escolhemos. Se tudo der certo, $foto_nome terá o caminho da imagem salva.
    }  

    $sql = "INSERT INTO tb_cadastro (usuario, email, senha, foto_nome) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $usuario, $email, $senha, $foto_nome);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit;
    } else {
        echo "Erro ao cadastrar: " . $conn->error;
    }
}
?>