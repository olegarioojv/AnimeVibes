<?php
  // Inclui o cabeçalho do template
  require_once("templates/header.php");

  // Inclui os modelos e DAOs necessários para manipulação de usuários e filmes
  require_once("models/User.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  // Cria instâncias das classes User e MovieDAO
  $user = new User();
  $userDao = new UserDAO($conn, $BASE_URL);
  $movieDao = new MovieDAO($conn, $BASE_URL);

  // Verifica o token do usuário e obtém seus dados
  $userData = $userDao->verifyToken(true);

  // Obtém a lista de filmes enviados pelo usuário
  $userMovies = $movieDao->getMoviesByUserId($userData->id);
?>
  <!-- Início do container principal da página de dashboard -->
  <div id="main-container" class="container-fluid">
    <h2 class="section-title">Dashboard</h2> <!-- Título da seção -->
    <p class="section-description">Adicione ou atualize as informações dos animes que você enviou</p>
    <!-- Botão para adicionar um novo anime -->
    <div class="col-md-12" id="add-movie-container">
      <a href="<?= $BASE_URL ?>newmovie.php" class="btn card-btn">
        <i class="fas fa-plus"></i> Adicionar Anime
      </a>
    </div>
    <!-- Tabela com os animes enviados pelo usuário -->
    <div class="col-md-12" id="movies-dashboard">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th> <!-- Coluna para ID -->
            <th scope="col">Título</th> <!-- Coluna para título -->
            <th scope="col">Nota</th> <!-- Coluna para nota -->
            <th scope="col" class="actions-column">Ações</th> <!-- Coluna para ações -->
          </tr>
        </thead>
        <tbody>
          <?php foreach($userMovies as $movie): ?>
          <tr>
            <td scope="row"><?= $movie->id ?></td> <!-- Exibe o ID do filme -->
            <td><a href="<?= $BASE_URL ?>movie.php?id=<?= $movie->id ?>" class="table-movie-title"><?= $movie->title ?></a></td> <!-- Link para a página do filme -->
            <td><i class="fas fa-star"></i> <?= $movie->rating ?></td> <!-- Exibe a nota do filme -->
            <td class="actions-column">
              <!-- Link para editar o filme -->
              <a href="<?= $BASE_URL ?>editmovie.php?id=<?= $movie->id ?>" class="edit-btn">
                <i class="far fa-edit"></i> Editar
              </a>
              <!-- Formulário para deletar o filme -->
              <form action="<?= $BASE_URL ?>movie_process.php" method="POST">
                <input type="hidden" name="type" value="delete"> <!-- Especifica o tipo de operação (deleção) -->
                <input type="hidden" name="id" value="<?= $movie->id ?>"> <!-- Inclui o ID do filme no formulário -->
                <button type="submit" class="delete-btn">
                  <i class="fas fa-times"></i> Deletar
                </button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
<?php
  // Inclui o rodapé do template
  require_once("templates/footer.php");
?>
