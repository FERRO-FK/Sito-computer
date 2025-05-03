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
  <link rel="stylesheet" href="../css/styles_footer.css">
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
    </div>
  </div>
  <!--FOOTER-->
  <footer class="footer">
        <div class="footer-content">
          <div class="contact-info">
            <p><i class="fas fa-envelope"></i> Email: info@tecnoshop.com</p>
            <p><i class="fas fa-phone"></i> Telefono: +39 0123 456789</p>
            <p><i class="fas fa-map-marker-alt"></i> Indirizzo: Via Esempio 123, Milano, Italia</p>
          </div>
          <div class="social-icons">
            <a href="" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </footer>
</body>
</html>
<a href="../php/registrazione.php">Clicca qui per registrarti</a>

<?php
session_start();
require '../php/db.php';

if (isset($_SESSION['utente_id'])) {
    header("Location: ../dashboard.php");
    exit;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];
    $password = $_POST['pass'];

    $stmt = $pdo->prepare("SELECT * FROM utente WHERE mail = ?");
    $stmt->execute([$mail]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['pass'])) {
        $_SESSION['utente_id'] = $user['ID'];
        $_SESSION['nome'] = $user['Nome'];

        header("Location: ../dashboard.php");
        
    } else {
        echo "Email o password errati.";
    }
}
?>

<h2>Login</h2>
<form method="post">
    Email: <input type="email" name="mail" required><br>
    Password: <input type="password" name="pass" required><br>
    <input type="submit" value="Accedi">
</form>
