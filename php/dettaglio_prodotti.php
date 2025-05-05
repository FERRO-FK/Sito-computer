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
        // Usa PDO per preparare e eseguire la query
        $stmt = $pdo->prepare("SELECT * FROM computer WHERE IDProdotto = :id");
        
        // Usa bindValue o bindParam per associare i parametri
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
        $stmt->execute();
    
        // Recupera il risultato come array associativo
        $prodotto = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($prodotto) {
            echo "<h1>{$prodotto['Nome']}</h1>";
            echo "<p>{$prodotto['Descrizione']}</p>";
            echo "<p>Prezzo: {$prodotto['Prezzo']}€</p>";
        } else {
            echo "Prodotto non trovato.";
        }
    } else {
        echo "ID non specificato.";
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