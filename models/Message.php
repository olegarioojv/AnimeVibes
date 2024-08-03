<?php

  // Define a classe Message para gerenciar mensagens de sessão e redirecionamentos
  class Message {

    // Propriedade privada para armazenar a URL base para redirecionamentos
    private $url;

    // Construtor da classe, que define a URL base para redirecionamentos
    public function __construct($url) {
      $this->url = $url;
    }

    // Define uma mensagem de sessão e redireciona para uma URL especificada
    public function setMessage($msg, $type, $redirect = "index.php") {

      // Armazena a mensagem e o tipo na sessão
      $_SESSION["msg"] = $msg;
      $_SESSION["type"] = $type;

      // Redireciona para a URL especificada ou para a página anterior
      if($redirect != "back") {
        header("Location: $this->url" . $redirect);
      } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
      }

    }

    // Obtém a mensagem armazenada na sessão
    public function getMessage() {

      // Verifica se há uma mensagem na sessão e a retorna
      if(!empty($_SESSION["msg"])) {
        return [
          "msg" => $_SESSION["msg"],
          "type" => $_SESSION["type"]
        ];
      } else {
        return false;
      }

    }

    // Limpa a mensagem armazenada na sessão
    public function clearMessage() {
      $_SESSION["msg"] = "";
      $_SESSION["type"] = "";
    }

  }

?>
