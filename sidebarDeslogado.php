<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title></title>

  <!-- Boxicons CDN -->
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

  <style>

    #menu-toggle {
      display: none;
    }

    .hamburger {
      position: fixed;
      top: 20px;
      left: 20px;
      width: 30px;
      height: 22px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      cursor: pointer;
      z-index: 3;
    }

    .hamburger span {
      display: block;
      height: 4px;
      background: #333;
      border-radius: 2px;
      transition: all 0.3s ease;
    }

    #menu-toggle:checked + .hamburger span:nth-child(1) {
      transform: translateY(9px) rotate(45deg);
    }
    #menu-toggle:checked + .hamburger span:nth-child(2) {
      opacity: 0;
    }
    #menu-toggle:checked + .hamburger span:nth-child(3) {
      transform: translateY(-9px) rotate(-45deg);
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: -250px;
      width: 250px;
      height: 100%;
      background-color: #111;
      color: white;
      padding-top: 60px;
      transition: left 0.3s ease;
      display: flex;
      flex-direction: column;
      z-index: 2;
    }

    #menu-toggle:checked ~ .sidebar {
      left: 0;
    }

    .sidebar ul {
      list-style: none;
      padding: 0 1rem;
    }

    .sidebar li {
      margin-bottom: 15px;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 16px;
      padding: 10px;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .sidebar a i {
      font-size: 20px;
    }

    .sidebar a:hover {
      background-color: #333;
    }

    .content {
      flex: 1;
      padding: 2rem;
      transition: margin-left 0.3s ease;
      margin-left: 0;
    }

    #menu-toggle:checked ~ .content {
      margin-left: 250px; 
    }

     nav ul a {
    margin: 0 1.5rem;
    position: relative;
    color: #f8f5f0;
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    transition: all 0.3s;
    font-weight: 500;
    letter-spacing: 0.5px;
}

nav ul a:hover {
    color: #b8860b; /* Dourado */
    background-color: rgba(255, 255, 255, 0.1);
}

nav ul a::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: 0;
    left: 0;
    background-color: #b8860b; /* Dourado */
    transition: width 0.3s;
}

nav ul a:hover::after {
    width: 100%;
}
  </style>
</head>
<body>

  <!-- Toggle do Menu -->
  <input type="checkbox" id="menu-toggle"/>

  <!-- Botão Hamburger -->
  <label for="menu-toggle" class="hamburger">
    <span></span>
    <span></span>
    <span></span>
  </label>

  <!-- Sidebar com ícones Boxicons -->
  <nav class="sidebar">
    <!-- Navegação -->
    <ul>
      <li><a href="#inicio"><i class='bx bx-home'></i> Início</a></li>
<<<<<<< HEAD
      <li><a href="login.php"><i class='bx bx-user'></i> Perfil</a></li>
      <li><a href="login.php"><i class='bx bx-history'></i> Histórico</a></li>
      <li><a href="coment.php"><i class='bx bx-comment-detail'></i> Comentários</a></li>
      <li><a href="login.php"><i class='bx bx-book'></i> Acervo</a></li>
      <li><a href="aluguel.php"><i class='bx bx-key'></i> Aluguel</a></li>
      <li><a href="#contato"><i class='bx bx-phone'></i> Contato</a></li>
      <li><a href="#faq"><i class='bx bx-help-circle'></i> FAQ</a></li>
      <li><a href="inscrever.php"><i class='bx bx-help-circle'></i> Cadastrar</a></li>
      <li><a href="login.php"><i class='bx bx-log-in'></i> Login</a></li>
    
=======
      <li><a href="#"><i class='bx bx-user'></i> Perfil</a></li>
      <li><a href="#"><i class='bx bx-history'></i> Histórico</a></li>
      <li><a href="coment.php"><i class='bx bx-comment-detail'></i> Comentários</a></li>
      <li><a href="acervo.php"><i class='bx bx-book'></i> Acervo</a></li>
      <li><a href="aluguel.php"><i class='bx bx-key'></i> Aluguel</a></li>
      <li><a href="#contato"><i class='bx bx-phone'></i> Contato</a></li>
      <li><a href="#faq"><i class='bx bx-help-circle'></i> FAQ</a></li>
      <li><a href="login.php"><i class='bx bx-log-in'></i> Login</a></li>
>>>>>>> 22a0ff52cfac5c6b899e1b607f3392e87e1ae875
    </ul>
  </nav>

  <!-- Conteúdo Principal -->
  <main>
  </main>

</body>
</html>