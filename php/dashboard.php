<?php
session_start();
require '../php/db.php';

if (!isset($_SESSION['utente_id'])) {
    header("Location: ../php/login.php");
    exit;
}
if (isset($_SESSION['admin'])) {
    header("Location: ../php/admin.php");
    exit;
}

$utente_id = $_SESSION['utente_id'];

$stmt = $pdo->prepare("SELECT utente.nome, mail, indirizzo.via, indirizzo.numerocivico, indirizzo.citta
                       FROM utente 
                       JOIN indirizzo ON utente.IDindirizzo = indirizzo.IDindirizzo
                       WHERE utente.id = ?");
$stmt->execute([$utente_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profilo Utente - Tecno Shop</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_navbar.css">
  <link rel="stylesheet" href="../css/styles_dashboard.css">
  <link rel="stylesheet" href="../css/styles_footer.css">
  <link rel="icon" type="image/png" href="../immagini/favicon.png">

</head>
<body>

  <div class="top-bar">
    <div class="logo" onclick="window.location.href='../php/index.php'">Tecno Shop</div>
    <div class="nav-links">
      <a href="../php/index.php"><i class="fas fa-home"></i> Home</a>
      <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../php/carrello.php"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <?php
    // Assicurati che sia chiamato SOLO una volta per pagina
    if (isset($_SESSION['nome'])) {
        // Utente loggato
        echo '<a href="../php/dashboard.php"><i class="fas fa-user"></i> ' . htmlspecialchars($_SESSION['nome']) . '</a>';
    } else {
        // Utente non loggato
        echo '<a href="../php/login.php"><i class="fas fa-user"></i> Login</a>';
    }
    ?>
    </div>
  </div>

  <div class="profile-container">
    <div class="profile-box">
      <h2><i class="fas fa-user-circle"></i> Benvenuto, <?= htmlspecialchars($user['nome']) ?>!</h2>
      <p><strong>Email:</strong> <?= htmlspecialchars($user['mail']) ?></p>
      <p><strong>Indirizzo:</strong> <?= htmlspecialchars($user['via']) . " " . htmlspecialchars($user['numerocivico']) . ", " . htmlspecialchars($user['citta']) ?></p>
      <div class="profile-buttons">
        <a href="../php/logout.php" class="btn logout">Logout</a>
        <a href="../php/index.php" class="btn home">Torna alla Home</a>
      </div>
    </div>
  </div>

  
      <!--FOOTER-->
      <div class="footer-divider"></div>
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
