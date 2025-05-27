<?php

  // Define a classe Movie para representar um filme no sistema.
  class Movie {

    // Propriedades da classe Movie
    public $id;           // Identificador único do filme
    public $title;        // Título do filme
    public $description;  // Descrição do filme
    public $image;        // Imagem do filme
    public $trailer;      // Link do trailer do filme
    public $category;     // Categoria do filme
    public $length;       // Duração do filme
    public $users_id;     // ID do usuário associado ao filme (se aplicável)

    public $rating;

    public $user;
    

    // Gera um nome aleatório para a imagem do filme com extensão .jpg
    public function imageGenerateName() {
      return bin2hex(random_bytes(60)) . ".jpg";
    }

  }

  // Define a interface MovieDAOInterface para operações relacionadas a filmes
  interface MovieDAOInterface {

    // Constrói um objeto Movie a partir dos dados fornecidos
    public function buildMovie($data);
    // Obtém todos os filmes no sistema
    public function findAll();
    // Obtém os filmes mais recentes
    public function getLatestMovies();
    // Obtém filmes filtrados por categoria
    public function getMoviesByCategory($category);
    // Obtém filmes associados a um ID de usuário específico
    public function getMoviesByUserId($id);
    // Encontra um filme pelo seu ID
    public function findById($id);
    // Encontra um filme pelo seu título
    public function findByTitle($title);
    // Cria um novo filme no sistema
    public function create(Movie $movie);
    // Atualiza as informações de um filme existente
    public function update(Movie $movie);
    // Remove um filme do sistema pelo ID
    public function destroy($id);

  }

?>
