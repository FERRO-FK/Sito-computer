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

    echo "Registrazione completata!";
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
    <div class="logo" onclick="window.location.href='html/index.php'">Tecno Shop</div>
    <div class="nav-links">
      <a href="../html/index.php"><i class="fas fa-home"></i> Home</a>
      <a href="../html/prodotti.html"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.html"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="#"><i class="fas fa-envelope"></i> Contatti</a>
      <a href="../php/login.php"><i class="fas fa-user"></i> Login</a>
    </div>
  </div>


    </div>
  </div>
</body>
</html>ò
<h2>Registrazione</h2>
<form method="post">
    Nome: <input type="text" name="nome" required><br>
    Email: <input type="email" name="mail" required><br>
    Password: <input type="password" name="password" required><br>
    Città: <input type="text" name="citta" required><br>
    Via: <input type="text" name="via" required><br>
    Numero Civico: <input type="text" name="numerocivico" required><br>
    <input type="submit" value="Registrati">
</form>


<a href="../php/login.php">Clicca qui se sei già registrato</a>
