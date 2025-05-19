<?php
session_start();
require '../php/db.php';

if (isset($_SESSION['utente_id'])) {
    header("Location: ../php/dashboard.php");
    exit;
}

$errore = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $citta = $_POST['citta'];
    $via = $_POST['via'];
    $numerocivico = $_POST['numerocivico'];

    // Controllo se la mail è già registrata
    $stmt = $pdo->prepare("SELECT * FROM utente WHERE mail = ?");
    $stmt->execute([$mail]);
    if ($stmt->fetch()) {
        // Email già registrata
        $errore = "Email già registrata. Per favore, usa un'altra email.";
    } else {
        // Hash password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO utente (nome, mail, pass) VALUES (?, ?, ?)");
        $stmt->execute([$nome, $mail, $hash ]);
        $id_utente = $pdo->lastInsertId();

        // Salva indirizzo
        $stmt = $pdo->prepare("INSERT INTO indirizzo (numerocivico, citta, via, idutente) VALUES (?, ?, ?, ?)");
        $stmt->execute([$numerocivico, $citta, $via , $id_utente]);
       

        // Recupera utente per sessione
        $stmt = $pdo->prepare("SELECT * FROM utente WHERE mail = ?");
        $stmt->execute([$mail]);
        $user = $stmt->fetch();
        $_SESSION['utente_id'] = $user['ID'];
        $_SESSION['nome'] = $user['Nome'];
        
        if ($_SESSION['nome'] == "admin") {
            $_SESSION['admin'] = true;
            header("Location: ../php/admin.php");
        } else {
            header("Location: ../php/dashboard.php");
        }
        exit();
    }
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
  <link rel="icon" type="image/png" href="../immagini/favicon.png">
</head>
<body>
  <div class="top-bar">
    <div class="logo" onclick="window.location.href='../html/index.php'">Tecno Shop</div>
    <div class="nav-links">
      <a href="../php/index.php"><i class="fas fa-home"></i> Home</a>
      <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../php/carrello.php"><i class="fas fa-shopping-cart"></i> Carrello</a>
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
         <?php if (!empty($errore)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($errore); ?></p>
      <?php endif; ?>
      <div class="login-link">
        Hai già un account? <a href="../php/login.php">Accedi qui</a>
      </div>
    </div>
  </div>
</body>
</html>