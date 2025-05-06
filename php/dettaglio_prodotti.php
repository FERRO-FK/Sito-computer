<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tecno shop - Vendita Computer</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_navbar.css">
  <link rel="stylesheet" href="../css/styles_dettagli-prodotti.css">
  <link rel="stylesheet" href="../css/styles_footer.css">

  
</head>
<body>

  <!--NAVBAR-->
  <div class="top-bar">
    <div class="logo">Tecno shop</div>
    <div class="nav-links">
      <a href="#"><i class="fas fa-home"></i> Home</a>
      <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.html"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="#"><i class="fas fa-envelope"></i> Contatti</a>
      <a href="../php/login.php"><i class="fas fa-user"></i> Login</a>
    </div>
  </div>

  <?php
session_start();
require '../php/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM computer WHERE IDProdotto = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $prodotto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($prodotto) {
        // Dettagli prodotto con struttura aggiornata
        echo '<div class="contenitore-prodotto">';
        echo '<div class="sezione-superiore">';
        
        echo '<div class="immagine-prodotto">';
        echo '<img src="../immagini/' . $prodotto['Nome'] . '.jpg" alt="' . htmlspecialchars($prodotto['Nome']) . '">';
        echo '</div>';
        
        echo '<div class="dettagli-prodotto">';
        echo '<h1 class="prezzo">' . $prodotto['Prezzo'] . '€</h1>';
        echo '<p class="descrizione">' . $prodotto['Descrizione'] . '</p>';
        echo '<button class="bottone-compra">Compra</button>';
        echo '</div>';
        
        echo '</div>'; // sezione-superiore
        echo '</div>'; // contenitore-prodotto

        // RECENSIONI
        $stmtRecensioni = $pdo->prepare("SELECT r.Punteggio, r.Descrizione, u.Nome AS NomeUtente 
                                        FROM recensione r 
                                        JOIN utente u ON r.IDUtente = u.ID
                                        WHERE r.IDProdotto = :id");

        $stmtRecensioni->bindValue(':id', $id, PDO::PARAM_INT);
        $stmtRecensioni->execute();
        $recensioni = $stmtRecensioni->fetchAll(PDO::FETCH_ASSOC);

        if ($recensioni) {
            echo '<div class="recensioni">';
            echo '<h3>Recensioni:</h3>';
            foreach ($recensioni as $recensione) {
                echo '<div class="recensione">';
                echo '<p><strong>' . $recensione['NomeUtente'] . '</strong> - Punteggio: ' . $recensione['Punteggio'] . '</p>';
                echo '<p>' . $recensione['Descrizione'] . '</p>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>Nessuna recensione per questo prodotto.</p>';
        }

        // TAGS e PRODOTTI SIMILI
        $stmtTags = $pdo->prepare("SELECT t.IdTag FROM tag t
                                  JOIN tagComputer tc ON t.IdTag = tc.IdTag
                                  WHERE tc.IDProdotto = :id");
        $stmtTags->bindValue(':id', $id, PDO::PARAM_INT);
        $stmtTags->execute();
        $tagsProdotto = $stmtTags->fetchAll(PDO::FETCH_ASSOC);
        $tagIds = array_column($tagsProdotto, 'IdTag');

        if (count($tagIds) > 0) {
            $placeholders = implode(',', array_fill(0, count($tagIds), '?')); 
            $stmtProdottiSimili = $pdo->prepare(
                "SELECT c.IDProdotto, c.Nome, c.Descrizione, c.Prezzo, COUNT(tc.IdTag) AS TagMatch
                FROM computer c
                JOIN tagComputer tc ON c.IDProdotto = tc.IDProdotto
                WHERE tc.IdTag IN ($placeholders) AND c.IDProdotto != ?
                GROUP BY c.IDProdotto
                ORDER BY TagMatch DESC, c.Prezzo ASC"
            );
            $stmtProdottiSimili->execute(array_merge($tagIds, [$id]));
            $prodottiSimili = $stmtProdottiSimili->fetchAll(PDO::FETCH_ASSOC);

            if ($prodottiSimili) {
                echo '<div class="consigliati">';
                echo '<h3>Articoli che potrebbero interessarti</h3>';
                echo '<div class="prodotti-simili">';
                foreach ($prodottiSimili as $prodottoSimile) {
                    echo '<div class="prodotto-simile">';
                    echo '<h4><a href="dettaglio_prodotti.php?id=' . $prodottoSimile['IDProdotto'] . '">' . $prodottoSimile['Nome'] . '</a></h4>';
                    echo '<p>' . $prodottoSimile['Descrizione'] . '</p>';
                    echo '<p>Prezzo: ' . $prodottoSimile['Prezzo'] . '€</p>';
                    echo '</div>';
                }
                echo '</div></div>';
            } else {
                echo '<p>Non ci sono prodotti simili.</p>';
            }
        } else {
            echo '<p>Questo prodotto non ha tag associati.</p>';
        }
    } else {
        echo '<p>Prodotto non trovato.</p>';
    }
} else {
    echo '<p>ID prodotto non specificato.</p>';
}
?>


  
  
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