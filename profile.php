<?php
  // Inclui o arquivo do cabeçalho do template
  require_once("templates/header.php");

  // Inclui arquivos necessários para verificação e manipulação de usuários e filmes
  require_once("models/User.php"); // Modelo para a entidade User
  require_once("dao/UserDAO.php"); // DAO para operações de usuário
  require_once("dao/MovieDAO.php"); // DAO para operações de filmes

  // Cria instâncias dos objetos de usuário e DAO
  $user = new User(); // Instância para manipular dados de usuário
  $userDao = new UserDAO($conn, $BASE_URL); // Instância para acessar dados do usuário
  $movieDao = new MovieDAO($conn, $BASE_URL); // Instância para acessar dados dos filmes

  // Recebe o ID do usuário da URL
  $id = filter_input(INPUT_GET, "id");

  // Verifica se o ID do usuário está vazio
  if(empty($id)) {

    // Se o ID estiver vazio e o usuário estiver autenticado
    if(!empty($userData)) {
      // Usa o ID do usuário autenticado
      $id = $userData->id;
    } else {
      // Define uma mensagem de erro se o usuário não for encontrado
      $message->setMessage("Usuário não encontrado!", "error", "index.php");
    }

  } else {
    // Se o ID do usuário estiver presente, busca os dados do usuário
    $userData = $userDao->findById($id);

    // Se o usuário não for encontrado
    if(!$userData) {
      // Define uma mensagem de erro
      $message->setMessage("Usuário não encontrado!", "error", "index.php");
    }
  }

  // Obtém o nome completo do usuário
  $fullName = $user->getFullName($userData);

  // Define a imagem padrão se a imagem do usuário estiver vazia
  if($userData->image == "") {
    $userData->image = "user.png";
  }

  // Obtém os filmes que o usuário adicionou
  $userMovies = $movieDao->getMoviesByUserId($id);

?>
  <!-- Início do contêiner principal da página -->
  <div id="main-container" class="container-fluid">
    <div class="col-md-8 offset-md-2">
      <div class="row profile-container">
        <div class="col-md-12 about-container">
          <!-- Título da página com o nome completo do usuário -->
          <h1 class="page-title"><?= $fullName ?></h1>
          <!-- Contêiner da imagem do perfil do usuário -->
          <div id="profile-image-container" class="profile-image" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
          <!-- Seção sobre o usuário -->
          <h3 class="about-title">Sobre:</h3>
          <?php if(!empty($userData->bio)): ?>
            <!-- Exibe a biografia do usuário se estiver disponível -->
            <p class="profile-description"><?= $userData->bio ?></p>
          <?php else: ?>
            <!-- Mensagem padrão se a biografia estiver vazia -->
            <p class="profile-description">O usuário ainda não escreveu nada aqui...</p>
          <?php endif; ?>
        </div>
        <div class="col-md-12 added-movies-container">
          <!-- Título da seção de animes enviados -->
          <h3>Animes que enviou:</h3>
          <div class="movies-container">
            <?php foreach($userMovies as $movie): ?>
              <!-- Inclui o arquivo do card do filme para cada filme enviado pelo usuário -->
              <?php require("templates/movie_card.php"); ?>
            <?php endforeach; ?>
            <?php if(count($userMovies) === 0): ?>
              <!-- Mensagem exibida quando o usuário não enviou nenhum anime -->
              <p class="empty-list">O usuário ainda não enviou animes.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
  // Inclui o arquivo do rodapé do template
  require_once("templates/footer.php");
?>
