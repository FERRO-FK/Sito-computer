<?php
session_start();
require '../php/db.php';

if (!isset($_SESSION['utente_id'])) {
    header("Location: ../php/login.php");
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
</head>
<body>

  <div class="top-bar">
    <div class="logo" onclick="window.location.href='../html/index.php'">Tecno Shop</div>
    <div class="nav-links">
      <a href="../html/index.php"><i class="fas fa-home"></i> Home</a>
      <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.html"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="#"><i class="fas fa-envelope"></i> Contatti</a>
      <a href="../html/login.php"><i class="fas fa-user"></i> Login</a>
    </div>
  </div>

  <div class="profile-container">
    <div class="profile-box">
      <h2><i class="fas fa-user-circle"></i> Benvenuto, <?= htmlspecialchars($user['nome']) ?>!</h2>
      <p><strong>Email:</strong> <?= htmlspecialchars($user['mail']) ?></p>
      <p><strong>Indirizzo:</strong> <?= htmlspecialchars($user['via']) . " " . htmlspecialchars($user['numerocivico']) . ", " . htmlspecialchars($user['citta']) ?></p>
      <div class="profile-buttons">
        <a href="../php/logout.php" class="btn logout">Logout</a>
        <a href="../html/index.php" class="btn home">Torna alla Home</a>
      </div>
    </div>
  </div>

</body>
</html>
