<?php
  // Inclui o cabeçalho do template
  require_once("templates/header.php");
?>
  <!-- Início do container principal da página -->
  <div id="main-container" class="container-fluid">
    <div class="col-md-12">
      <div class="row" id="auth-row">
        <!-- Seção de Login -->
        <div class="col-md-4" id="login-container">
          <h2>Entrar</h2>
          <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="login"> <!-- Especifica o tipo de operação (login) -->
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
            </div>
            <div class="form-group">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha">
            </div>
            <input type="submit" class="btn card-btn" value="Entrar"> <!-- Botão de login -->
          </form>
        </div>
        <!-- Seção de Registro -->
        <div class="col-md-4" id="register-container">
          <h2>Criar Conta</h2>
          <form action="<?= $BASE_URL ?>auth_process.php" method="POST">
            <input type="hidden" name="type" value="register"> <!-- Especifica o tipo de operação (registro) -->
            <div class="form-group">
              <label for="email">E-mail:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
            </div>
            <div class="form-group">
              <label for="name">Nome:</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome">
            </div>
            <div class="form-group">
              <label for="lastname">Sobrenome:</label>
              <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite seu sobrenome">
            </div>
            <div class="form-group">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha">
            </div>
            <div class="form-group">
              <label for="confirmpassword">Confirmação de senha:</label>
              <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirme sua senha">
            </div>
            <input type="submit" class="btn card-btn" value="Registrar"> <!-- Botão de registro -->
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
  // Inclui o rodapé do template
  require_once("templates/footer.php");
?>
