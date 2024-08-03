<?php

  // Define a classe Review para representar uma avaliação no sistema.
  class Review {

    // Propriedades da classe Review
    public $id;            // Identificador único da avaliação
    public $rating;        // Nota dada na avaliação
    public $review;        // Texto da avaliação
    public $users_id;      // ID do usuário que fez a avaliação
    public $movies_id;     // ID do filme avaliado

  }

  // Define a interface ReviewDAOInterface para operações relacionadas a avaliações
  interface ReviewDAOInterface {

    // Constrói um objeto Review a partir dos dados fornecidos
    public function buildReview($data);
    // Cria uma nova avaliação no sistema
    public function create(Review $review);
    // Obtém todas as avaliações para um filme específico
    public function getMoviesReview($id);
    // Verifica se o usuário já fez uma avaliação para um filme específico
    public function hasAlreadyReviewed($id, $userId);
    // Obtém as avaliações (notas) para um filme específico
    public function getRatings($id);

  }

