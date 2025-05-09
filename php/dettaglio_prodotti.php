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
      <a href="../php/index.php"><i class="fas fa-home"></i> Home</a>
      <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.html"><i class="fas fa-shopping-cart"></i> Carrello</a>
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
        echo '<h1 class="titolo">'. htmlspecialchars($prodotto['Nome']) . '</h1>';
        echo '<h1 class="prezzo">' . number_format($prodotto['Prezzo'], 2) . '€</h1>';
        echo '<button class="bottone-compra">Compra</button>';
        echo '<p class="descrizione">' . htmlspecialchars($prodotto['Descrizione']) . '</p>';
        if (!empty($tagsProdotto)) {
          echo '<div class="product-tags" style="margin: 20px auto; max-width: 800px;">';
          echo '<h3>Tag:</h3>';
          foreach ($tagsProdotto as $tag) {
              echo '<span class="tag"><i class="fas fa-tag"></i> ' . htmlspecialchars($tag['Nome']) . '</span>';
          }
          echo '</div>';
      }

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
              echo '<p class="recensione-utente"><strong>' . htmlspecialchars($recensione['NomeUtente']) . '</strong> - Punteggio: ';

              $stellePiene = intval($recensione['Punteggio']);
              $stelleVuote = 5 - $stellePiene;

              for ($i = 0; $i < $stellePiene; $i++) {
                  echo '<i class="fa-solid fa-star" style="color:#ff6d00;"></i>';
              }
              for ($i = 0; $i < $stelleVuote; $i++) {
                  echo '<i class="fa-regular fa-star" style="color: #ff6d00;"></i>';
              }

              echo '</p>';
              echo '<p class="recensione-testo">' . htmlspecialchars($recensione['Descrizione']) . '</p>';
              echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>Nessuna recensione per questo prodotto.</p>';
        }

        // TAGS e PRODOTTI SIMILI
        $stmtTags = $pdo->prepare("SELECT t.IdTag, t.Nome FROM tag t
                                  JOIN tagComputer tc ON t.IdTag = tc.IdTag
                                  WHERE tc.IDProdotto = :id");
        $stmtTags->bindValue(':id', $id, PDO::PARAM_INT);
        $stmtTags->execute();
        $tagsProdotto = $stmtTags->fetchAll(PDO::FETCH_ASSOC);

        
        $tagIds = array_column($tagsProdotto, 'IdTag');

        if (count($tagIds) > 0) {
            $placeholders = implode(',', array_fill(0, count($tagIds), '?')); 
            $stmtProdottiSimili = $pdo->prepare(
                "SELECT DISTINCT c.IDProdotto, c.Nome, c.Descrizione, c.Prezzo
                 FROM computer c
                 JOIN tagComputer tc ON c.IDProdotto = tc.IDProdotto
                 WHERE tc.IdTag IN ($placeholders)
                 AND c.IDProdotto != ?
                 LIMIT 4"
            );
            $stmtProdottiSimili->execute(array_merge($tagIds, [$id]));
            $prodottiSimili = $stmtProdottiSimili->fetchAll(PDO::FETCH_ASSOC);

            if ($prodottiSimili) {
                // Per ogni prodotto simile, otteniamo i suoi tag
                foreach ($prodottiSimili as &$prodottoSimile) {
                    $stmtTagsSimile = $pdo->prepare("SELECT t.Nome FROM tag t
                                                    JOIN tagComputer tc ON t.IdTag = tc.IdTag
                                                    WHERE tc.IDProdotto = ?");
                    $stmtTagsSimile->execute([$prodottoSimile['IDProdotto']]);
                    $prodottoSimile['tags'] = $stmtTagsSimile->fetchAll(PDO::FETCH_ASSOC);
                }
                unset($prodottoSimile); // Break the reference

                echo '<div class="consigliati">';
                echo '<h3 class="titolo-simili">Articoli che potrebbero interessarti</h3>';
                echo '<div class="prodotti-simili">';
                foreach ($prodottiSimili as $prodottoSimile) {
                    echo '<div class="prodotto-simile">';
                    echo '<img src="../immagini/' . htmlspecialchars($prodottoSimile['Nome']) . '.jpg" alt="'. htmlspecialchars($prodottoSimile['Nome']) . '" class="immagine-simile">';
                    echo '<h4>' . htmlspecialchars($prodottoSimile['Nome']) . '</h4>';
                    echo '<p class="descrizione-simile">' . htmlspecialchars(substr($prodottoSimile['Descrizione'], 0, 80)) . '...</p>';
                    
                    // Aggiunta dei tag del prodotto simile
                    if (!empty($prodottoSimile['tags'])) {
                        echo '<div class="product-tags">';
                        foreach ($prodottoSimile['tags'] as $tag) {
                            echo '<span class="tag"><i class="fas fa-tag"></i> ' . htmlspecialchars($tag['Nome']) . '</span>';
                        }
                        echo '</div>';
                    }
                    
                    echo '<p class="prezzo-simile">' . number_format($prodottoSimile['Prezzo'], 2) . '€</p>';
                    echo '<a class="bottone-vedi" href="dettaglio_prodotti.php?id=' . $prodottoSimile['IDProdotto'] . '">Vedi</a>';
                    echo '</div>';
                }
                echo '</div></div>';
            } else {
                echo '<p>Non ci sono prodotti simili.</p>';
            }
        }
    }
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