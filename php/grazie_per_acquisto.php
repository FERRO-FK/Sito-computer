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
    <style>
        body { font-family: Arial; padding: 40px; background: #f5f5f5; }
        .thankyou-container { background: white; padding: 30px; border-radius: 8px; max-width: 700px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #27ae60; }
        .summary-item { display: flex; align-items: center; margin-bottom: 15px; }
        .summary-item img { width: 80px; margin-right: 15px; border-radius: 6px; }
        .item-details h3 { margin: 0 0 5px; }
        .summary-totals { margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>

<div class="thankyou-container">
    <h1>🎉 Grazie per il tuo acquisto!</h1>
    <p>Il tuo ordine n. <strong>#<?= $idOrdine ?? '—' ?></strong> è stato registrato con successo.</p>

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

    <p style="margin-top: 30px;">Riceverai una conferma via email. Grazie per aver acquistato da noi!</p>
    <div style="text-align: center; margin-top: 30px;">
    <a href="index.php" style="
        display: inline-block;
        padding: 12px 24px;
        background-color: #27ae60;
        color: white;
        text-decoration: none;
        border-radius: 6px;
        font-weight: bold;
        transition: background 0.3s ease;
    " onmouseover="this.style.backgroundColor='#219150'" onmouseout="this.style.backgroundColor='#27ae60'">
        ⬅ Torna alla home
    </a>
</div>
</div>

</body>
</html>