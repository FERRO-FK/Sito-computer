<?php
session_start();
require '../php/db.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    die("Accesso negato.");
}

// Lista utenti
$utenti = $pdo->query("SELECT * FROM utente")->fetchAll();
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tecno Shop - Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_navbar.css">
  <link rel="stylesheet" href="../css/styles_admin.css">
  <link rel="icon" type="image/png" href="../immagini/favicon.png">
</head>
<body class="admin-dashboard">
  <div class="top-bar">
    <div class="logo" onclick="window.location.href='html/index.php'">Tecno Shop</div>
    <div class="nav-links">
      <a href="../php/index.php"><i class="fas fa-home"></i> Home</a>
      <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.html"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="../php/login.php"><i class="fas fa-user"></i> Login</a>
      <a href="../php/logout.php" class="btn logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
    </div>
  </div>

  <div class="admin-container">
    <div class="admin-header">
      <h2 class="admin-title"><i class="fas fa-users-cog"></i> Gestione Utenti</h2>
    </div>

    <table class="users-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nome</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($utenti as $u): ?>
          <tr>
            <td><?= $u['ID'] ?></td>
            <td><?= htmlspecialchars($u['Nome']) ?></td>
            <td><?= htmlspecialchars($u['mail']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

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
        $allowed = ['jpg'];

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
                $stmt = $pdo->prepare("INSERT INTO computer (percorsoimmagine, Descrizione, Prezzo, Nome) VALUES (?, ?, ?, ?)");
                $stmt->execute([$percorsoRelativo, $descrizione, $prezzo, $nome]);
                $idProdotto = $pdo->lastInsertId();

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

    <?php if (!empty($messaggio)): ?>
      <div class="message <?= strpos($messaggio, '✅') !== false ? 'success' : 'error' ?>">
        <?= $messaggio ?>
      </div>
    <?php endif; ?>

    <div class="admin-header">
      <h2 class="admin-title"><i class="fas fa-laptop"></i> Aggiungi nuovo computer</h2>
    </div>

    <form class="product-form" action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label class="form-label">Nome:</label>
        <input class="form-input" type="text" name="nome" required>
      </div>

      <div class="form-group">
        <label class="form-label">Descrizione:</label>
        <textarea class="form-input form-textarea" name="descrizione" required></textarea>
      </div>

      <div class="form-group">
        <label class="form-label">Prezzo (€):</label>
        <input class="form-input" type="number" step="0.01" name="prezzo" required>
      </div>

      <div class="form-group">
        <label class="form-label">Immagine:</label>
        <input class="form-input" type="file" name="immagine" accept="image/*" required>
      </div>

      <div class="form-group">
        <label class="form-label">Tag:</label>
        <select class="form-select" name="idtag" required>
          <?php
          $stmt = $pdo->query("SELECT idtag, nome FROM tag ORDER BY idtag");
          while ($row = $stmt->fetch()) {
              echo "<option value='{$row['idtag']}'>{$row['idtag']} - {$row['nome']}</option>";
          }
          ?>
        </select>
      </div>

      <button class="form-button" type="submit">
        <i class="fas fa-plus-circle"></i> Aggiungi Prodotto
      </button>
    </form>
  </div>
</body>
</html>