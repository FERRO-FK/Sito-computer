<?php
session_start();
require '../php/db.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    die("Accesso negato.");
}


// Lista utenti
$utenti = $pdo->query("SELECT * FROM utente")->fetchAll();


?>

<h2>Gestione Utenti</h2>
<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Nome</th><th>Email</th></tr>
    <?php foreach ($utenti as $u): ?>
        <tr>
            <td><?= $u['ID'] ?></td>
            <td><?= htmlspecialchars($u['Nome']) ?></td>
            <td><?= htmlspecialchars($u['mail']) ?></td>
    
        </tr>
    <?php endforeach; ?>
</table>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        #preview {
            margin-top: 20px;
            max-width: 300px;
            max-height: 300px;
        }
    </style>
<?php


$messaggio = "";

// Se il form è stato inviato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descrizione = $_POST['descrizione'];
    $prezzo = $_POST['prezzo'];
    $idtag = $_POST['idtag'];

    $uploadOk = true;
    $targetDir = __DIR__ . '/../immagini/';
    $filename = basename($_FILES["immagine"]["name"]);
    $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (!in_array($imageFileType, $allowed)) {
        $messaggio = "Formato immagine non valido.";
        $uploadOk = false;
    }

    if ($_FILES["immagine"]["size"] > 5 * 1024 * 1024) {
        $messaggio = "File troppo grande.";
        $uploadOk = false;
    }

    $nomeSanificato = preg_replace('/[^a-zA-Z0-9_-]/', '-', strtolower($nome));
    $uniqueName = $nomeSanificato . '.' . $imageFileType;
    $percorsoRelativo = "../immagini/" . $uniqueName;
    $percorsoAssoluto = $targetDir . $uniqueName;

    if ($uploadOk && move_uploaded_file($_FILES["immagine"]["tmp_name"], $percorsoAssoluto)) {
        try {
            // Inserisci nella tabella prodotti
            $stmt = $pdo->prepare("INSERT INTO computer (percorsoimmagine, Descrizione, Prezzo, Nome) VALUES (?, ?, ?, ?)");
            $stmt->execute([$percorsoRelativo, $descrizione, $prezzo, $nome]);
            $idProdotto = $pdo->lastInsertId();

            // Inserisci in tagcomputer
            $stmt = $pdo->prepare("INSERT INTO tagcomputer (IDprodotto, idtag) VALUES (?, ?)");
            $stmt->execute([$idProdotto, $idtag]);

            $messaggio = "✅ Prodotto aggiunto con successo.";
        } catch (Exception $e) {
            $messaggio = "Errore DB: " . $e->getMessage();
        }
    } else if ($uploadOk) {
        $messaggio = "❌ Errore durante l'upload dell'immagine.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Aggiungi Prodotto</title>
</head>
<body>
    <h2>Aggiungi un nuovo computer</h2>

    <?php if (!empty($messaggio)) echo "<p><strong>$messaggio</strong></p>"; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Descrizione:</label><br>
        <textarea name="descrizione" required></textarea><br><br>

        <label>Prezzo (€):</label><br>
        <input type="number" step="0.01" name="prezzo" required><br><br>

        <label>Immagine:</label><br>
        <input type="file" name="immagine" accept="image/*" required><br><br>

        <label>Tag:</label><br>
        <select name="idtag" required>
            <?php
            // Preleva tutti i tag disponibili dal DB
            $stmt = $pdo->query("SELECT idtag, nome FROM tag ORDER BY idtag");
            while ($row = $stmt->fetch()) {
                echo "<option value='{$row['idtag']}'>{$row['idtag']} - {$row['nome']}</option>";
            }
            ?>
        </select><br><br>

        <button type="submit">Aggiungi Prodotto</button>
    </form>
</body>
</html>
