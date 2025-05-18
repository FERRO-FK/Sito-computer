<?php
session_start();
require_once 'db.php';

$carrello = $_SESSION['carrello'] ?? [];
$prodotti = [];
$totale = 0;
$spedizione = 9.99;
$idUtente = $_SESSION['utente_id'];
if (!empty($carrello)) {
    $placeholders = implode(',', array_fill(0, count($carrello), '?'));
    $stmt = $pdo->prepare("SELECT idprodotto, nome, prezzo FROM computer WHERE idprodotto IN ($placeholders)");
    $stmt->execute(array_keys($carrello));
    $prodotti = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calcola totale
    foreach ($prodotti as $prodotto) {
        $id = $prodotto['idprodotto'];
        $quantita = $carrello[$id];
        $totale += $quantita * $prodotto['prezzo'];
    }

    $totaleFinale = $totale + $spedizione;

    // Inserisce ordine in tabella ordini
    $stmtOrdine = $pdo->prepare("INSERT INTO ordini (id_utente, totale) VALUES (?, ?)");
$stmtOrdine->execute([$idUtente, $totaleFinale]);
    $idOrdine = $pdo->lastInsertId();

    // Inserisce ogni prodotto in ordini_prodotti
    $stmtProdotto = $pdo->prepare("INSERT INTO ordini_prodotti (id_ordine, id_prodotto, quantita) VALUES (?, ?, ?)");
    foreach ($carrello as $idProdotto => $quantita) {
        $stmtProdotto->execute([$idOrdine, $idProdotto, $quantita]);
    }

    // === AGGIORNA INTERESSI UTENTE ===
    foreach ($carrello as $idProdotto => $quantita) {
    // Trova i tag associati a questo prodotto
    $stmtTags = $pdo->prepare("SELECT idTag FROM tagcomputer WHERE IDprodotto = ?");
    $stmtTags->execute([$idProdotto]);
    $tags = $stmtTags->fetchAll(PDO::FETCH_COLUMN);

    foreach ($tags as $idTag) {
        // Controlla se l'utente ha già un punteggio per questo tag
        $stmtCheck = $pdo->prepare("SELECT punteggio FROM interessiutente WHERE idUtente = ? AND idTag = ?");
        $stmtCheck->execute([$idUtente, $idTag]);
        $punteggioEsistente = $stmtCheck->fetchColumn();

        if ($punteggioEsistente !== false) {
            // Aggiunge 1 al punteggio esistente
            $stmtUpdate = $pdo->prepare("UPDATE interessiutente SET Punteggio = Punteggio + 1 WHERE idUtente = ? AND idTag = ?");
            $stmtUpdate->execute([$idUtente, $idTag]);
        } else {
            // Inserisce nuovo interesse con punteggio iniziale 1
            $stmtInsert = $pdo->prepare("INSERT INTO interessiutente (idUtente, idTag, Punteggio) VALUES (?, ?, 1)");
            $stmtInsert->execute([$idUtente, $idTag]);
        }
    }
}






    // Svuota carrello
    $_SESSION['carrello'] = [];
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Grazie per l'acquisto</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_grazie_per_acquisto.css">
  <link rel="icon" type="image/png" href="../immagini/favicon.png">

</head>
<body>

<div class="thankyou-container">
    <h1>Grazie per il tuo acquisto!</h1>
    <p>Il tuo ordine è stato registrato con successo.</p>

    <div class="summary-items">
        <?php foreach ($prodotti as $prodotto): 
            $id = $prodotto['idprodotto'];
            $quantita = $carrello[$id];
            $subtotale = $quantita * $prodotto['prezzo'];
            $imgFile = str_replace(' ', '', $prodotto['nome']) . '.jpg';
        ?>
        <div class="summary-item">
            <img src="../immagini/<?= htmlspecialchars($imgFile) ?>" alt="<?= htmlspecialchars($prodotto['nome']) ?>">
            <div class="item-details">
                <h3><?= htmlspecialchars($prodotto['nome']) ?></h3>
                <p><?= $quantita ?> x €<?= number_format($prodotto['prezzo'], 2, ',', '.') ?> = €<?= number_format($subtotale, 2, ',', '.') ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="summary-totals">
        <p>Subtotale: €<?= number_format($totale, 2, ',', '.') ?></p>
        <p>Spedizione: €<?= number_format($spedizione, 2, ',', '.') ?></p>
        <p><strong>Totale pagato: €<?= number_format($totaleFinale, 2, ',', '.') ?></strong></p>
    </div>

    <p class="confirmation-message">Riceverai una conferma via email. Grazie per aver acquistato da noi!</p>
    <div class="return-home">
    <a href="index.php" class="btn-home">⬅ Torna alla home</a>
    </div>
</div>

</body>
</html>