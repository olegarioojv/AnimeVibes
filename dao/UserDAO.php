<?php

  // Inclui as classes necessárias
  require_once("models/User.php");
  require_once("models/Message.php");

  // Implementa a interface UserDAOInterface para gerenciar usuários
  class UserDAO implements UserDAOInterface {

    // Propriedades da classe UserDAO
    private $conn;      // Instância de PDO para conexão com o banco de dados
    private $url;       // URL base para redirecionamentos
    private $message;   // Instância da classe Message para gerenciar mensagens de sessão

    // Construtor da classe, inicializa a conexão, URL e a instância de Message
    public function __construct(PDO $conn, $url) {
      $this->conn = $conn;
      $this->url = $url;
      $this->message = new Message($url);
    }

    // Constrói um objeto User a partir dos dados fornecidos
    public function buildUser($data) {

      $user = new User();

      $user->id = $data["id"];
      $user->name = $data["name"];
      $user->lastname = $data["lastname"];
      $user->email = $data["email"];
      $user->password = $data["password"];
      $user->image = $data["image"];
      $user->bio = $data["bio"];
      $user->token = $data["token"];

      return $user;

    }

    // Cria um novo usuário no banco de dados
    public function create(User $user, $authUser = false) {

      $stmt = $this->conn->prepare("INSERT INTO users(
          name, lastname, email, password, token
        ) VALUES (
          :name, :lastname, :email, :password, :token
        )");

      $stmt->bindParam(":name", $user->name);
      $stmt->bindParam(":lastname", $user->lastname);
      $stmt->bindParam(":email", $user->email);
      $stmt->bindParam(":password", $user->password);
      $stmt->bindParam(":token", $user->token);

      $stmt->execute();

      // Autentica o usuário, se solicitado
      if($authUser) {
        $this->setTokenToSession($user->token);
      }

    }

    // Atualiza as informações de um usuário existente
    public function update(User $user, $redirect = true) {

      $stmt = $this->conn->prepare("UPDATE users SET
        name = :name,
        lastname = :lastname,
        email = :email,
        image = :image,
        bio = :bio,
        token = :token
        WHERE id = :id
      ");

      $stmt->bindParam(":name", $user->name);
      $stmt->bindParam(":lastname", $user->lastname);
      $stmt->bindParam(":email", $user->email);
      $stmt->bindParam(":image", $user->image);
      $stmt->bindParam(":bio", $user->bio);
      $stmt->bindParam(":token", $user->token);
      $stmt->bindParam(":id", $user->id);

      $stmt->execute();

      if($redirect) {
        // Redireciona para a página de perfil do usuário com uma mensagem de sucesso
        $this->message->setMessage("Dados atualizados com sucesso!", "success", "editprofile.php");
      }

    }

    // Verifica se o token da sessão é válido
    public function verifyToken($protected = false) {

      if(!empty($_SESSION["token"])) {

        // Pega o token da sessão
        $token = $_SESSION["token"];

        $user = $this->findByToken($token);

        if($user) {
          return $user;
        } else if($protected) {
          // Redireciona usuário não autenticado
          $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");
        }

      } else if($protected) {
        // Redireciona usuário não autenticado
        $this->message->setMessage("Faça a autenticação para acessar esta página!", "error", "index.php");
      }

    }

    // Salva o token na sessão e redireciona para a página de perfil do usuário
    public function setTokenToSession($token, $redirect = true) {

      // Salvar token na sessão
      $_SESSION["token"] = $token;

      if($redirect) {
        // Redireciona para a página de perfil do usuário com uma mensagem de boas-vindas
        $this->message->setMessage("Seja bem-vindo!", "success", "editprofile.php");
      }

    }

    // Autentica um usuário com base no e-mail e senha fornecidos
    public function authenticateUser($email, $password) {

      $user = $this->findByEmail($email);

      if($user) {
        // Verifica se a senha está correta
        if(password_verify($password, $user->password)) {
          // Gera um token, salva na sessão e atualiza o usuário
          $token = $user->generateToken();
          $this->setTokenToSession($token, false);
          $user->token = $token;
          $this->update($user, false);
          return true;
        } else {
          return false;
        }

      } else {
        return false;
      }

    }

    // Encontra um usuário pelo e-mail
    public function findByEmail($email) {

      if($email != "") {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
          $data = $stmt->fetch();
          $user = $this->buildUser($data);
          return $user;
        } else {
          return false;
        }

      } else {
        return false;
      }

    }

    // Encontra um usuário pelo ID
    public function findById($id) {

      if($id != "") {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
          $data = $stmt->fetch();
          $user = $this->buildUser($data);
          return $user;
        } else {
          return false;
        }

      } else {
        return false;
      }
    }

    // Encontra um usuário pelo token
    public function findByToken($token) {

      if($token != "") {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
        $stmt->bindParam(":token", $token);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
          $data = $stmt->fetch();
          $user = $this->buildUser($data);
          return $user;
        } else {
          return false;
        }

      } else {
        return false;
      }

    }

    // Remove o token da sessão e redireciona para a página inicial
    public function destroyToken() {
      $_SESSION["token"] = "";
      $this->message->setMessage("Você fez o logout com sucesso!", "success", "index.php");
    }

    // Altera a senha de um usuário
    public function changePassword(User $user) {

      $stmt = $this->conn->prepare("UPDATE users SET
        password = :password
        WHERE id = :id
      ");

      $stmt->bindParam(":password", $user->password);
      $stmt->bindParam(":id", $user->id);
      $stmt->execute();

      // Redireciona para a página de perfil do usuário com uma mensagem de sucesso
      $this->message->setMessage("Senha alterada com sucesso!", "success", "editprofile.php");

    }

  }

?>
