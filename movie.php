<?php
  // Inclui o arquivo do cabeçalho do template
  require_once("templates/header.php");

  // Inclui os arquivos necessários para manipular filmes e avaliações
  require_once("models/Movie.php"); // Modelo para a entidade Movie
  require_once("dao/MovieDAO.php"); // DAO para operações de filme
  require_once("dao/ReviewDAO.php"); // DAO para operações de avaliação

  // Obtém o ID do anime da URL
  $id = filter_input(INPUT_GET, "id");

  $movie; // Variável para armazenar o objeto do anime

  // Cria instâncias dos DAOs
  $movieDao = new MovieDAO($conn, $BASE_URL); // Instância para acessar dados do filme
  $reviewDao = new ReviewDAO($conn, $BASE_URL); // Instância para acessar dados das avaliações

  // Verifica se o ID do anime está vazio
  if(empty($id)) {
    // Define uma mensagem de erro se o ID estiver vazio
    $message->setMessage("O anime não foi encontrado!", "error", "index.php");
  } else {
    // Busca o anime pelo ID
    $movie = $movieDao->findById($id);

    // Verifica se o anime foi encontrado
    if(!$movie) {
      // Define uma mensagem de erro se o anime não for encontrado
      $message->setMessage("O anime não foi encontrado!", "error", "index.php");
    }
  }

  // Verifica se o anime tem uma imagem
  if($movie->image == "") {
    // Define uma imagem padrão se a imagem do anime estiver vazia
    $movie->image = "movie_cover.jpg";
  }

  // Verifica se o usuário autenticado é o dono do anime
  $userOwnsMovie = false;

  if(!empty($userData)) {
    if($userData->id === $movie->users_id) {
      $userOwnsMovie = true;
    }

    // Verifica se o usuário já enviou uma avaliação para este anime
    $alreadyReviewed = $reviewDao->hasAlreadyReviewed($id, $userData->id);
  }

  // Busca as avaliações do anime
  $movieReviews = $reviewDao->getMoviesReview($movie->id);

?>
<div id="main-container" class="container-fluid">
  <div class="row">
    <div class="offset-md-1 col-md-6 movie-container">
      <!-- Título do anime -->
      <h1 class="page-title"><?= $movie->title ?></h1>
      <!-- Detalhes do anime: duração, categoria e avaliação -->
      <p class="movie-details">
        <span>Duração: <?= $movie->length ?></span>
        <span class="pipe"></span>
        <span><?= $movie->category ?></span>
        <span class="pipe"></span>
        <span><i class="fas fa-star"></i> <?= $movie->rating ?></span>
      </p>
      <!-- Trailer do anime -->
      <iframe src="<?= $movie->trailer ?>" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <!-- Descrição do anime -->
      <p><?= $movie->description ?></p>
    </div>
    <div class="col-md-4">
      <!-- Imagem do anime -->
      <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
    </div>
    <div class="offset-md-1 col-md-10" id="reviews-container">
      <!-- Título da seção de avaliações -->
      <h3 id="reviews-title">Avaliações:</h3>
      <!-- Verifica se o usuário pode enviar uma avaliação -->
      <?php if(!empty($userData) && !$userOwnsMovie && !$alreadyReviewed): ?>
      <div class="col-md-12" id="review-form-container">
        <!-- Formulário para enviar uma avaliação -->
        <h4>Envie sua avaliação:</h4>
        <p class="page-description">Preencha o formulário com a nota e comentário sobre o anime</p>
        <form action="<?= $BASE_URL ?>review_process.php" id="review-form" method="POST">
          <!-- Campo oculto para identificar o tipo de formulário -->
          <input type="hidden" name="type" value="create">
          <input type="hidden" name="movies_id" value="<?= $movie->id ?>">
          <!-- Campo para selecionar a nota do anime -->
          <div class="form-group">
            <label for="rating">Nota do anime:</label>
            <select name="rating" id="rating" class="form-control">
              <option value="">Selecione</option>
              <option value="10">10</option>
              <option value="9">9</option>
              <option value="8">8</option>
              <option value="7">7</option>
              <option value="6">6</option>
              <option value="5">5</option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
            </select>
          </div>
          <!-- Campo para escrever um comentário sobre o anime -->
          <div class="form-group">
            <label for="review">Seu comentário:</label>
            <textarea name="review" id="review" rows="3" class="form-control" placeholder="O que você achou do anime?"></textarea>
          </div>
          <!-- Botão para enviar a avaliação -->
          <input type="submit" class="btn card-btn" value="Enviar comentário">
        </form>
      </div>
      <?php endif; ?>
      <!-- Lista de comentários -->
      <?php foreach($movieReviews as $review): ?>
        <!-- Inclui o template para exibir cada avaliação -->
        <?php require("templates/user_review.php"); ?>
      <?php endforeach; ?>
      <?php if(count($movieReviews) == 0): ?>
        <!-- Mensagem exibida se não houver avaliações -->
        <p class="empty-list">Não há comentários para este anime ainda...</p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php
  // Inclui o arquivo do rodapé do template
  require_once("templates/footer.php");
?>
