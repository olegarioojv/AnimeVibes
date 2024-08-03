<?php

  // Inclui as classes necessárias
  require_once("models/Review.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  // Implementa a interface ReviewDAOInterface para gerenciar críticas de filmes
  class ReviewDao implements ReviewDAOInterface {

    // Propriedades da classe ReviewDao
    private $conn;      // Instância de PDO para conexão com o banco de dados
    private $url;       // URL base para redirecionamentos
    private $message;   // Instância da classe Message para gerenciar mensagens de sessão

    // Construtor da classe, inicializa a conexão, URL e a instância de Message
    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    // Constrói um objeto Review a partir dos dados fornecidos
    public function buildReview($data) {

      $reviewObject = new Review();

      $reviewObject->id = $data["id"];
      $reviewObject->rating = $data["rating"];
      $reviewObject->review = $data["review"];
      $reviewObject->users_id = $data["users_id"];
      $reviewObject->movies_id = $data["movies_id"];

      return $reviewObject;

    }

    // Adiciona uma nova crítica ao banco de dados
    public function create(Review $review) {

      $stmt = $this->conn->prepare("INSERT INTO reviews (
        rating, review, movies_id, users_id
      ) VALUES (
        :rating, :review, :movies_id, :users_id
      )");

      $stmt->bindParam(":rating", $review->rating);
      $stmt->bindParam(":review", $review->review);
      $stmt->bindParam(":movies_id", $review->movies_id);
      $stmt->bindParam(":users_id", $review->users_id);

      $stmt->execute();

      // Mensagem de sucesso por adicionar crítica
      $this->message->setMessage("Crítica adicionada com sucesso!", "success", "index.php");

    }

    // Obtém todas as críticas de um filme específico
    public function getMoviesReview($id) {

      $reviews = [];

      $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movies_id = :movies_id");

      $stmt->bindParam(":movies_id", $id);

      $stmt->execute();

      if($stmt->rowCount() > 0) {

        $reviewsData = $stmt->fetchAll();

        // Cria uma instância de UserDAO para buscar informações do usuário
        $userDao = new UserDao($this->conn, $this->url);

        foreach($reviewsData as $review) {

          $reviewObject = $this->buildReview($review);

          // Busca os dados do usuário que fez a crítica
          $user = $userDao->findById($reviewObject->users_id);

          $reviewObject->user = $user;

          $reviews[] = $reviewObject;
        }

      }

      return $reviews;

    }

    // Verifica se um usuário já avaliou um filme
    public function hasAlreadyReviewed($id, $userId) {

      $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movies_id = :movies_id AND users_id = :users_id");

      $stmt->bindParam(":movies_id", $id);
      $stmt->bindParam(":users_id", $userId);

      $stmt->execute();

      if($stmt->rowCount() > 0) {
        return true;
      } else {
        return false;
      }

    }

    // Calcula a média das avaliações de um filme
    public function getRatings($id) {

      $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movies_id = :movies_id");

      $stmt->bindParam(":movies_id", $id);

      $stmt->execute();

      if($stmt->rowCount() > 0) {

        $rating = 0;

        $reviews = $stmt->fetchAll();

        foreach($reviews as $review) {
          $rating += $review["rating"];
        }

        // Calcula a média das avaliações
        $rating = $rating / count($reviews);

      } else {

        $rating = "Não avaliado";

      }

      return $rating;

    }

  }

?>
