<?php

  // Define a classe User para representar um usuário no sistema.
  class User {

    // Propriedades da classe User
    public $id;          // Identificador único do usuário
    public $name;        // Nome do usuário
    public $lastname;    // Sobrenome do usuário
    public $email;       // Endereço de e-mail do usuário
    public $password;    // Senha do usuário
    public $image;       // Imagem do usuário
    public $bio;         // Biografia do usuário
    public $token;       // Token de autenticação do usuário

    // Retorna o nome completo do usuário concatenando nome e sobrenome
    public function getFullName($user) {
      return $user->name . " " . $user->lastname;
    }

    // Gera um token aleatório usando bytes criptograficamente seguros
    public function generateToken() {
      return bin2hex(random_bytes(50));
    }
    
    // Gera um hash da senha fornecida para armazenamento seguro
    public function generatePassword($password) {
      return password_hash($password, PASSWORD_DEFAULT);
    }

    // Gera um nome aleatório para a imagem do usuário com extensão .jpg
    public function imageGenerateName() {
      return bin2hex(random_bytes(60)) . ".jpg";
    }

  }

  // Define a interface UserDAOInterface para operações relacionadas a usuários
  interface UserDAOInterface {

    // Constrói um objeto User a partir dos dados fornecidos
    public function buildUser($data);
    // Cria um novo usuário no sistema
    public function create(User $user, $authUser = false);
    // Atualiza as informações de um usuário existente
    public function update(User $user, $redirect = true);
    // Verifica a validade de um token
    public function verifyToken($protected = false);
    // Define o token na sessão do usuário
    public function setTokenToSession($token, $redirect = true);
    // Autentica um usuário com base no e-mail e senha fornecidos
    public function authenticateUser($email, $password);
    // Encontra um usuário pelo e-mail
    public function findByEmail($email);
    // Encontra um usuário pelo ID
    public function findById($id);
    // Encontra um usuário pelo token
    public function findByToken($token);
    // Destrói o token atual
    public function destroyToken();
    // Altera a senha de um usuário
    public function changePassword(User $user);

  }

?>
