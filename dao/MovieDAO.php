<?php

  // Inclui as classes necessárias
  require_once("models/Movie.php");
  require_once("models/Message.php");
  require_once("dao/ReviewDAO.php");

  // Implementa a interface MovieDAOInterface
  class MovieDAO implements MovieDAOInterface {

    // Propriedades da classe
    private $conn;      // Conexão com o banco de dados
    private $url;       // URL para redirecionamento de mensagens
    private $message;   // Objeto para lidar com mensagens

    // Construtor da classe
    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;         // Inicializa a conexão com o banco de dados
      $this->url = $url;           // Inicializa a URL
      $this->message = new Message($url);  // Cria uma nova instância da classe Message
    }

    // Constrói um objeto Movie a partir dos dados fornecidos
    public function buildMovie($data) {

      $movie = new Movie(); // Cria uma nova instância da classe Movie

      // Define as propriedades do objeto Movie com base nos dados fornecidos
      $movie->id = $data["id"];
      $movie->title = $data["title"];
      $movie->description = $data["description"];
      $movie->image = $data["image"];
      $movie->trailer = $data["trailer"];
      $movie->category = $data["category"];
      $movie->length = $data["length"];
      $movie->users_id = $data["users_id"];

      // Obtém as avaliações do filme usando a ReviewDao
      $reviewDao = new ReviewDao($this->conn, $this->url);
      $rating = $reviewDao->getRatings($movie->id);
      $movie->rating = $rating;  // Define a avaliação no objeto Movie

      return $movie;  // Retorna o objeto Movie construído

    }

    // Método para encontrar todos os filmes (não implementado)
    public function findAll() {
      // Implementar lógica para encontrar todos os filmes, se necessário
    }

    // Obtém os filmes mais recentes
    public function getLatestMovies() {

      $movies = []; // Array para armazenar os filmes

      // Executa uma consulta para obter todos os filmes, ordenados pelo ID em ordem decrescente
      $stmt = $this->conn->query("SELECT * FROM movies ORDER BY id DESC");
      $stmt->execute(); // Executa a consulta

      if($stmt->rowCount() > 0) { // Verifica se há resultados

        $moviesArray = $stmt->fetchAll(); // Obtém todos os resultados
        foreach($moviesArray as $movie) {
          $movies[] = $this->buildMovie($movie); // Adiciona o filme ao array, após construí-lo
        }

      }

      return $movies; // Retorna o array de filmes

    }

    // Obtém filmes por categoria
    public function getMoviesByCategory($category) {

      $movies = []; // Array para armazenar os filmes

      // Prepara e executa uma consulta para obter filmes pela categoria
      $stmt = $this->conn->prepare("SELECT * FROM movies WHERE category = :category ORDER BY id DESC");
      $stmt->bindParam(":category", $category); // Liga o parâmetro da consulta
      $stmt->execute(); // Executa a consulta

      if($stmt->rowCount() > 0) { // Verifica se há resultados

        $moviesArray = $stmt->fetchAll(); // Obtém todos os resultados
        foreach($moviesArray as $movie) {
          $movies[] = $this->buildMovie($movie); // Adiciona o filme ao array, após construí-lo
        }

      }

      return $movies; // Retorna o array de filmes

    }

    // Obtém filmes por ID de usuário
    public function getMoviesByUserId($id) {

      $movies = []; // Array para armazenar os filmes

      // Prepara e executa uma consulta para obter filmes pelo ID do usuário
      $stmt = $this->conn->prepare("SELECT * FROM movies WHERE users_id = :users_id");
      $stmt->bindParam(":users_id", $id); // Liga o parâmetro da consulta
      $stmt->execute(); // Executa a consulta

      if($stmt->rowCount() > 0) { // Verifica se há resultados

        $moviesArray = $stmt->fetchAll(); // Obtém todos os resultados
        foreach($moviesArray as $movie) {
          $movies[] = $this->buildMovie($movie); // Adiciona o filme ao array, após construí-lo
        }

      }

      return $movies; // Retorna o array de filmes

    }

    // Encontra um filme por ID
    public function findById($id) {

      $movie = []; // Array para armazenar o filme

      // Prepara e executa uma consulta para obter um filme pelo ID
      $stmt = $this->conn->prepare("SELECT * FROM movies WHERE id = :id");
      $stmt->bindParam(":id", $id); // Liga o parâmetro da consulta
      $stmt->execute(); // Executa a consulta

      if($stmt->rowCount() > 0) { // Verifica se há resultados

        $movieData = $stmt->fetch(); // Obtém o resultado
        $movie = $this->buildMovie($movieData); // Constrói o objeto Movie a partir dos dados

        return $movie; // Retorna o objeto Movie

      } else {

        return false; // Retorna false se o filme não for encontrado

      }

    }

    // Encontra filmes por título
    public function findByTitle($title) {

      $movies = []; // Array para armazenar os filmes

      // Prepara e executa uma consulta para obter filmes com um título semelhante
      $stmt = $this->conn->prepare("SELECT * FROM movies WHERE title LIKE :title");
      $stmt->bindValue(":title", '%'.$title.'%'); // Liga o parâmetro da consulta
      $stmt->execute(); // Executa a consulta

      if($stmt->rowCount() > 0) { // Verifica se há resultados

        $moviesArray = $stmt->fetchAll(); // Obtém todos os resultados
        foreach($moviesArray as $movie) {
          $movies[] = $this->buildMovie($movie); // Adiciona o filme ao array, após construí-lo
        }

      }

      return $movies; // Retorna o array de filmes

    }

    // Cria um novo filme
    public function create(Movie $movie) {

      // Prepara e executa uma consulta para inserir um novo filme
      $stmt = $this->conn->prepare("INSERT INTO movies (
        title, description, image, trailer, category, length, users_id
      ) VALUES (
        :title, :description, :image, :trailer, :category, :length, :users_id
      )");
      
      // Liga os parâmetros da consulta
      $stmt->bindParam(":title", $movie->title);
      $stmt->bindParam(":description", $movie->description);
      $stmt->bindParam(":image", $movie->image);
      $stmt->bindParam(":trailer", $movie->trailer);
      $stmt->bindParam(":category", $movie->category);
      $stmt->bindParam(":length", $movie->length);
      $stmt->bindParam(":users_id", $movie->users_id);

      $stmt->execute(); // Executa a consulta

      // Define uma mensagem de sucesso e redireciona para a página principal
      $this->message->setMessage("Anime adicionado com sucesso!", "success", "index.php");

    }

    // Atualiza um filme existente
    public function update(Movie $movie) {

      // Prepara e executa uma consulta para atualizar um filme
      $stmt = $this->conn->prepare("UPDATE movies SET
        title = :title,
        description = :description,
        image = :image,
        category = :category,
        trailer = :trailer,
        length = :length
        WHERE id = :id      
      ");
      
      // Liga os parâmetros da consulta
      $stmt->bindParam(":title", $movie->title);
      $stmt->bindParam(":description", $movie->description);
      $stmt->bindParam(":image", $movie->image);
      $stmt->bindParam(":category", $movie->category);
      $stmt->bindParam(":trailer", $movie->trailer);
      $stmt->bindParam(":length", $movie->length);
      $stmt->bindParam(":id", $movie->id);

      $stmt->execute(); // Executa a consulta

      // Define uma mensagem de sucesso e redireciona para o painel de controle
      $this->message->setMessage("Anime atualizado com sucesso!", "success", "dashboard.php");

    }

    // Remove um filme existente
    public function destroy($id) {

      // Prepara e executa uma consulta para remover um filme
      $stmt = $this->conn->prepare("DELETE FROM movies WHERE id = :id");
      $stmt->bindParam(":id", $id); // Liga o parâmetro da consulta
      $stmt->execute(); // Executa a consulta

      // Define uma mensagem de sucesso e redireciona para o painel de controle
      $this->message->setMessage("Anime removido com sucesso!", "success", "dashboard.php");

    }

  }
