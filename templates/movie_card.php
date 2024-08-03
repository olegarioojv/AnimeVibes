<?php

  // Verifica se o objeto do filme tem uma imagem definida
  // Se não tiver, define uma imagem padrão
  if(empty($movie->image)) {
    $movie->image = "movie_cover.jpg";
  }

?>
<!-- Início do cartão de filme -->
<div class="card movie-card">
  <!-- Imagem do cartão, exibida como fundo de um contêiner -->
  <div class="card-img-top" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
  <div class="card-body">
    <!-- Seção de classificação do filme -->
    <p class="card-rating">
      <i class="fas fa-star"></i> <!-- Ícone de estrela para a nota -->
      <span class="rating"><?= $movie->rating ?></span> <!-- Nota do filme -->
    </p>
    <!-- Título do filme com link para a página do filme -->
    <h5 class="card-title">
      <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>"><?= $movie->title ?></a>
    </h5>
    <!-- Botão para avaliar o filme -->
    <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary rate-btn">Avaliar</a>
    <!-- Botão para conhecer mais sobre o filme -->
    <a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="btn btn-primary card-btn">Conhecer</a>
  </div>
</div>
