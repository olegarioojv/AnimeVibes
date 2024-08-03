<?php
  // Inclui o cabeçalho do template
  require_once("templates/header.php");

  // Inclui os modelos e DAOs necessários para manipulação de usuários
  require_once("models/User.php");
  require_once("dao/UserDAO.php");

  // Cria instâncias das classes User e UserDAO
  $user = new User();
  $userDao = new UserDAO($conn, $BASE_URL);

  // Verifica o token do usuário e obtém seus dados
  $userData = $userDao->verifyToken(true);

  // Obtém o nome completo do usuário
  $fullName = $user->getFullName($userData);

  // Define uma imagem padrão se o usuário não tiver uma imagem configurada
  if ($userData->image == "") {
    $userData->image = "user.png";
  }
?>
  <!-- Início do container principal da página de edição de perfil -->
  <div id="main-container" class="container-fluid edit-profile-page">
    <div class="col-md-12">
      <!-- Formulário para atualização dos dados do usuário -->
      <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="type" value="update"> <!-- Especifica o tipo de operação (atualização) -->
        <div class="row">
          <div class="col-md-4">
            <h1><?= $fullName ?></h1> <!-- Exibe o nome completo do usuário -->
            <p class="page-description">Altere seus dados no formulário abaixo:</p>
            <!-- Campo para o nome do usuário -->
            <div class="form-group">
              <label for="name">Nome:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Digite o seu nome" value="<?= $userData->name ?>">
            </div>
            <!-- Campo para o sobrenome do usuário -->
            <div class="form-group">
              <label for="lastname">Sobrenome:</label>
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite o seu sobrenome" value="<?= $userData->lastname ?>">
            </div>
            <!-- Campo para o e-mail do usuário (somente leitura) -->
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="text" readonly class="form-control disabled" id="email" name="email" placeholder="Digite o seu e-mail" value="<?= $userData->email ?>">
            </div>
            <!-- Botão de envio do formulário para atualizar os dados -->
            <input type="submit" class="btn card-btn" value="Alterar">
          </div>
          <div class="col-md-4">
            <!-- Exibição da imagem de perfil do usuário -->
            <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->image ?>')"></div>
            <!-- Campo para upload de nova foto de perfil -->
            <div class="form-group">
              <label for="image">Foto:</label>
              <input type="file" class="form-control-file" name="image">
            </div>
            <!-- Campo para a biografia do usuário -->
            <div class="form-group">
              <label for="bio">Sobre você:</label>
              <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Conte quem você é, o que faz e onde trabalha..."><?= $userData->bio ?></textarea>
            </div>
          </div>
        </div>
      </form>
      <!-- Seção para alteração da senha -->
      <div class="row" id="change-password-container">
        <div class="col-md-4">
          <h2>Alterar a senha:</h2>
          <p class="page-description">Digite a nova senha e confirme, para alterar sua senha:</p>
          <!-- Formulário para alteração de senha -->
          <form action="<?= $BASE_URL ?>user_process.php" method="POST">
            <input type="hidden" name="type" value="changepassword"> <!-- Especifica o tipo de operação (alteração de senha) -->
            <div class="form-group">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Digite a sua nova senha">
            </div>
            <div class="form-group">
              <label for="confirmpassword">Confirmação de senha:</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme a sua nova senha">
            </div>
            <!-- Botão de envio do formulário para alterar a senha -->
            <input type="submit" class="btn card-btn" value="Alterar Senha">
          </form>
        </div>
      </div>
    </div>
  </div>

<?php
  // Inclui o rodapé do template
  require_once("templates/footer.php");
?>
