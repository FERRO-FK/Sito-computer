<?php
require '../php/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $citta = $_POST['citta'];
    $via = $_POST['via'];
    $numerocivico = $_POST['numerocivico'];

    // Hash password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Salva indirizzo
    $stmt = $pdo->prepare("INSERT INTO indirizzo (numerocivico, citta, via) VALUES (?, ?, ?)");
    $stmt->execute([$numerocivico, $citta, $via]);
    $id_indirizzo = $pdo->lastInsertId();

    // Salva utente
    $stmt = $pdo->prepare("INSERT INTO utente (nome, mail, pass, IDindirizzo) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $mail, $hash, $id_indirizzo]);

    header("Location: registrazione_successo.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tecno Shop - Registrazione</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_navbar.css">
  <link rel="stylesheet" href="../css/styles_registrazione.css">
</head>
<body>
  <div class="top-bar">
    <div class="logo" onclick="window.location.href='../html/index.php'">Tecno Shop</div>
    <div class="nav-links">
      <a href="../html/index.php"><i class="fas fa-home"></i> Home</a>
      <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.html"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="#"><i class="fas fa-envelope"></i> Contatti</a>
      <a href="../php/login.php"><i class="fas fa-user"></i> Login</a>
    </div>
  </div>

  <div class="registration-container">
    <div class="registration-card">
      <h2><i class="fas fa-user-plus"></i> Crea il tuo account</h2>
      
      <form method="post" class="registration-form">
        <div class="form-group">
          <label for="nome"><i class="fas fa-user"></i> Nome completo</label>
          <input type="text" id="nome" name="nome" placeholder="Mario Rossi" required>
        </div>
        
        <div class="form-group">
          <label for="mail"><i class="fas fa-envelope"></i> Email</label>
          <input type="email" id="mail" name="mail" placeholder="tu@email.com" required>
        </div>
        
        <div class="form-group">
          <label for="password"><i class="fas fa-lock"></i> Password</label>
          <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
        
        <div class="address-section">
          <h3><i class="fas fa-map-marker-alt"></i> Indirizzo</h3>
          
          <div class="form-group">
            <label for="via">Via</label>
            <input type="text" id="via" name="via" placeholder="Via Roma" required>
          </div>
          
          <div class="form-group">
            <label for="numerocivico">Numero Civico</label>
            <input type="text" id="numerocivico" name="numerocivico" placeholder="123" required>
          </div>
          
          <div class="form-group">
            <label for="citta">Città</label>
            <input type="text" id="citta" name="citta" placeholder="Milano" required>
          </div>
        </div>
        
        <button type="submit" class="register-btn">
          <i class="fas fa-user-plus"></i> Registrati
        </button>
      </form>
      
      <div class="login-link">
        Hai già un account? <a href="../php/login.php">Accedi qui</a>
      </div>
    </div>
  </div>
</body>
</html>