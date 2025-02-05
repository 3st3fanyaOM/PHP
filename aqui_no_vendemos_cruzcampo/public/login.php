<?php include '../includes/header.php'; ?>
    <main>
      <div class="login-form">
        <h2>Login</h2>
        <form action="login_procesar.php" method="POST" class="login-form">
          <div class="form-group">
            <label for="mail">Correo electrónico</label>
            <input type="email" id="mail" name="mail" required />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required />
          </div>
          <button type="submit" class="btn">Login</button>
          <a class="enlace-registro" href="../public/registro_usuario.php"
            >¿No tienes cuenta? Pulsa aqui.</a
          >
        </form>
      </div>
    </main>
    <?php include '../includes/footer.php'; ?>
