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

  // Obtém o ID do anime da URL
  $id = filter_input(INPUT_GET, "id");

  // Verifica se o ID foi fornecido
  if(empty($id)) {
    $message->setMessage("O anime não foi encontrado!", "error", "index.php");
  } else {
    // Busca o anime pelo ID
    $movie = $movieDao->findById($id);

    // Verifica se o anime existe
    if(!$movie) {
      $message->setMessage("O anime não foi encontrado!", "error", "index.php");
    }
  }

  // Define uma imagem padrão se o anime não tiver uma imagem configurada
  if ($movie->image == "") {
    $movie->image = "movie_cover.jpg";
  }
?>
  <!-- Início do container principal da página de edição de anime -->
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row">
        <!-- Coluna para o formulário de edição do anime -->
        <div class="col-md-6 offset-md-1">
          <h1><?= $movie->title ?></h1> <!-- Exibe o título do anime -->
          <p class="page-description">Altere os dados do anime no formulário abaixo:</p>
          <!-- Formulário para edição dos dados do anime -->
          <form id="edit-movie-form" action="<?= $BASE_URL ?>movie_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="update"> <!-- Especifica o tipo de operação (atualização) -->
            <input type="hidden" name="id" value="<?= $movie->id ?>"> <!-- Inclui o ID do anime no formulário -->
            <!-- Campo para o título do anime -->
            <div class="form-group">
              <label for="title">Título:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu anime" value="<?= $movie->title ?>">
            </div>
            <!-- Campo para upload de nova imagem do anime -->
            <div class="form-group">
              <label for="image">Imagem:</label>
              <input type="file" class="form-control-file" name="image" id="image">
            </div>
            <!-- Campo para a duração do anime -->
            <div class="form-group">
              <label for="length">Duração:</label>
              <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do anime" value="<?= $movie->length ?>">
            </div>
            <!-- Campo para seleção da categoria do anime -->
            <div class="form-group">
              <label for="category">Categoria:</label>
              <select name="category" id="category" class="form-control">
                <option value="">Selecione</option>
                <option value="Ação" <?= $movie->category === "Ação" ? "selected" : "" ?>>Ação</option>
                <option value="Drama" <?= $movie->category === "Drama" ? "selected" : "" ?>>Drama</option>
                <option value="Comédia" <?= $movie->category === "Comédia" ? "selected" : "" ?>>Comédia</option>
                <option value="Fantasia / Ficção" <?= $movie->category === "Fantasia / Ficção" ? "selected" : "" ?>>Fantasia / Ficção</option>
                <option value="Romance" <?= $movie->category === "Romance" ? "selected" : "" ?>>Romance</option>
              </select>
            </div>
            <!-- Campo para o link do trailer do anime -->
            <div class="form-group">
              <label for="trailer">Trailer:</label>
              <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer" value="<?= $movie->trailer ?>">
            </div>
            <!-- Campo para a descrição do anime -->
            <div class="form-group">
              <label for="description">Descrição:</label>
              <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o anime..."><?= $movie->description ?></textarea>
            </div>
            <!-- Botão de envio do formulário para editar o anime -->
            <input type="submit" class="btn card-btn" value="Editar anime">
          </form>
        </div>
        <!-- Coluna para exibição da imagem do anime -->
        <div class="col-md-3">
          <div class="movie-image-container" style="background-image: url('<?= $BASE_URL ?>img/movies/<?= $movie->image ?>')"></div>
        </div>
      </div>
    </div>
  </div>

<?php
  // Inclui o rodapé do template
  require_once("templates/footer.php");
?>
