<?php
  // Inclui o arquivo de cabeçalho do template
  require_once("templates/header.php");

  // Inclui o arquivo da DAO (Data Access Object) para filmes
  require_once("dao/MovieDAO.php");

  // Cria uma instância da DAO dos filmes
  $movieDao = new MovieDAO($conn, $BASE_URL);

  // Resgata a busca do usuário a partir da URL
  $q = filter_input(INPUT_GET, "q");

  // Busca os filmes que correspondem ao título fornecido
  $movies = $movieDao->findByTitle($q);
?>
  <!-- Início do contêiner principal da página -->
  <div id="main-container" class="container-fluid">
    <!-- Título da seção com o termo pesquisado pelo usuário -->
    <h2 class="section-title" id="search-title">Você está buscando por: <span id="search-result"><?= $q ?></span></h2>
    <!-- Descrição da seção -->
    <p class="section-description">Resultados de busca retornados com base na sua pesquisa.</p>
    <!-- Contêiner para exibir os filmes encontrados -->
    <div class="movies-container">
      <?php foreach($movies as $movie): ?>
        <!-- Inclui o arquivo do card do filme para cada filme encontrado -->
        <?php require("templates/movie_card.php"); ?>
      <?php endforeach; ?>
      <?php if(count($movies) === 0): ?>
        <!-- Mensagem exibida quando nenhum filme é encontrado -->
        <p class="empty-list">Não há animes para esta busca, <a href="<?= $BASE_URL ?>" class="back-link">voltar</a>.</p>
      <?php endif; ?>
    </div>
  </div>
<?php
  // Inclui o arquivo de rodapé do template
  require_once("templates/footer.php");
?>
