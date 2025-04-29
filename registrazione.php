<?php
require 'connessionedb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $mail = $_POST['mail'];
    $citta = $_POST['citta'];
    $via = $_POST['via'];
    $numerocivico = $_POST['numerocivico'];

    // Inseriamo l'indirizzo
    $stmt = $pdo->prepare("INSERT INTO indirizzo (numerocivico, citta, via) VALUES (?, ?, ?)");
    $stmt->execute([$numerocivico, $citta, $via]);
    $id_indirizzo = $pdo->lastInsertId();

    // Inseriamo l'utente
    $stmt = $pdo->prepare("INSERT INTO utente (nome, mail, IDIndirizzoc:\Users\Tansi.ene\Desktop\sql.sql) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $mail, $id_indirizzo]);

    echo "Registrazione avvenuta con successo!";
}
?>

<form method="post">
    Nome: <input type="text" name="nome" required><br>
    Email: <input type="email" name="mail" required><br>
    Città: <input type="text" name="citta" required><br>
    Via: <input type="text" name="via" required><br>
    Numero Civico: <input type="text" name="numerocivico" required><br>
    <input type="submit" value="Registrati">
</form>

<a href="login.php">Clicca qui se sei già registrato</a>
