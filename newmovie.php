<?php
  // Inclui o arquivo do cabeçalho do template
  require_once("templates/header.php");

  // Inclui os arquivos necessários para verificar a autenticação do usuário
  require_once("models/User.php"); // Modelo para a entidade User
  require_once("dao/UserDAO.php"); // DAO para operações de usuário

  // Cria uma instância do modelo User e do DAO UserDAO
  $user = new User(); // Instância para manipular dados do usuário
  $userDao = new UserDao($conn, $BASE_URL); // Instância para acessar dados do usuário

  // Verifica se o usuário está autenticado
  $userData = $userDao->verifyToken(true);

?>
  <!-- Início do contêiner principal da página -->
  <div id="main-container" class="container-fluid">
    <!-- Contêiner para o formulário de adição de anime -->
    <div class="offset-md-4 col-md-4 new-movie-container">
      <!-- Título da página -->
      <h1 class="page-title">Adicionar Anime</h1>
      <!-- Descrição da página -->
      <p class="page-description">Adicione sua crítica e compartilhe com o mundo!</p>
      <!-- Formulário para adicionar um novo anime -->
      <form action="<?= $BASE_URL ?>movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data">
        <!-- Campo oculto para identificar o tipo de formulário -->
        <input type="hidden" name="type" value="create">
        <!-- Campo para o título do anime -->
        <div class="form-group">
          <label for="title">Título:</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu anime">
        </div>
        <!-- Campo para a imagem do anime -->
        <div class="form-group">
          <label for="image">Imagem:</label>
          <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <!-- Campo para a duração do anime -->
        <div class="form-group">
          <label for="length">Duração:</label>
          <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do anime">
        </div>
        <!-- Campo para a categoria do anime -->
        <div class="form-group">
          <label for="category">Categoria:</label>
          <select name="category" id="category" class="form-control">
            <option value="">Selecione</option>
            <option value="Ação">Ação</option>
            <option value="Aventura">Aventura</option>
            <option value="Drama">Drama</option>
            <option value="Mistério">Mistério</option>
            <option value="Romance">Romance</option>
            <option value="Ficção Científica">Ficção Científica</option>
            <option value="Terror">Terror</option>
          </select>
        </div>
        <!-- Campo para o link do trailer do anime -->
        <div class="form-group">
          <label for="trailer">Trailer:</label>
          <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer">
        </div>
        <!-- Campo para a descrição do anime -->
        <div class="form-group">
          <label for="description">Descrição:</label>
          <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o anime..."></textarea>
        </div>
        <!-- Botão de envio do formulário -->
        <input type="submit" class="btn card-btn" value="Adicionar anime">
      </form>
    </div>
  </div>
<?php
  // Inclui o arquivo do rodapé do template
  require_once("templates/footer.php");
?>
