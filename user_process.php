<?php

// Inclui arquivos necessários para o funcionamento do script
require_once("globals.php"); // Inclui variáveis globais e configurações
require_once("db.php"); // Inclui o arquivo de conexão com o banco de dados
require_once("models/User.php"); // Inclui o modelo de usuário
require_once("models/Message.php"); // Inclui o modelo de mensagens
require_once("dao/UserDAO.php"); // Inclui o DAO (Data Access Object) para operações de usuário

// Cria instâncias dos objetos Message e UserDAO
$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

// Resgata o tipo do formulário enviado via POST
$type = filter_input(INPUT_POST, "type");

// Verifica se o tipo do formulário é "update" (atualização de usuário)
if ($type === "update") {

    // Resgata os dados do usuário com base no token
    $userData = $userDao->verifyToken();

    // Recebe os dados enviados pelo formulário
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    // Cria um novo objeto de usuário
    $user = new User();

    // Atualiza os dados do usuário
    $userData->name = $name;
    $userData->lastname = $lastname;
    $userData->email = $email;
    $userData->bio = $bio;

    // Verifica se uma imagem foi enviada
    if (isset($_FILES["image"]) && !empty($_FILES["image"]["tmp_name"])) {
        
        $image = $_FILES["image"];
        $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
        $jpgArray = ["image/jpeg", "image/jpg"];

        // Verifica se o tipo de imagem é permitido
        if (in_array($image["type"], $imageTypes)) {

            // Inicializa a variável para armazenar o recurso da imagem
            $imageFile = null;

            // Verifica se a imagem é do tipo JPG
            if (in_array($image["type"], $jpgArray)) {
                $imageFile = imagecreatefromjpeg($image["tmp_name"]);
            } 
            // Caso contrário, é PNG
            else {
                $imageFile = imagecreatefrompng($image["tmp_name"]);
            }

            // Se a imagem foi carregada corretamente
            if ($imageFile) {
                // Gera o nome da imagem
                $imageName = $user->imageGenerateName();

                // Define o caminho para salvar a imagem
                $imagePath = "./img/users/" . $imageName;

                // Salva a imagem no caminho especificado
                imagejpeg($imageFile, $imagePath, 100);

                // Limpa a memória utilizada pela imagem
                imagedestroy($imageFile);

                // Atualiza o dado da imagem no objeto $userData
                $userData->image = $imageName;

            } else {
                // Se houve erro ao criar o recurso de imagem, define uma mensagem de erro
                $message->setMessage("Erro ao criar recurso de imagem!", "error", "back");
            }

        } else {
            // Se o tipo de imagem não é permitido, define uma mensagem de erro
            $message->setMessage("Tipo inválido de imagem, insira png ou jpg!", "error", "back");
        }

    }

    // Atualiza os dados do usuário no banco de dados
    $userDao->update($userData);

} else if ($type === "changepassword") {

    // Recebe os dados enviados pelo formulário para mudança de senha
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");

    // Resgata os dados do usuário com base no token
    $userData = $userDao->verifyToken();

    $id = $userData->id;

    // Verifica se as senhas coincidem
    if ($password === $confirmpassword) {

        // Cria um novo objeto de usuário
        $user = new User();

        // Gera a senha criptografada
        $finalPassword = $user->generatePassword($password);

        // Define a nova senha e o ID do usuário
        $user->password = $finalPassword;
        $user->id = $id;

        // Atualiza a senha no banco de dados
        $userDao->changePassword($user);

    } else {
        // Se as senhas não coincidem, define uma mensagem de erro
        $message->setMessage("As senhas não são iguais!", "error", "back");
    }

} else {
    // Se o tipo do formulário é inválido, define uma mensagem de erro
    $message->setMessage("Informações inválidas!", "error", "index.php");
}
