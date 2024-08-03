<?php

  // Inclui arquivos globais, de conexão com o banco, modelos e DAO necessários
  require_once("globals.php");
  require_once("db.php");
  require_once("models/User.php");
  require_once("models/Message.php");
  require_once("dao/UserDAO.php");

  // Cria uma instância de Message para gerenciamento de mensagens
  $message = new Message($BASE_URL);

  // Cria uma instância de UserDAO para interagir com o banco de dados
  $userDao = new UserDAO($conn, $BASE_URL);

  // Resgata o tipo de formulário enviado (registro ou login)
  $type = filter_input(INPUT_POST, "type");

  // Verificação do tipo de formulário
  if($type === "register") {

    // Captura dados enviados pelo formulário de registro
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Verifica se todos os campos obrigatórios foram preenchidos
    if($name && $lastname && $email && $password) {

      // Verifica se as senhas coincidem
      if($password === $confirmpassword) {

        // Verifica se o e-mail já está registrado
        if($userDao->findByEmail($email) === false) {

          // Cria uma nova instância de User e configura os dados
          $user = new User();

          // Gera token e senha final
          $userToken = $user->generateToken();
          $finalPassword = $user->generatePassword($password);

          $user->name = $name;
          $user->lastname = $lastname;
          $user->email = $email;
          $user->password = $finalPassword;
          $user->token = $userToken;

          $auth = true;

          // Adiciona o novo usuário ao banco de dados
          $userDao->create($user, $auth);

        } else {
          // Envia uma mensagem de erro se o e-mail já estiver cadastrado
          $message->setMessage("Usuário já cadastrado, tente outro e-mail.", "error", "back");
        }

      } else {
        // Envia uma mensagem de erro se as senhas não coincidirem
        $message->setMessage("As senhas não são iguais.", "error", "back");
      }

    } else {
      // Envia uma mensagem de erro se algum campo obrigatório estiver vazio
      $message->setMessage("Por favor, preencha todos os campos.", "error", "back");
    }

  } else if($type === "login") {

    // Captura dados enviados pelo formulário de login
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    // Tenta autenticar o usuário
    if($userDao->authenticateUser($email, $password)) {
      // Envia uma mensagem de sucesso e redireciona para a página de edição de perfil
      $message->setMessage("Seja bem-vindo!", "success", "editprofile.php");

    } else {
      // Envia uma mensagem de erro se a autenticação falhar
      $message->setMessage("Usuário e/ou senha incorretos.", "error", "back");
    }

  } else {
    // Envia uma mensagem de erro para informações inválidas
    $message->setMessage("Informações inválidas!", "error", "index.php");
  }
?>
