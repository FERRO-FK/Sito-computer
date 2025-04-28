<?php
require 'connessionedb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];

    $stmt = $pdo->prepare("SELECT utente.nome, indirizzo.citta, indirizzo.via, indirizzo.numerocivico 
                           FROM utente 
                           JOIN indirizzo ON utente.id_indirizzo = indirizzo.id
                           WHERE utente.mail = ?");
    $stmt->execute([$mail]);
    $user = $stmt->fetch();

    if ($user) {
        echo "Benvenuto, " . htmlspecialchars($user['nome']) . "!<br>";
        echo "Abiti a " . htmlspecialchars($user['via']) . " " . htmlspecialchars($user['numerocivico']) . ", " . htmlspecialchars($user['citta']) . ".";
    } else {
        echo "Email non trovata!";
    }
}
?>

<form method="post">
    Email: <input type="email" name="mail" required><br>
    <input type="submit" value="Login">
</form>

<a href="registrazione.php">Clicca qui se non hai ancora un account</a>