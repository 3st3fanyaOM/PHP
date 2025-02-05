<?php include '../includes/header.php'; ?>
    <h1>Registro de Usuario</h1>
    <main>
      <div class="register-form">
        <h2>Formulario de Registro</h2>
        <form action="guardar_usuario.php" method="POST">
          <!-- Campo de Correo -->
          <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input
              type="email"
              id="email"
              name="email"
              value="<?php echo htmlspecialchars($email); ?>"
              required
              placeholder="Ingresa tu correo electrónico"
            />
            <?php if ($email_error): ?>
            <div class="error"><?php echo $email_error; ?></div>
            <?php endif; ?>
          </div>

          <!-- Campo de Contraseña -->
          <div class="form-group">
            <label for="password">Contraseña</label>
            <input
              type="password"
              id="password"
              name="password"
              value="<?php echo htmlspecialchars($password); ?>"
              required
              placeholder="Crea una contraseña"
            />
            <?php if ($password_error): ?>
            <div class="error"><?php echo $password_error; ?></div>
            <?php endif; ?>
          </div>

          <!-- Campo de Edad -->
          <div class="form-group">
            <label for="age">Edad</label>
            <input
              type="number"
              id="age"
              name="age"
              value="<?php echo htmlspecialchars($age); ?>"
              required
              placeholder="Ingresa tu edad"
              min="18"
            />
            <?php if ($age_error): ?>
            <div class="error"><?php echo $age_error; ?></div>
            <?php endif; ?>
          </div>

          <!-- Botón de Enviar -->
          <button type="submit" class="btn">Registrar</button>
        </form>
      </div>
    </main>
    <?php include '../includes/footer.php'; ?>
