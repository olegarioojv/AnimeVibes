<?php

    // Inclui o modelo User para manipulação de dados de usuários
    require_once("models/User.php");

    // Cria uma instância do modelo User
    $userModel = new User();

    // Obtém o nome completo do usuário baseado no identificador do usuário da revisão
    $fullName = $userModel->getFullName($review->user);

    // Verifica se o usuário possui uma imagem de perfil
    // Se não tiver, define uma imagem padrão
    if($review->user->image == "") {
      $review->user->image = "user.png";
    }

?>
<!-- Início do bloco de revisão -->
<div class="col-md-12">
  <div class="row">
    <!-- Seção de imagem do perfil do usuário -->
    <div class="col-md-1">
      <!-- Exibe a imagem de perfil do usuário como fundo de um contêiner -->
      <div class="profile-image-container review-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $review->user->image ?>')"></div>
    </div>
    <!-- Seção de detalhes do autor da revisão -->
    <div class="col-md-9 author-details-container">
      <!-- Nome do autor com link para o perfil do usuário -->
      <h4 class="author-name">
        <a href="<?= $BASE_URL ?>profile.php?id=<?= $review->user->id ?>"><?= $fullName ?></a>
      </h4>
      <!-- Exibe a nota da revisão -->
      <p><i class="fas fa-star"></i> <?= $review->rating ?></p>
    </div>
    <!-- Seção do comentário da revisão -->
    <div class="col-md-12">
      <!-- Título do comentário -->
      <p class="comment-title">Comentário:</p>
      <!-- Conteúdo do comentário -->
      <p><?= $review->review ?></p
