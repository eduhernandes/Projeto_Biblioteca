# Sistema de Biblioteca

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
</p>

Sistema web para gestão de biblioteca, com foco em cadastro e controle de livros, leitores e empréstimos.

## 📌 Visão Geral
O Sistema de Biblioteca foi desenvolvido para auxiliar na organização de uma unidade bibliotecária, permitindo o registro, consulta e manutenção de informações essenciais sobre livros, leitores e movimentações de empréstimo. A aplicação foi criada com PHP, HTML, CSS e MySQL, com arquitetura simples e objetiva para fins acadêmicos e de aprendizado.

## 🎯 Objetivo
Centralizar as operações da biblioteca em um único sistema, reduzindo o uso de processos manuais e facilitando o controle de acervo e usuários.

## ✨ Funcionalidades
- Cadastro de livros
- Edição e exclusão de livros
- Listagem e consulta de livros
- Cadastro de leitores
- Edição e exclusão de leitores
- Listagem e consulta de leitores
- Registro de empréstimos
- Consulta de empréstimos realizados
- Interface inicial para navegação entre módulos

## 🛠️ Tecnologias Utilizadas
| Tecnologia | Descrição |
| --- | --- |
| PHP | Linguagem principal da aplicação |
| HTML5 | Estrutura das páginas |
| CSS3 | Estilização da interface |
| JavaScript | Interações e melhorias de experiência |
| MySQL | Banco de dados relacional |
| XAMPP | Ambiente local para PHP + MySQL |
| Git/GitHub | Versionamento e compartilhamento do código |
| VS Code | Editor de desenvolvimento |

## 📂 Estrutura do Projeto
```text
Projeto_Biblioteca/
├── assets/
├── books/
│   ├── cadastrar.php
│   ├── editar.php
│   ├── excluir.php
│   ├── form.php
│   ├── index.php
│   └── listar.php
├── database/
│   ├── biblioteca_2024-09-27.sql
│   └── biblioteca_2024-10-10.sql
├── loans/
│   ├── cadastrar.php
│   ├── form.php
│   ├── index.php
│   └── listar.php
├── readers/
│   ├── atualizar.php
│   ├── cadastrar.php
│   ├── editar.php
│   ├── excluir.php
│   ├── form.php
│   ├── index.php
│   └── listar.php
├── db.php
├── index.html
├── README.md
├── LICENSE
├── style.css
└── ...
```

## ✅ Requisitos
Antes de executar o projeto, certifique-se de que o ambiente possui:

- PHP
- MySQL
- Apache ou XAMPP
- Navegador web
- Editor de código (recomendado: VS Code)

## 🚀 Instalação e Execução
1. Clone o repositório para o diretório do servidor local:
   ```bash
   git clone https://github.com/eduhernandes/Projeto_Biblioteca.git
   ```
2. Copie a pasta para a pasta de projetos do XAMPP, por exemplo:
   ```text
   C:/xampp/htdocs/Projeto_Biblioteca
   ```
3. Inicie o Apache e o MySQL no XAMPP.
4. Crie o banco de dados conforme a configuração em `db.php`.
5. Importe o script SQL disponível em `database/`.
6. Acesse a aplicação no navegador:
   ```text
   http://localhost/Projeto_Biblioteca
   ```

## 🗄️ Configuração do Banco de Dados
A conexão padrão está configurada em `db.php` com os seguintes parâmetros:

- Host: `localhost`
- Usuário: `root`
- Senha: vazia
- Banco: `db_biblioteca`

> Ajuste os dados conforme a configuração do seu ambiente local, se necessário.

## 🧭 Como Usar
1. Acesse a página inicial do sistema.
2. Escolha a área desejada: leitores, livros ou empréstimos.
3. Cadastre, consulte, edite ou exclua os registros conforme a necessidade.
4. Utilize o sistema para manter o controle de informações da biblioteca de forma organizada.

## 📝 Observações
Este projeto é uma solução prática para fins acadêmicos e de aprendizado, com foco em operações básicas de gestão bibliotecária.

## 📄 Licença
Este projeto está licenciado sob a MIT License. Consulte o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👤 Autor
Sistema de Biblioteca desenvolvido como projeto de gestão bibliotecária em PHP e MySQL.

