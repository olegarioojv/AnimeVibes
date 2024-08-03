<?php
  // Inclui arquivos de configuração e definição de modelos e DAOs
  require_once("globals.php"); // Arquivo de variáveis globais e constantes
  require_once("db.php"); // Arquivo de conexão com o banco de dados
  require_once("models/Movie.php"); // Modelo para a entidade Movie
  require_once("models/Review.php"); // Modelo para a entidade Review
  require_once("models/Message.php"); // Modelo para a entidade Message
  require_once("dao/UserDAO.php"); // DAO para operações de usuário
  require_once("dao/MovieDAO.php"); // DAO para operações de filmes
  require_once("dao/ReviewDAO.php"); // DAO para operações de resenhas

  // Cria instâncias dos objetos de mensagem, usuário, filme e resenha
  $message = new Message($BASE_URL); // Instância para manipular mensagens
  $userDao = new UserDAO($conn, $BASE_URL); // Instância para acessar dados do usuário
  $movieDao = new MovieDAO($conn, $BASE_URL); // Instância para acessar dados dos filmes
  $reviewDao = new ReviewDAO($conn, $BASE_URL); // Instância para acessar dados das resenhas

  // Recebe o tipo do formulário enviado via POST
  $type = filter_input(INPUT_POST, "type");

  // Resgata dados do usuário autenticado
  $userData = $userDao->verifyToken();

  // Verifica se o tipo do formulário é "create"
  if($type === "create") {

    // Recebe dados do formulário enviado via POST
    $rating = filter_input(INPUT_POST, "rating"); // Avaliação do filme
    $review = filter_input(INPUT_POST, "review"); // Comentário sobre o filme
    $movies_id = filter_input(INPUT_POST, "movies_id"); // ID do filme
    $users_id = $userData->id; // ID do usuário autenticado

    // Cria uma nova instância de Review
    $reviewObject = new Review();

    // Busca dados do filme com base no ID
    $movieData = $movieDao->findById($movies_id);

    // Verifica se o filme existe
    if($movieData) {

      // Valida se todos os campos necessários estão preenchidos
      if(!empty($rating) && !empty($review) && !empty($movies_id)) {

        // Preenche os dados da resenha
        $reviewObject->rating = $rating;
        $reviewObject->review = $review;
        $reviewObject->movies_id = $movies_id;
        $reviewObject->users_id = $users_id;

        // Cria a resenha no banco de dados
        $reviewDao->create($reviewObject);

      } else {

        // Define uma mensagem de erro se algum campo obrigatório estiver vazio
        $message->setMessage("Você precisa inserir a nota e o comentário!", "error", "back");

      }

    } else {

      // Define uma mensagem de erro se o filme não for encontrado
      $message->setMessage("Informações inválidas!", "error", "index.php");

    }

  } else {

    // Define uma mensagem de erro se o tipo do formulário não for "create"
    $message->setMessage("Informações inválidas!", "error", "index.php");

  }

