<?php
session_start();
require '../php/db.php';

if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    die("Accesso negato.");
}

// Lista utenti
$utenti = $pdo->query("SELECT * FROM utente")->fetchAll();

// Elimina prodotto se richiesto
if (isset($_GET['elimina'])) {
    $idProdotto = $_GET['elimina'];
    
    try {
        $pdo->beginTransaction();
        
        // Elimina prima i tag associati
        $stmt = $pdo->prepare("DELETE FROM tagcomputer WHERE IDProdotto = ?");
        $stmt->execute([$idProdotto]);
        
        // Poi elimina il prodotto
        $stmt = $pdo->prepare("DELETE FROM computer WHERE IDProdotto = ?");
        $stmt->execute([$idProdotto]);
        
        $pdo->commit();
        header("Location: admin.php?messaggio=✅ Prodotto eliminato con successo");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        header("Location: admin.php?messaggio=❌ Errore durante l'eliminazione del prodotto");
        exit();
    }
}

// Prepara dati per modifica se richiesto
$prodottoDaModificare = null;
$tagSelezionati = [];
if (isset($_GET['modifica'])) {
    $idProdotto = $_GET['modifica'];
    $prodottoDaModificare = $pdo->prepare("SELECT * FROM computer WHERE IDProdotto = ?");
    $prodottoDaModificare->execute([$idProdotto]);
    $prodottoDaModificare = $prodottoDaModificare->fetch();
    
    // Carica anche i tag selezionati
    $stmt = $pdo->prepare("SELECT idtag FROM tagcomputer WHERE IDProdotto = ?");
    $stmt->execute([$idProdotto]);
    $tagSelezionati = $stmt->fetchAll(PDO::FETCH_COLUMN);
}

$messaggio = $_GET['messaggio'] ?? "";

// Se il form è stato inviato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descrizione = $_POST['descrizione'];
    $prezzo = $_POST['prezzo'];
    $idtags = $_POST['idtags'] ?? [];
    $idProdotto = $_POST['idProdotto'] ?? null;

    // Se è una modifica
    if ($idProdotto) {
        try {
            $pdo->beginTransaction();
            
            // Aggiorna il prodotto
            $stmt = $pdo->prepare("UPDATE computer SET Nome = ?, Descrizione = ?, Prezzo = ? WHERE IDProdotto = ?");
            $stmt->execute([$nome, $descrizione, $prezzo, $idProdotto]);
            
            // Elimina i vecchi tag
            $stmt = $pdo->prepare("DELETE FROM tagcomputer WHERE IDProdotto = ?");
            $stmt->execute([$idProdotto]);
            
            // Inserisci i nuovi tag
            if (!empty($idtags)) {
                $stmt = $pdo->prepare("INSERT INTO tagcomputer (IDProdotto, idtag) VALUES (?, ?)");
                foreach ($idtags as $idtag) {
                    $stmt->execute([$idProdotto, $idtag]);
                }
            } else {
                throw new Exception("Seleziona almeno un tag");
            }

            $pdo->commit();
            $messaggio = "✅ Prodotto modificato con successo.";
        } catch (Exception $e) {
            $pdo->rollBack();
            $messaggio = "Errore DB: " . $e->getMessage();
        }
    } 
    // Se è un nuovo inserimento
    else {
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

        $nomeSanificato = preg_replace('/[^a-zA-Z0-9_-]/', '', strtolower($nome));
        $uniqueName = $nomeSanificato . '.' . $imageFileType;
        $percorsoRelativo = "../immagini/" . $uniqueName;
        $percorsoAssoluto = $targetDir . $uniqueName;

        if ($uploadOk && move_uploaded_file($_FILES["immagine"]["tmp_name"], $percorsoAssoluto)) {
            try {
                $pdo->beginTransaction();
                
                // Inserisci il prodotto
                $stmt = $pdo->prepare("INSERT INTO computer (Descrizione, Prezzo, Nome) VALUES (?, ?, ?)");
                $stmt->execute([$descrizione, $prezzo, $nome]);
                $idProdotto = $pdo->lastInsertId();

                // Inserisci tutti i tag selezionati
                if (!empty($idtags)) {
                    $stmt = $pdo->prepare("INSERT INTO tagcomputer (IDprodotto, idtag) VALUES (?, ?)");
                    foreach ($idtags as $idtag) {
                        $stmt->execute([$idProdotto, $idtag]);
                    }
                } else {
                    throw new Exception("Seleziona almeno un tag");
                }

                $pdo->commit();
                $messaggio = "✅ Prodotto aggiunto con successo.";
            } catch (Exception $e) {
                $pdo->rollBack();
                $messaggio = "Errore DB: " . $e->getMessage();
                
                // Cancella l'immagine caricata se l'inserimento nel DB fallisce
                if (file_exists($percorsoAssoluto)) {
                    unlink($percorsoAssoluto);
                }
            }
        } else if ($uploadOk) {
            $messaggio = "❌ Errore durante l'upload dell'immagine.";
        }
    }
}

// Ottieni lista prodotti
$prodotti = $pdo->query("SELECT * FROM computer")->fetchAll();
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
      <a href="../php/carrello.php"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="../php/login.php"><i class="fas fa-user"></i> Login</a>
      <a href="../php/logout.php" class="btn lotgout"><i class="fas fa-sign-out-alt"></i> Logout</a>
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

    <?php if (!empty($messaggio)): ?>
      <div class="message <?= strpos($messaggio, '✅') !== false ? 'success' : 'error' ?>">
        <?= $messaggio ?>
      </div>
    <?php endif; ?>

    <div class="admin-header">
      <h2 class="admin-title"><i class="fas fa-desktop"></i> Lista Prodotti</h2>
      <button id="toggleProducts" class="toggle-products">
        <i class="fas fa-chevron-down"></i> Mostra/Nascondi Prodotti
      </button>
    </div>

    <div id="productsSection" class="products-section">
      <table class="users-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrizione</th>
            <th>Prezzo</th>
            <th>Azioni</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($prodotti as $p): ?>
            <tr>
              <td><?= $p['IDProdotto'] ?></td>
              <td><?= htmlspecialchars($p['Nome']) ?></td>
              <td><?= htmlspecialchars($p['Descrizione']) ?></td>
              <td><?= $p['Prezzo'] ?> €</td>
              <td class="actions">
                <a href="admin.php?modifica=<?= $p['IDProdotto'] ?>" class="btn edit"><i class="fas fa-edit"></i> Modifica</a>
                <a href="admin.php?elimina=<?= $p['IDProdotto'] ?>" class="btn delete" onclick="return confirm('Sei sicuro di voler eliminare questo prodotto?')"><i class="fas fa-trash"></i> Elimina</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="admin-header">
      <h2 class="admin-title"><i class="fas fa-laptop"></i> <?= $prodottoDaModificare ? 'Modifica' : 'Aggiungi nuovo' ?> computer</h2>
    </div>

    <form class="product-form" action="" method="POST" enctype="multipart/form-data">
      <?php if ($prodottoDaModificare): ?>
        <input type="hidden" name="idProdotto" value="<?= $prodottoDaModificare['IDProdotto'] ?>">
      <?php endif; ?>

      <div class="form-group">
        <label class="form-label">Nome:</label>
        <input class="form-input" type="text" name="nome" value="<?= $prodottoDaModificare ? htmlspecialchars($prodottoDaModificare['Nome']) : '' ?>" required>
      </div>

      <div class="form-group">
        <label class="form-label">Descrizione:</label>
        <textarea class="form-input form-textarea" name="descrizione" required><?= $prodottoDaModificare ? htmlspecialchars($prodottoDaModificare['Descrizione']) : '' ?></textarea>
      </div>

      <div class="form-group">
        <label class="form-label">Prezzo (€):</label>
        <input class="form-input" type="number" step="0.01" name="prezzo" value="<?= $prodottoDaModificare ? $prodottoDaModificare['Prezzo'] : '' ?>" required>
      </div>

      <?php if (!$prodottoDaModificare): ?>
        <div class="form-group">
          <label class="form-label">Immagine:</label>
          <input class="form-input" type="file" name="immagine" accept="image/*" required>
        </div>
      <?php endif; ?>

      <div class="form-group">
        <label class="form-label">Tag:</label>
        <div class="checkbox-container">
          <?php
          $stmt = $pdo->query("SELECT idtag, nome FROM tag ORDER BY idtag");
          while ($row = $stmt->fetch()) {
              echo '<div class="checkbox-item">';
              $checked = in_array($row['idtag'], $tagSelezionati) ? 'checked' : '';
              echo '<input type="checkbox" name="idtags[]" value="'.$row['idtag'].'" id="tag_'.$row['idtag'].'" '.$checked.'>';
              echo '<label for="tag_'.$row['idtag'].'">'.$row['idtag'].' - '.htmlspecialchars($row['nome']).'</label>';
              echo '</div>';
          }
          ?>
        </div>
      </div>

      <button class="form-button" type="submit">
        <i class="fas fa-<?= $prodottoDaModificare ? 'save' : 'plus-circle' ?>"></i> <?= $prodottoDaModificare ? 'Salva Modifiche' : 'Aggiungi Prodotto' ?>
      </button>

      <?php if ($prodottoDaModificare): ?>
        <a href="admin.php" class="btn cancel"><i class="fas fa-times"></i> Annulla</a>
      <?php endif; ?>
    </form>

  </div>

  <script>
    // Mostra/Nascondi lista prodotti
    const toggleBtn = document.getElementById('toggleProducts');
    const productsSection = document.getElementById('productsSection');
    
    toggleBtn.addEventListener('click', function() {
      productsSection.classList.toggle('collapsed');
      toggleBtn.classList.toggle('collapsed');
    });
    
    // Validazione form se i tag non sono selezionati
    document.querySelector('form.product-form').addEventListener('submit', function(e) {
        const checkboxesChecked = document.querySelectorAll('input[name="idtags[]"]:checked').length;
        if(checkboxesChecked === 0) {
            alert('Seleziona almeno un tag');
            e.preventDefault();
            return false;
        }
        return true;
    });
  </script>

</body>
</html>