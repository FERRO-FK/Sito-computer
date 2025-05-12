<?php
session_start();
require '../php/db.php';
$username = "Login";

if (isset($_SESSION['utente_id'])) {
  $utente_id = $_SESSION['utente_id'];
$stmt = $pdo->prepare("SELECT utente.nome, mail, indirizzo.via, indirizzo.numerocivico, indirizzo.citta
                       FROM utente 
                       JOIN indirizzo ON utente.IDindirizzo = indirizzo.IDindirizzo
                       WHERE utente.id = ?");
$stmt->execute([$utente_id]);
$user = $stmt->fetch();
$username = $user['nome'];

}



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

  
</head>
<body>

  <!--NAVBAR-->
  <div class="top-bar">
    <div class="logo">Tecno shop</div>
    <div class="nav-links">
      <a href="#"><i class="fas fa-home"></i> Home</a>
      <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.html"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="../php/login.php"><i class="fas fa-user"></i> Login</a>
    </div>
  </div>

  <div class="container">
    <header>
      <h1>Benvenuto su Tecno shop</h1>
      <p>I migliori computer a prezzi imbattibili</p>
    </header>

    <?php
     

      $idUtente = $_SESSION['utente_id']; // <-- Cambia questo con l'ID utente reale

      $sql = "
      SELECT c.Nome, c.Descrizione, c.Prezzo
      FROM computer c
      JOIN tagComputer tc ON c.IDProdotto = tc.IDProdotto
      JOIN interessiUtente iu ON tc.IdTag = iu.IdTag
      WHERE iu.IdUtente = ?
      ORDER BY iu.Punteggio DESC
      LIMIT 1
       ";

      $stmt = $pdo->prepare($sql);
      $stmt->execute([$idUtente]);
      

     
      // Inizializza l'array dei risultati
      $prodotti = $stmt->fetchAll(PDO::FETCH_ASSOC);

     
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $prodotti[] = $row;
    }

      // Stampa l'array risultante
      echo "<pre>";
      print_r($prodotti);
      echo "</pre>";

      // Cleanup
      
    ?>

    <section class="products-section">
      <h2>Articoli che potrebbero interessarti</h2>
      <div class="products-container">
        
        <div class="product-card">
          <div class="product-image-container">
            <img class="product-image" src="notebook-ufficio.jpg" alt="Notebook da ufficio">
          </div>
          <div class="product-info">
            <h3>Notebook da ufficio</h3>
            <span class="price">499€</span>
            <div class="specs">
              <p><i class="fas fa-microchip"></i> Intel Core i5</p>
              <p><i class="fas fa-memory"></i> 8GB RAM</p>
              <p><i class="fas fa-hdd"></i> SSD 256GB</p>
              <p><i class="fas fa-tv"></i> 15.6" Full HD</p>
            </div>
          </div>
          <a href="notebook_da_ufficio.html"><i class="fas fa-info-circle"></i> Dettagli</a>
        </div>

        <div class="product-card">
          <div class="product-image-container">
            <img class="product-image" src="../immagini/PC Gaming.jpg" alt="PC Gaming">
          </div>
          <div class="product-info">
            <h3>PC Gaming</h3>
            <span class="price">899€</span>
            <div class="specs">
              <p><i class="fas fa-microchip"></i> AMD Ryzen 7</p>
              <p><i class="fas fa-memory"></i> 16GB RAM</p>
              <p><i class="fas fa-hdd"></i> SSD 512GB</p>
              <p><i class="fas fa-fan"></i> NVIDIA RTX 3060</p>
            </div>
          </div>
          <a href="pc_gaming.html"><i class="fas fa-info-circle"></i> Dettagli</a>
        </div>

        <div class="product-card">
          <div class="product-image-container">
            <img class="product-image" src="workstation.jpg" alt="Workstation">
          </div>
          <div class="product-info">
            <h3>Workstation</h3>
            <span class="price">1.299€</span>
            <div class="specs">
              <p><i class="fas fa-microchip"></i> Intel Xeon</p>
              <p><i class="fas fa-memory"></i> 32GB RAM</p>
              <p><i class="fas fa-hdd"></i> SSD 1TB</p>
              <p><i class="fas fa-certificate"></i> Quadro RTX 4000</p>
            </div>
          </div>
          <a href="workstation.html"><i class="fas fa-info-circle"></i> Dettagli</a>
        </div>

        <div class="product-card">
          <div class="product-image-container">
            <img class="product-image" src="ultrabook.jpg" alt="Ultrabook">
          </div>
          <div class="product-info">
            <h3>Ultrabook</h3>
            <span class="price">799€</span>
            <div class="specs">
              <p><i class="fas fa-microchip"></i> Intel Core i7</p>
              <p><i class="fas fa-memory"></i> 16GB RAM</p>
              <p><i class="fas fa-hdd"></i> SSD 512GB</p>
              <p><i class="fas fa-weight"></i> Solo 1.2kg</p>
            </div>
          </div>
          <a href="ultrabook.html"><i class="fas fa-info-circle"></i> Dettagli</a>
        </div>

        <div class="product-card">
          <div class="product-image-container">
            <img class="product-image" src="all-in-one.jpg" alt="All-in-One">
          </div>
          <div class="product-info">
            <h3>All-in-One</h3>
            <span class="price">1.099€</span>
            <div class="specs">
              <p><i class="fas fa-microchip"></i> Intel Core i5</p>
              <p><i class="fas fa-memory"></i> 12GB RAM</p>
              <p><i class="fas fa-hdd"></i> SSD 512GB</p>
              <p><i class="fas fa-tv"></i> 24" 4K Touch</p>
            </div>
          </div>
          <a href="all-in-one.html"><i class="fas fa-info-circle"></i> Dettagli</a>
        </div>

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