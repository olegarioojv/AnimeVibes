# AnimeVibes 🎬

Uma plataforma web interativa para descobrir, compartilhar e avaliar seus animes e filmes favoritos!

## 📋 Sobre o Projeto

**AnimeVibes** é uma aplicação web desenvolvida em PHP que funciona como um catálogo social de animes e filmes. Os usuários podem:

- ✅ Criar uma conta e gerenciar seu perfil
- ✅ Adicionar novos animes/filmes ao catálogo
- ✅ Editar informações de conteúdos
- ✅ Escrever e visualizar reviews/avaliações
- ✅ Pesquisar por título ou categoria
- ✅ Visualizar trailers do YouTube
- ✅ Explorar conteúdos por categorias (Ação, Aventura, Drama, Mistério, Romance, Ficção Científica, etc.)
- ✅ Acessar um dashboard personalizado

## 🛠️ Stack Tecnológico

- **Backend**: PHP 8.2+
- **Banco de Dados**: MySQL 8.0+
- **Frontend**: HTML5, CSS3
- **Servidor Local**: Laragon/Apache

## 📁 Estrutura do Projeto

```
AnimeVibes/
├── 📄 index.php                 # Página inicial
├── 📄 auth.php                  # Autenticação/Login
├── 📄 dashboard.php             # Painel do usuário
├── 📄 movie.php                 # Detalhes do anime/filme
├── 📄 newmovie.php              # Criar novo conteúdo
├── 📄 editmovie.php             # Editar conteúdo
├── 📄 profile.php               # Perfil do usuário
├── 📄 editprofile.php           # Editar perfil
├── 📄 search.php                # Buscar conteúdos
├── 📄 logout.php                # Sair da conta
├── 📄 db.php                    # Conexão com banco de dados
├── 📄 globals.php               # Variáveis globais
│
├── 📁 dao/                      # Data Access Objects (DAOs)
│   ├── MovieDAO.php             # Operações com filmes
│   ├── ReviewDAO.php            # Operações com reviews
│   └── UserDAO.php              # Operações com usuários
│
├── 📁 models/                   # Classes de modelo
│   ├── Movie.php                # Modelo de Anime/Filme
│   ├── Review.php               # Modelo de Review
│   └── User.php                 # Modelo de Usuário
│
├── 📁 templates/                # Componentes reutilizáveis
│   ├── header.php               # Cabeçalho
│   ├── footer.php               # Rodapé
│   ├── movie_card.php           # Card de filme
│   └── user_review.php          # Exibição de review
│
├── 📁 css/                      # Estilos
│   └── styles1.css
│
├── 📁 db/                       # Banco de dados
│   └── movie.sql                # Script de criação
│
└── 📁 img/                      # Imagens
    ├── movies/                  # Capas de filmes
    └── users/                   # Fotos de perfil
```

## 🚀 Como Executar

### Pré-requisitos

- **Laragon** (ou Apache + PHP 8.2+ + MySQL 8.0+)
- **VS Code** ou editor de sua preferência

### Passos de Instalação

1. **Clone ou copie o projeto para a pasta www do Laragon**

   ```
   C:\laragon\www\AnimeVibes
   ```

2. **Importe o banco de dados**
   - Abra o phpMyAdmin (geralmente em `http://localhost/phpmyadmin`)
   - Crie um novo banco de dados (ou importe o arquivo `db/movie.sql`)
   - Configure as credenciais em `db.php`

3. **Configure a conexão com o banco**
   - Edite o arquivo `db.php` com suas credenciais:

   ```php
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "animevibes";
   ```

4. **Inicie o servidor Laragon**
   - Clique em "Start All" no Laragon

5. **Acesse a aplicação**
   ```
   http://localhost/AnimeVibes
   ```

## 📝 Funcionalidades Principais

### Autenticação

- Registro de novo usuário
- Login seguro
- Sessões de usuário
- Logout

### Gerenciamento de Conteúdo

- Criar novo anime/filme com:
  - Título
  - Descrição
  - Imagem/Capa
  - Link do trailer (YouTube)
  - Categoria
  - Duração
- Editar informações de conteúdo existente
- Visualizar detalhes completos

### Sistema de Reviews

- Escrever avaliações/comentários
- Visualizar reviews de outros usuários
- Gerenciar próprias avaliações

### Busca e Filtros

- Pesquisar por título
- Filtrar por categoria
- Explorar conteúdos mais recentes

### Perfil de Usuário

- Editar informações pessoais
- Gerenciar animes/filmes adicionados
- Ver histórico de atividades

## 🎯 Padrões de Código Utilizados

- **DAO (Data Access Object)**: Separação da lógica de banco de dados
- **MVC**: Separação entre dados (models), acesso (dao) e apresentação (templates)
- **OOP**: Uso de classes e objetos

## 📸 Demo do Projeto

<div align="center">

### 🎥 Demonstração

<img src="AnimeVibes.gif" alt="Demo do AnimeVibes" width="560"/>

</div>

## 🔧 Configuração Avançada

### Modificar Categorias

As categorias estão armazenadas no banco de dados. Para adicionar novas:

1. Edite a tabela `movies` em `db/movie.sql`
2. Atualize os filtros em `index.php` e `search.php`

### Personalizar Estilos

Modifique o arquivo `css/styles1.css` para alterar a aparência visual.

---

**Desenvolvido com ❤️**
