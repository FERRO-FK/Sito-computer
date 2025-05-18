<?php
session_start();
require '../php/db.php';
$username = "Login";

if (isset($_SESSION['utente_id'])) {
  $utente_id = $_SESSION['utente_id'];
  $stmt = $pdo->prepare("SELECT utente.nome, mail, indirizzo.via, indirizzo.numerocivico, indirizzo.citta
                       FROM utente 
                       JOIN indirizzo ON utente.ID = indirizzo.idutente
                       WHERE utente.id = ?");
  $stmt->execute([$utente_id]);
  $user = $stmt->fetch();
  $username = $user['nome'];
}

// Definiamo l'array di tag/categorie         
$tags = [
    'Gaming' => 'gaming',
    'Nvdia Serie 3000' => 'Nvidia 3000',
    'Nvdia Serie 4000' => 'Nvidia 4000',
    'Nvdia Serie 5000' => 'Nvidia 5000',
    'AMD RX 5000' => 'AMD RX 5000',
    'AMD RX 6000' => 'AMD RX 6000',
    'AMD RX 7000' => 'AMD RX 7000',
    'AMD RX 9000' => 'AMD RX 9000',
    'AMD Ryzen' => 'AMD Ryzen',
    'Intel' => 'Intel',
    'Laptop' => 'laptop',
    'PC da casa' => 'pc-casa',
    'Leggerissimo' => 'leggero',
    'Video editing' => 'video editing',
    'All-in-One' => 'all-in-one',
    'Professionale' => 'professionale'
];
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tecno shop - Vendita Computer</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_navbar.css">
  <link rel="stylesheet" href="../css/styles_index.css">
  <link rel="stylesheet" href="../css/styles_footer.css">
  <link rel="icon" type="image/png" href="../immagini/favicon.png">
  <style>

  </style>
</head>
<body>

  <!--NAVBAR-->
  <div class="top-bar">
  <div class="logo">Tecno shop</div>
  <div class="nav-links">
    <a href="#"><i class="fas fa-home"></i> Home</a>
    <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
    <a href="../php/carrello.php"><i class="fas fa-shopping-cart"></i> Carrello</a>

    <?php
    // Assicurati che sia chiamato SOLO una volta per pagina
    if (isset($_SESSION['nome'])) {
        // Utente loggato
        echo '<a href="../php/dashboard.php"><i class="fas fa-user"></i> ' . htmlspecialchars($_SESSION['nome']) . '</a>';
    } else {
        // Utente non loggato
        echo '<a href="../php/login.php"><i class="fas fa-user"></i> Login</a>';
    }
    ?>
  </div>
</div>

  <div class="container">
    <header>
      <h1>Benvenuto su Tecno shop</h1>
      <p>I migliori computer a prezzi imbattibili</p>
    </header>

    <?php
// Recupera i prodotti consigliati o casuali
$prodotti = []; // Inizializza l'array prodotti

if (isset($_SESSION['utente_id'])) {
    $idUtente = $_SESSION['utente_id'];
    
    // Prima query: prodotti consigliati basati sugli interessi
    $sqlConsigliati = "
    SELECT c.IDProdotto, c.Nome, c.Descrizione, c.Prezzo
    FROM computer c
    JOIN tagComputer tc ON c.IDProdotto = tc.IDProdotto
    JOIN interessiUtente iu ON tc.IdTag = iu.IdTag
    WHERE iu.IdUtente = ?
    ORDER BY iu.Punteggio DESC
    LIMIT 5
    ";
    
    $stmt = $pdo->prepare($sqlConsigliati);
    $stmt->execute([$idUtente]);
    $prodotti = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Se ci sono meno di 5 prodotti consigliati, completa con prodotti casuali
    if (count($prodotti) < 5) {
        $contatore = 5 - count($prodotti);
        $idEsclusi = array_column($prodotti, 'IDProdotto');

        if (!empty($idEsclusi)) {
            $placeholders = implode(',', array_fill(0, count($idEsclusi), '?'));

            $sqlCasuali = "
            SELECT IDProdotto, Nome, Descrizione, Prezzo
            FROM computer
            WHERE IDProdotto NOT IN ($placeholders)
            ORDER BY RAND()
            LIMIT ?
            ";

            $stmt = $pdo->prepare($sqlCasuali);
            foreach ($idEsclusi as $index => $id) {
                $stmt->bindValue($index + 1, $id, PDO::PARAM_INT);
            }
            $stmt->bindValue(count($idEsclusi) + 1, $contatore, PDO::PARAM_INT);
        } else {
            // Nessun prodotto da escludere
            $sqlCasuali = "
            SELECT IDProdotto, Nome, Descrizione, Prezzo
            FROM computer
            ORDER BY RAND()
            LIMIT ?
            ";

            $stmt = $pdo->prepare($sqlCasuali);
            $stmt->bindValue(1, $contatore, PDO::PARAM_INT);
        }

        $stmt->execute();
        $prodottiCasuali = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $prodotti = array_merge($prodotti, $prodottiCasuali);
    }

} else {
    // Se l'utente non è loggato, mostra 5 prodotti casuali
    $sqlCasuali = "
    SELECT IDProdotto, Nome, Descrizione, Prezzo
    FROM computer
    ORDER BY RAND()
    LIMIT 5
    ";
    $prodotti = $pdo->query($sqlCasuali)->fetchAll(PDO::FETCH_ASSOC);
}

// Ora recuperiamo i tag per ogni prodotto
foreach ($prodotti as &$prodotto) {
    $id_prodotto = $prodotto['IDProdotto'];
    $tag_sql = "SELECT t.Nome FROM tag t INNER JOIN tagComputer tc ON t.IdTag = tc.IdTag WHERE tc.IDProdotto = ?";
    $stmt_tag = $pdo->prepare($tag_sql);
    $stmt_tag->execute([$id_prodotto]);
    $prodotto['tags'] = $stmt_tag->fetchAll(PDO::FETCH_COLUMN, 0);
}
unset($prodotto); // Rompe il riferimento dell'ultimo elemento
?>

    <!-- Sezione prodotti -->
    <section class="products-section">
      <h2>Articoli che potrebbero interessarti</h2>
      <div class="products-container">
        <?php foreach ($prodotti as $prodotto): ?>
          <div class="product-card">
            <div class="product-image-container">
              <?php $nomeProdottoCorretto = str_replace(' ', '', $prodotto['Nome']);?>
              <img class="product-image" src="../immagini/<?= htmlspecialchars($nomeProdottoCorretto) ?>.jpg" alt="<?= htmlspecialchars($prodotto['Nome']) ?>">
            </div>
            <div class="product-info">
              <h3><?= htmlspecialchars($prodotto['Nome']) ?></h3>
              <span class="price"><?= number_format($prodotto['Prezzo'], 2) ?>€</span>
              <?php if (!empty($prodotto['tags'])): ?>
                <div class="product-tags">
                  <?php foreach ($prodotto['tags'] as $tag): ?>
                    <span class="tag"><i class="fas fa-tag"></i> <?= htmlspecialchars($tag) ?></span>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
            <a href="dettaglio_prodotti.php?id=<?= $prodotto['IDProdotto'] ?>"><i class="fas fa-info-circle"></i> Dettagli</a>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

      
    <!-- Nuova sezione per le categorie -->
    <section class="categories-section">
      <h2 class="categories-title">Esplora le nostre categorie</h2>
      <div class="categories-container">
        <?php foreach ($tags as $label => $value): ?>
          <a href="../php/prodotti.php?categoria=<?= urlencode($value) ?>" class="category-btn">
            <?= htmlspecialchars($label) ?>
          </a>
        <?php endforeach; ?>
      </div>
    </section>
  </div>
  
  <!--FOOTER-->
  <div class="footer-divider"></div>
  <footer class="footer">
    <div class="footer-content">
      <div class="contact-info">
        <p><i class="fas fa-envelope"></i> Email: info@tecnoshop.com</p>
        <p><i class="fas fa-phone"></i> Telefono: +39 0123 456789</p>
        <p><i class="fas fa-map-marker-alt"></i> Indirizzo: Via Esempio 123, Milano, Italia</p>
      </div>
      <div class="social-icons">
        <a href="" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="" target="_blank" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        <a href="" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </footer>

</body>
</html>