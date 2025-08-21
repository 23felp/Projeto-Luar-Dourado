<?php
session_start();
include("config.php");

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $id_usuario = $_SESSION['id'];
    $pasta = "fotos/";
    
    // Verifica se a pasta existe
    if (!file_exists($pasta)) {
        mkdir($pasta, 0755, true);
    }

    // Gera um nome único para a foto
    $nome_arquivo = uniqid() . '_' . basename($_FILES['foto']['name']);
    $caminho_temp = $_FILES['foto']['tmp_name'];
    $caminho_destino = $pasta . $nome_arquivo;

    // Verifica se é uma imagem válida
    $check = getimagesize($caminho_temp);
    if ($check === false) {
        $_SESSION['mensagem_erro'] = "Arquivo não é uma imagem válida";
        header("Location: perfil.php");
        exit;
    }

    // Tipos de arquivo permitidos
    $tipos_permitidos = ['image/jpeg', 'image/png'];
    if (!in_array($_FILES['foto']['type'], $tipos_permitidos)) {
        $_SESSION['mensagem_erro'] = "Apenas arquivos JPG e PNG são permitidos";
        header("Location: perfil.php");
        exit;
    }

    // Tamanho máximo (2MB)
    if ($_FILES['foto']['size'] > 2000000) {
        $_SESSION['mensagem_erro'] = "Arquivo muito grande (máximo 2MB)";
        header("Location: perfil.php");
        exit;
    }

    // Remove a foto antiga se existir
    $stmt_old = $conn->prepare("SELECT foto_nome FROM tb_cadastro WHERE id = ?");
    $stmt_old->bind_param("i", $id_usuario);
    $stmt_old->execute();
    $stmt_old->bind_result($foto_antiga);
    $stmt_old->fetch();
    $stmt_old->close();

    if ($foto_antiga && file_exists($pasta . $foto_antiga)) {
        unlink($pasta . $foto_antiga);
    }

    // Move o arquivo para a pasta
    if (move_uploaded_file($caminho_temp, $caminho_destino)) {
        // Atualiza o banco de dados
        $stmt = $conn->prepare("UPDATE tb_cadastro SET foto_nome = ? WHERE id = ?");
        $stmt->bind_param("si", $nome_arquivo, $id_usuario);
        
        if ($stmt->execute()) {
            // Atualiza todas as informações na sessão
            $_SESSION['foto_nome'] = $nome_arquivo;
            $_SESSION['mensagem_sucesso'] = "Foto atualizada com sucesso!";
            
            // Atualiza também o nome do usuário na sessão para garantir consistência
            $stmt_user = $conn->prepare("SELECT usuario FROM tb_cadastro WHERE id = ?");
            $stmt_user->bind_param("i", $id_usuario);
            $stmt_user->execute();
            $stmt_user->bind_result($usuario);
            $stmt_user->fetch();
            $stmt_user->close();
            
            $_SESSION['usuario'] = $usuario;
        } else {
            $_SESSION['mensagem_erro'] = "Erro ao atualizar no banco de dados";
        }
    } else {
        $_SESSION['mensagem_erro'] = "Erro ao mover o arquivo";
    }
    
    header("Location: perfil.php");
    exit;
}
?>