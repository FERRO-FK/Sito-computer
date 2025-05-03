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
  <title>Tecno Shop - Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_navbar.css">
  <link rel="stylesheet" href="../css/styles_login.css">
</head>
<body>
  <div class="top-bar">
    <div class="logo" onclick="window.location.href='html/index.php'">Tecno Shop</div>
    <div class="nav-links">
      <a href="../html/index.php"><i class="fas fa-home"></i> Home</a>
      <a href="../html/prodotti.html"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.html"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="#"><i class="fas fa-envelope"></i> Contatti</a>
      <?php $loginText = "Login"; ?>
    <a href="../php/login.php"><i class="fas fa-user"></i> <?php echo $user['nome'] ; ?></a>
    </div>
  </div>


    </div>
  </div>
</body>
</html>

<?php




echo "<h2>Ciao, " . htmlspecialchars($user['nome']) . "!</h2>";
echo "<p>La tua email è: " . htmlspecialchars($user['mail']) . "</p>";
echo "<p>Indirizzo: " . htmlspecialchars($user['via']) . " " . htmlspecialchars($user['numerocivico']) . ", " . htmlspecialchars($user['citta']) . "</p>";
?>

<a href="../php/logout.php">Logout</a> <a href="../html/php.html">home</a> 
