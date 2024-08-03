<?php
  // Inclui o cabeçalho do template
  require_once("templates/header.php");

  // Inclui a classe DAO para operações com animes
  require_once("dao/MovieDAO.php");

  // Cria uma instância do MovieDAO para acessar o banco de dados
  $movieDao = new MovieDAO($conn, $BASE_URL);

  // Obtém a lista dos últimos animes adicionados
  $latestMovies = $movieDao->getLatestMovies();

  // Obtém animes filtrados por categorias específicas
  $actionMovies = $movieDao->getMoviesByCategory("Ação");
  $adventureMovies = $movieDao->getMoviesByCategory("Aventura");
  $dramaMovies = $movieDao->getMoviesByCategory("Drama");
  $mysteryMovies = $movieDao->getMoviesByCategory("Mistério");
  $romanceMovies = $movieDao->getMoviesByCategory("Romance");
  $sciFiMovies = $movieDao->getMoviesByCategory("Ficção Científica");
  $horrorMovies = $movieDao->getMoviesByCategory("Terror");
?>

<!-- Início do container principal da página -->
<div id="main-container" class="container-fluid">

  <!-- Seção para os animes mais recentes -->
  <h2 class="section-title">Animes novos</h2>
  <p class="section-description">Veja as críticas dos últimos animes adicionados no AnimeVibes</p>
  <div class="movies-container">
    <!-- Loop para exibir cada anime da lista de novos animes -->
    <?php foreach($latestMovies as $movie): ?>
      <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <!-- Mensagem se não houver animes recentes -->
    <?php if(count($latestMovies) === 0): ?>
      <p class="empty-list">Ainda não há animes cadastrados!</p>
    <?php endif; ?>
  </div>

  <!-- Seção para animes de ação -->
  <h2 class="section-title">Ação</h2>
  <p class="section-description">Veja os melhores animes de ação</p>
  <div class="movies-container">
    <!-- Loop para exibir cada anime da lista de ação -->
    <?php foreach($actionMovies as $movie): ?>
      <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <!-- Mensagem se não houver animes de ação -->
    <?php if(count($actionMovies) === 0): ?>
      <p class="empty-list">Ainda não há animes de ação cadastrados!</p>
    <?php endif; ?>
  </div>

  <!-- Seção para animes de aventura -->
  <h2 class="section-title">Aventura</h2>
  <p class="section-description">Veja os melhores animes de aventura</p>
  <div class="movies-container">
    <!-- Loop para exibir cada anime da lista de aventura -->
    <?php foreach($adventureMovies as $movie): ?>
      <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <!-- Mensagem se não houver animes de aventura -->
    <?php if(count($adventureMovies) === 0): ?>
      <p class="empty-list">Ainda não há animes de aventura cadastrados!</p>
    <?php endif; ?>
  </div>

  <!-- Seção para animes de drama -->
  <h2 class="section-title">Drama</h2>
  <p class="section-description">Veja os melhores animes de drama</p>
  <div class="movies-container">
    <!-- Loop para exibir cada anime da lista de drama -->
    <?php foreach($dramaMovies as $movie): ?>
      <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <!-- Mensagem se não houver animes de drama -->
    <?php if(count($dramaMovies) === 0): ?>
      <p class="empty-list">Ainda não há animes de drama cadastrados!</p>
    <?php endif; ?>
  </div>

  <!-- Seção para animes de mistério -->
  <h2 class="section-title">Mistério</h2>
  <p class="section-description">Veja os melhores animes de mistério</p>
  <div class="movies-container">
    <!-- Loop para exibir cada anime da lista de mistério -->
    <?php foreach($mysteryMovies as $movie): ?>
      <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <!-- Mensagem se não houver animes de mistério -->
    <?php if(count($mysteryMovies) === 0): ?>
      <p class="empty-list">Ainda não há animes de mistério cadastrados!</p>
    <?php endif; ?>
  </div>

  <!-- Seção para animes de romance -->
  <h2 class="section-title">Romance</h2>
  <p class="section-description">Veja os melhores animes de romance</p>
  <div class="movies-container">
    <!-- Loop para exibir cada anime da lista de romance -->
    <?php foreach($romanceMovies as $movie): ?>
      <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <!-- Mensagem se não houver animes de romance -->
    <?php if(count($romanceMovies) === 0): ?>
      <p class="empty-list">Ainda não há animes de romance cadastrados!</p>
    <?php endif; ?>
  </div>

  <!-- Seção para animes de ficção científica -->
  <h2 class="section-title">Ficção Científica</h2>
  <p class="section-description">Veja os melhores animes de ficção científica</p>
  <div class="movies-container">
    <!-- Loop para exibir cada anime da lista de ficção científica -->
    <?php foreach($sciFiMovies as $movie): ?>
      <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <!-- Mensagem se não houver animes de ficção científica -->
    <?php if(count($sciFiMovies) === 0): ?>
      <p class="empty-list">Ainda não há animes de ficção científica cadastrados!</p>
    <?php endif; ?>
  </div>

  <!-- Seção para animes de terror -->
  <h2 class="section-title">Terror</h2>
  <p class="section-description">Veja os melhores animes de terror</p>
  <div class="movies-container">
    <!-- Loop para exibir cada anime da lista de terror -->
    <?php foreach($horrorMovies as $movie): ?>
      <?php require("templates/movie_card.php"); ?>
    <?php endforeach; ?>
    <!-- Mensagem se não houver animes de terror -->
    <?php if(count($horrorMovies) === 0): ?>
      <p class="empty-list">Ainda não há animes de terror cadastrados!</p>
    <?php endif; ?>
  </div>

</div>

<?php
  // Inclui o rodapé do template
  require_once("templates/footer.php");
?>
