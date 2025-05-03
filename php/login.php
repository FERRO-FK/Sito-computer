<?php
session_start();
require '../php/db.php';

if (isset($_SESSION['utente_id'])) {
    header("Location: ../php/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tecno Shop - Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_navbar.css">
  <link rel="stylesheet" href="../css/styles_login.css">
</head>
<body>
  <div class="top-bar">
    <div class="logo" onclick="window.location.href='html/index.html'">Tecno Shop</div>
    <div class="nav-links">
      <a href="../html/index.html"><i class="fas fa-home"></i> Home</a>
      <a href="../html/prodotti.html"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.html"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="#"><i class="fas fa-envelope"></i> Contatti</a>
      <a href="../php/login.php"><i class="fas fa-user"></i> Login</a>
    </div>
  </div>

  <div class="login-container">
    <div class="login-box">      
      <h2><p><i class="fas fa-circle-user"></i></p>Accedi al tuo account</h2>
      <form action="../php/login.php" method="POST">
        <div class="form-group">
          <label for="mail">Email</label>
          <input type="email" id="mail" name="mail" required placeholder="Inserisci la tua email">
        </div>
        <div class="form-group">
          <label for="password">password</label>
          <input type="password" id="pass" name="pass" required placeholder="Inserisci password">
        </div>
        <button type="submit" class="login-button">Login</button>
        
      </form>
      <a href="../php/registrazione.php">
      
   <button class="login-button" >Clicca qui se non sei ancora registrato</button>
    </a>
    </div>
  </div>
</body>
</html>




<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];
    $password = $_POST['pass'];

    $stmt = $pdo->prepare("SELECT * FROM utente WHERE mail = ?");
    $stmt->execute([$mail]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['pass'])) {
        $_SESSION['utente_id'] = $user['ID'];
        $_SESSION['nome'] = $user['Nome'];

        header("Location: ../php/dashboard.php");
        
    } else {
        echo "Email o password errati.";
    }
}
?>


