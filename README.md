# 📚 Biblioteca Luar Dourado

Este projeto é um **sistema web de biblioteca** desenvolvido em **PHP, CSS e JavaScript**, com funcionalidades para cadastro de usuários, login, aluguel de livros, gerenciamento de perfil e visualização de acervo.

## 🚀 Funcionalidades

* Cadastro e login de usuários
* Alteração de senha, foto e informações do perfil
* Consulta ao acervo de livros disponíveis
* Aluguel de livros
* Histórico de empréstimos
* Sistema de comentários
* Painel com páginas de ajuda e FAQ

## 🛠️ Tecnologias Utilizadas

* **PHP** (backend e lógica do sistema)
* **MySQL** (banco de dados, configurado em `config.php`)
* **HTML5, CSS3 e JavaScript** (interface do usuário)

## 📂 Estrutura do Projeto

```
newbld/
├── newbld/
│   ├── acervo.php        # Página do acervo de livros
│   ├── aluguel.php       # Página de aluguel
│   ├── login.php         # Página de login
│   ├── inscrever.php     # Página de cadastro
│   ├── perfil.php        # Gerenciamento do perfil
│   ├── historico.php     # Histórico de empréstimos
│   ├── home.php          # Página inicial
│   ├── config.php        # Configuração do banco de dados
│   ├── *.css             # Estilos do sistema
│   ├── *.js              # Scripts do sistema
│   └── dashboard/        # Páginas estáticas (FAQ, ajuda, etc.)
```

## ⚙️ Configuração e Instalação

1. Clone este repositório:

   ```bash
   git clone https://github.com/seu-usuario/newbld.git
   ```
2. Mova os arquivos para o diretório do seu servidor local (exemplo: `htdocs` no XAMPP).
3. Configure o banco de dados MySQL em `config.php` com suas credenciais.
4. Importe o script SQL (se disponível) para criar as tabelas necessárias.
5. Acesse o sistema pelo navegador:

   ```
   http://localhost/newbld
   ```

## 👥 Contribuição

Sinta-se à vontade para abrir **issues** e enviar **pull requests** com melhorias, correções e novas funcionalidades.
