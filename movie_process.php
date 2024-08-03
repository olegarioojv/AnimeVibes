<?php

  // Inclui arquivos necessários para configuração, conexão ao banco de dados e modelos
  require_once("globals.php");
  require_once("db.php");
  require_once("models/Movie.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");
  require_once("dao/MovieDAO.php");

  // Cria instâncias das classes Message, UserDAO e MovieDAO
  $message = new Message($BASE_URL);
  $userDao = new UserDAO($conn, $BASE_URL);
  $movieDao = new MovieDAO($conn, $BASE_URL);

  // Obtém o tipo do formulário enviado (criação, exclusão ou atualização)
  $type = filter_input(INPUT_POST, "type");

  // Obtém os dados do usuário autenticado
  $userData = $userDao->verifyToken();

  // Se o tipo do formulário é "create" (criação de um novo anime)
  if($type === "create") {

    // Recebe os dados dos campos do formulário
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");

    // Cria uma nova instância de Movie
    $movie = new Movie();

    // Validação mínima de dados
    if(!empty($title) && !empty($description) && !empty($category)) {

      // Atribui os dados ao objeto Movie
      $movie->title = $title;
      $movie->description = $description;
      $movie->trailer = $trailer;
      $movie->category = $category;
      $movie->length = $length;
      $movie->users_id = $userData->id;

      // Verifica se uma imagem foi enviada e faz o upload
      if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];

        // Verifica o tipo da imagem
        if(in_array($image["type"], $imageTypes)) {

          // Cria a imagem a partir do tipo correto
          if(in_array($image["type"], $jpgArray)) {
            $imageFile = imagecreatefromjpeg($image["tmp_name"]);
          } else {
            $imageFile = imagecreatefrompng($image["tmp_name"]);
          }

          // Gera um nome para a imagem e faz o upload
          $imageName = $movie->imageGenerateName();
          imagejpeg($imageFile, "./img/movies/" . $imageName, 100);
          $movie->image = $imageName;

        } else {
          // Mensagem de erro se o tipo da imagem for inválido
          $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
        }

      }

      // Cria o novo anime no banco de dados
      $movieDao->create($movie);

    } else {
      // Mensagem de erro se dados obrigatórios não forem fornecidos
      $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");
    }

  } else if($type === "delete") {

    // Recebe o ID do anime para exclusão
    $id = filter_input(INPUT_POST, "id");

    // Busca o anime pelo ID
    $movie = $movieDao->findById($id);

    // Verifica se o anime existe
    if($movie) {

      // Verifica se o anime pertence ao usuário autenticado
      if($movie->users_id === $userData->id) {
        // Remove o anime do banco de dados
        $movieDao->destroy($movie->id);
      } else {
        // Mensagem de erro se o anime não pertencer ao usuário
        $message->setMessage("Informações inválidas!", "error", "index.php");
      }

    } else {
      // Mensagem de erro se o anime não for encontrado
      $message->setMessage("Informações inválidas!", "error", "index.php");
    }

  } else if($type === "update") {

    // Recebe os dados dos campos do formulário para atualização
    $title = filter_input(INPUT_POST, "title");
    $description = filter_input(INPUT_POST, "description");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");
    $length = filter_input(INPUT_POST, "length");
    $id = filter_input(INPUT_POST, "id");

    // Busca o anime pelo ID
    $movieData = $movieDao->findById($id);

    // Verifica se o anime foi encontrado
    if($movieData) {

      // Verifica se o anime pertence ao usuário autenticado
      if($movieData->users_id === $userData->id) {

        // Validação mínima de dados
        if(!empty($title) && !empty($description) && !empty($category)) {

          // Atualiza os dados do anime
          $movieData->title = $title;
          $movieData->description = $description;
          $movieData->trailer = $trailer;
          $movieData->category = $category;
          $movieData->length = $length;

          // Verifica se uma nova imagem foi enviada e faz o upload
          if(isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {

            $image = $_FILES["image"];
            $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
            $jpgArray = ["image/jpeg", "image/jpg"];

            // Verifica o tipo da imagem
            if(in_array($image["type"], $imageTypes)) {

              // Cria a imagem a partir do tipo correto
              if(in_array($image["type"], $jpgArray)) {
                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
              } else {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
              }

              // Gera um nome para a imagem e faz o upload
              $movie = new Movie();
              $imageName = $movie->imageGenerateName();
              imagejpeg($imageFile, "./img/movies/" . $imageName, 100);
              $movieData->image = $imageName;

            } else {
              // Mensagem de erro se o tipo da imagem for inválido
              $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
            }

          }

          // Atualiza o anime no banco de dados
          $movieDao->update($movieData);

        } else {
          // Mensagem de erro se dados obrigatórios não forem fornecidos
          $message->setMessage("Você precisa adicionar pelo menos: título, descrição e categoria!", "error", "back");
        }

      } else {
        // Mensagem de erro se o anime não pertencer ao usuário
        $message->setMessage("Informações inválidas!", "error", "index.php");
      }

    } else {
      // Mensagem de erro se o anime não for encontrado
      $message->setMessage("Informações inválidas!", "error", "index.php");
    }

  } else {
    // Mensagem de erro se o tipo do formulário for inválido
    $message->setMessage("Informações inválidas!", "error", "index.php");
  }
