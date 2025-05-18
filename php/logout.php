<?php
session_start();
require_once 'db.php'; // Connessione PDO


if (isset($_SESSION['utente_id']) && isset($_SESSION['carrello'])) {
    $idUtente = $_SESSION['utente_id'];
    $carrelloJSON = json_encode($_SESSION['carrello']);

    $stmt = $pdo->prepare("UPDATE utente SET carrello = ? WHERE ID = ?");
    $stmt->execute([$carrelloJSON, $idUtente]);
}


session_unset();
session_destroy();
header("Location: ../php/login.php");
exit;