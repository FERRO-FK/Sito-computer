<?php
// index.php
session_start();

$prodotti = [
  1 => ["nome" => "Notebook da ufficio", "prezzo" => 499.00],
  2 => ["nome" => "PC Gaming", "prezzo" => 899.00],
  3 => ["nome" => "Workstation", "prezzo" => 1299.00],
  4 => ["nome" => "Ultrabook", "prezzo" => 799.00],
  5 => ["nome" => "All-in-One", "prezzo" => 1099.00],
];
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Prodotti - Tecno Shop</title>
</head>
<body>
  <h1>Prodotti disponibili</h1>
  <ul>
    <?php foreach ($prodotti as $id => $prodotto): ?>
      <li>
        <strong><?php echo $prodotto['nome']; ?></strong> - <?php echo number_format($prodotto['prezzo'], 2); ?>€
        <a href="aggiungi_carrello.php?id=<?php echo $id; ?>">Aggiungi al carrello</a>
      </li>
    <?php endforeach; ?>
  </ul>

  <p><a href="carrello.php">Vai al carrello</a></p>
</body>
</html>

<?php
// aggiungi_carrello.php
session_start();

if (!isset($_GET['id'])) {
  header('Location: index.php');
  exit;
}

$id = (int) $_GET['id'];

if (!isset($_SESSION['carrello'])) {
  $_SESSION['carrello'] = [];
}

if (!isset($_SESSION['carrello'][$id])) {
  $_SESSION['carrello'][$id] = 1;
} else {
  $_SESSION['carrello'][$id]++;
}

header('Location: carrello.php');
exit;

// carrello.php
session_start();

$prodotti = [
  1 => ["nome" => "Notebook da ufficio", "prezzo" => 499.00],
  2 => ["nome" => "PC Gaming", "prezzo" => 899.00],
  3 => ["nome" => "Workstation", "prezzo" => 1299.00],
  4 => ["nome" => "Ultrabook", "prezzo" => 799.00],
  5 => ["nome" => "All-in-One", "prezzo" => 1099.00],
];

$carrello = $_SESSION['carrello'] ?? [];
$totale = 0.0;
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Carrello</title>
</head>
<body>
  <h1>Il tuo carrello</h1>

  <?php if (empty($carrello)): ?>
    <p>Il carrello è vuoto.</p>
  <?php else: ?>
    <ul>
      <?php foreach ($carrello as $id => $quantita): ?>
        <li>
          <?php echo $prodotti[$id]['nome']; ?> - Quantità: <?php echo $quantita; ?> - Subtotale: <?php
            $sub = $prodotti[$id]['prezzo'] * $quantita;
            echo number_format($sub, 2);
            $totale += $sub;
          ?>€
        </li>
      <?php endforeach; ?>
    </ul>
    <h3>Totale: <?php echo number_format($totale, 2); ?>€</h3>
  <?php endif; ?>

  <p><a href="index.php">Torna ai prodotti</a></p>
</body>
</html>
