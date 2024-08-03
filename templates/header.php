<?php

  // Inclui arquivos necessários para configuração e acesso ao banco de dados
  require_once("globals.php");
  require_once("db.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  // Cria uma nova instância da classe Message para gerenciar mensagens
  $message = new Message($BASE_URL);

  // Obtém a mensagem atual, se houver
  $flassMessage = $message->getMessage();

  // Se houver uma mensagem, limpa a mensagem após a leitura
  if(!empty($flassMessage["msg"])) {
    // Limpar a mensagem
    $message->clearMessage();
  }

  // Cria uma nova instância da classe UserDAO para acessar dados do usuário
  $userDao = new UserDAO($conn, $BASE_URL);

  // Verifica o token do usuário para autenticação
  $userData = $userDao->verifyToken(false);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AnimeVibes</title>
  <!-- Ícone da página -->
  <link rel="short icon" href="<?= $BASE_URL ?>img/moviestar.png" />
  <!-- Bootstrap para estilos e layout -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.css" integrity="sha512-drnvWxqfgcU6sLzAJttJv7LKdjWn0nxWCSbEAtxJ/YYaZMyoNLovG7lPqZRdhgL1gAUfa+V7tbin8y+2llC1cw==" crossorigin="anonymous" />
  <!-- Font Awesome para ícones -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
  <!-- CSS específico do projeto -->
  <link rel="stylesheet" href="<?= $BASE_URL ?>css/styles1.css">
</head>
<body>
  <!-- Cabeçalho da página -->
  <header>
    <nav id="main-navbar" class="navbar navbar-expand-lg">
      <!-- Logo e nome do site -->
      <a href="<?= $BASE_URL ?>" class="navbar-brand">
        <img src="<?= $BASE_URL ?>img/moviestar1.svg" alt="MovieStar" id="logo">
        <span id="moviestar-title">AnimeVibes</span>
      </a>
      <!-- Botão para colapsar o menu em dispositivos móveis -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <!-- Formulário de busca -->
      <form action="<?= $BASE_URL ?>search.php" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
        <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar Animes" aria-label="Search">
        <button class="btn my-2 my-sm-0" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <!-- Menu de navegação -->
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav">
          <?php if($userData): ?>
            <!-- Links visíveis para usuários autenticados -->
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>newmovie.php" class="nav-link">
                <i class="far fa-plus-square"></i> Incluir Anime
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>dashboard.php" class="nav-link">Meus Animes</a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>editprofile.php" class="nav-link bold">
                <?= $userData->name ?>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>logout.php" class="nav-link">Sair</a>
            </li>
          <?php else: ?>
            <!-- Link visível para usuários não autenticados -->
            <li class="nav-item">
              <a href="<?= $BASE_URL ?>auth.php" class="nav-link">Entrar / Cadastrar</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Exibição de mensagens, se houver -->
  <?php if(!empty($flassMessage["msg"])): ?>
    <div class="msg-container">
      <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
    </div>
  <?php endif; ?>
