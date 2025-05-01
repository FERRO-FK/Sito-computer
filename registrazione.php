<?php
require 'db.php';

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


<a href="login.html">Clicca qui se sei già registrato</a>
