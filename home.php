<!DOCTYPE html> <!-- Declara o tipo de documento como HTML5 -->
<html lang="pt-BR"> <!-- Define o idioma da página como português do Brasil -->
<head>
  <meta charset="UTF-8" /> <!-- Define a codificação de caracteres como UTF-8 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/> <!-- Garante que a página seja responsiva em dispositivos móveis -->
  <link rel="icon" href="imgG/favicon-32x32.io.png" type="image/png">
  <title>Biblioteca Luar Dourado</title> <!-- Define o título que aparece na aba do navegador -->

  <link rel="stylesheet" href="index.css"> <!-- Importa o arquivo CSS externo para estilizar a página -->
  <section id="inicio"></section>
</head>
  <header> <!-- Cabeçalho da página -->
    <h1>Biblioteca Luar Dourado</h1> <!-- Título principal -->
    <p>"Um pequeno livro lido, é um grande passo para o conhecimento"</p>    
</header>

  <div class="inicial-nav">
  <nav class="menu-princ">
     <!-- Menu de navegação -->
        <!-- Cada link leva a uma seção da mesma página -->
        <ul>
        <a href="#inicio">Início</a>
        <a href="aluguel.php">Aluguel</a>
        <a href="#destaques">Destaques do Acervo</a>
        <a href="#depoimentos">Depoimentos</a>
        <a href="#faq">FAQ</a>
        <a href="#contato">Contato</a>
      </ul>
      </nav>
  <body>

  <!--Menu de navegação side-->
  <?php include("sidebarLogado.php"); ?>

  <main>
  <!-- Seção de destaque com imagem e frase principal -->
  <div class="hero">
    <h2>Bem-vindo à Biblioteca Luar Dourado</h2>
    <p>Mais de 500 títulos à disposição da comunidade</p>
    <a href="acervo.php" class="btn">Explore nosso acervo</a>
</div>

  <!-- Sobre a biblioteca -->

  <div class="author-spotlight">
    <img src="imgG/Azul e Dourado Ícone de Livro Educação Logotipo (Apresentação).jpg" alt="Monteiro Lobato" width="200" height="200">
    <div>
        <h3>Sobre Nós</h3>
        <p>A Biblioteca Luar Dourado, fundada em 2025, é um espaço dedicado à preservação do conhecimento, da cultura e da imaginação. Com um acervo cuidadosamente selecionado que abrange desde clássicos da literatura até obras contemporâneas, a biblioteca convida leitores de todas as idades a explorarem novos mundos através das palavras. Seu ambiente acolhedor, iluminado pela simbólica “luz dourada” do saber, é um refúgio para quem busca aprendizado, inspiração e tranquilidade. Mais do que um repositório de livros, a Luar Dourado é um ponto de encontro para a comunidade, promovendo eventos culturais, oficinas e rodas de leitura que estimulam o diálogo e o pensamento crítico.</p>
    </div>
</div>

  <!-- Seção com livros famosos -->
  <section class="section" id="destaques">
    <h2>Destaques do Acervo</h2>
    <div class="book-grid">
      <div class="book-card">
          <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/81klJGqMlcL._SY466_.jpg');"></div>
          <div class="book-info">
            <a href="HP.php">
              <h3>Harry Potter e a Pedra Filosofal</h3></a>
              <p>J.K. Rowling </p>
          </div>
      </div>
      
      <div class="book-card">
        <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/819js3EQwbL._SY466_.jpg');"></div>
          <div class="book-info">
            <a href="1984.php">
            <h3>1984</h3></a>
            <p>George Orwell</p>
          </div>
      </div>
      
      <div class="book-card">
          <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/71HgBiS-LKL._SY466_.jpg');"></div>
          <div class="book-info">
            <a href="OPP.php">
              <h3>O Pequeno Príncipe</h3></a>
              <p>Antoine de Saint-Exupéry</p>
          </div>
      </div>
      
      <div class="book-card">
          <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/51IOoDKaUaL._SY445_SX342_.jpg');"></div>
          <div class="book-info">
            <a href="amendoas.php">
              <h3>Amêndoas</h3></a>
              <p> Won-pyung Sohn</p>
          </div>
      </div>
      
      <div class="book-card">
          <div class="book-cover" style="background-image: url('https://m.media-amazon.com/images/I/716EGgqzyOL._SY466_.jpg');"></div>
          <div class="book-info">
            <a href="OneP.php">
              <h3>One Piece Vol. 1 </h3></a>
              <p>Eiichiro Oda </p>
          </div>
      </div>
  </div>
  </section>

  <!-- Seção com depoimentos de leitores -->
  <section class="section" id="depoimentos">
    <h2>Depoimentos de Leitores</h2>
    <div class="testimonials">
      <div class="testimonial">
        <p>"A Biblioteca Luar Dourado me ajudou a reencontrar o prazer da leitura!" — Ana Clara, 22 anos</p>
      </div>
      <div class="testimonial">
        <p>"Ambiente tranquilo e ótimos livros. Recomendo demais!" — Marcelo, 30 anos</p>
      </div>
    </div>
  </section>

  <!-- Seção de perguntas frequentes -->
  <section class="section" id="faq">
    <h2>Perguntas Frequentes (FAQ)</h2>
    <div class="faq-item">
      <h4>Como faço um empréstimo?</h4>
      <p>Você pode pegar até 3 livros por vez com validade de 15 dias.</p>
    </div>
    <div class="faq-item">
        <h4>E se eu atrasar a devolução?</h4>
        <p>A cada dia de atraso é adicionado uma multa de R$1,00.</p>
      </div>
    <div class="faq-item">
      <h4>Como me cadastro?</h4>
      <p>Preencha o formulário abaixo ou venha presencialmente com documento com foto.</p>
    </div>
  </section>
 
  <!-- Seção de contato -->
  <section class="section" id="contato">
    <h2>Contato</h2>
    <p style="text-align:center;">biblioteca@luardourado.com.br | (21) 98765-4321</p>
  </section>

  </main>
  <script> 
const resizeBtn = document.querySelector('[data-resize-btn]');

resizeBtn.addEventListener('click', function(e) {
  e.preventDefault();
  document.body.classList.toggle('sb-expanded');
});
</script>

  <!-- Rodapé da página -->
  <footer>
    <p>&copy; 2025 Biblioteca Luar Dourado — Todos os direitos reservados</p>
    <div class="footer-links">
      <a href="#inicio">Início</a>
      <a href="acervo.php">Acervo</a>
      <a href="#contato">Contato</a>
    </div>

  </footer>
</body>
</html>