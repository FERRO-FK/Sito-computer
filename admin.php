<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    die("Accesso negato.");
}

// Gestione ban/sban
if (isset($_GET['ban']) && isset($_GET['id'])) {
    $ban = ($_GET['ban'] === '1') ? 1 : 0;
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("UPDATE utente SET bannato = ? WHERE id = ?");
    $stmt->execute([$ban, $id]);
    header("Location: admin.php");
    exit;
}

// Lista utenti
$utenti = $pdo->query("SELECT * FROM utente")->fetchAll();


?>

<h2>Gestione Utenti</h2>
<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Nome</th><th>Email</th><th>Bannato</th><th>Azioni</th></tr>
    <?php foreach ($utenti as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['nome']) ?></td>
            <td><?= htmlspecialchars($u['mail']) ?></td>
            <td><?= $u['bannato'] ? 'Sì' : 'No' ?></td>
            <td>
                <?php if ($u['bannato']): ?>
                    <a href="admin.php?ban=0&id=<?= $u['id'] ?>">Sblocca</a>
                <?php else: ?>
                    <a href="admin.php?ban=1&id=<?= $u['id'] ?>">Banna</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>


