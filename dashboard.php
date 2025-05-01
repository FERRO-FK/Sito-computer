<?php
session_start();
require 'db.php';

if (!isset($_SESSION['utente_id'])) {
    header("Location: login.php");
    exit;
}

$utente_id = $_SESSION['utente_id'];

$stmt = $pdo->prepare("SELECT utente.nome, mail, indirizzo.via, indirizzo.numerocivico, indirizzo.citta
                       FROM utente 
                       JOIN indirizzo ON utente.IDindirizzo = indirizzo.IDindirizzo
                       WHERE utente.id = ?");
$stmt->execute([$utente_id]);
$user = $stmt->fetch();

echo "<h2>Ciao, " . htmlspecialchars($user['nome']) . "!</h2>";
echo "<p>La tua email è: " . htmlspecialchars($user['mail']) . "</p>";
echo "<p>Indirizzo: " . htmlspecialchars($user['via']) . " " . htmlspecialchars($user['numerocivico']) . ", " . htmlspecialchars($user['citta']) . "</p>";
?>

<a href="logout.php">Logout</a> <a href="index.html">home</a> 
