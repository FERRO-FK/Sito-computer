<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];
    $password = $_POST['pass'];

    $stmt = $pdo->prepare("SELECT * FROM utente WHERE mail = ?");
    $stmt->execute([$mail]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['pass'])) {
        $_SESSION['utente_id'] = $user['ID'];
        $_SESSION['nome'] = $user['Nome'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Email o password errati.";
    }
}
?>

<h2>Login</h2>
<form method="post">
    Email: <input type="email" name="mail" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Accedi">
</form>
