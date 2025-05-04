<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Prodotti - Tecno shop</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_navbar.css">
  <link rel="stylesheet" href="../css/styles_prodotti.css">
  <link rel = "stylesheet" href="../css/styles_footer.css">
</head>
<body>
  <div class="top-bar">
    <div class="logo">Tecno shop</div>
    <div class="nav-links">
      <a href="../html/index.html"><i class="fas fa-home"></i> Home</a>
      <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.html"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="#"><i class="fas fa-envelope"></i> Contatti</a>
      <a href="../php/login.php"><i class="fas fa-user"></i> Login</a>
    </div>
  </div>
    <div class="container">
    <header>
      <h1>I Nostri Prodotti</h1>
      <p>Scopri la nostra selezione di computer e accessori</p>
    </header>
    <?php
// Definiamo l'array di tag/categorie         
    $tags = [
        'Gaming' => 'gaming',
        'Nvdia' => 'Nvdia',
        'AMD' => 'AMD',
        'Intel' => 'Intel',
        'Laptop' => 'laptop',
        'PC da casa' => 'pc-casa',
        'Leggerissimo' => 'leggero',
        'Video editing' => 'video editing',
        'All-in-Inclusive' => 'all-in-inclusive',
        'Professionele' => 'professionale'
    ];
?>
    <!-- Sezione Filtri -->
    <div class="filters-container">
      <form id="filters-form" method="GET">
        <div class="filters-bar">
          <div class="filter-group">
            <label for="category-filter"><i class="fas fa-filter"></i> Categoria:</label>
            <select name="categoria" id="category-filter" class="filter-select">
              <option value="all" <?php if (($_GET['categoria'] ?? '') === 'all') echo 'selected'; ?>>Tutte le categorie</option>
              <?php foreach ($tags as $label => $value): ?>
                <option value="<?php echo htmlspecialchars($value); ?>" <?php if (($_GET['categoria'] ?? '') === $value) echo 'selected'; ?>>
                  <?php echo htmlspecialchars($label); ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="filter-group">
            <label for="price-filter"><i class="fas fa-euro-sign"></i> Prezzo:</label>
            <select name="prezzo" id="price-filter" class="filter-select">
              <option value="all" <?php if (($_GET['prezzo'] ?? '') === 'all') echo 'selected'; ?>>Tutti i prezzi</option>
              <option value="0-500" <?php if (($_GET['prezzo'] ?? '') === '0-500') echo 'selected'; ?>>Fino a 500€</option>
              <option value="500-1000" <?php if (($_GET['prezzo'] ?? '') === '500-1000') echo 'selected'; ?>>500€ - 1000€</option>
              <option value="1000-1500" <?php if (($_GET['prezzo'] ?? '') === '1000-1500') echo 'selected'; ?>>1000€ - 1500€</option>
              <option value="1500+" <?php if (($_GET['prezzo'] ?? '') === '1500+') echo 'selected'; ?>>Oltre 1500€</option>
            </select>
          </div>

          <div class="filter-group">
            <label for="sort-by"><i class="fas fa-sort"></i> Ordina per:</label>
            <select name="ordina" id="sort-by" class="filter-select">
              <option value="default" <?php if (($_GET['ordina'] ?? '') === 'default') echo 'selected'; ?>>Predefinito</option>
              <option value="price-asc" <?php if (($_GET['ordina'] ?? '') === 'price-asc') echo 'selected'; ?>>Prezzo: crescente</option>
              <option value="price-desc" <?php if (($_GET['ordina'] ?? '') === 'price-desc') echo 'selected'; ?>>Prezzo: decrescente</option>
              <option value="name-asc" <?php if (($_GET['ordina'] ?? '') === 'name-asc') echo 'selected'; ?>>Nome: A-Z</option>
              <option value="name-desc" <?php if (($_GET['ordina'] ?? '') === 'name-desc') echo 'selected'; ?>>Nome: Z-A</option>
            </select>
          </div>

          <button type="reset" class="filter-reset" onclick="window.location.href=window.location.pathname">
            <i class="fas fa-sync-alt"></i> Resetta
          </button>
        </div>
      </form>
    </div>

<!-- Script per invio automatico -->
<script>
  document.querySelectorAll('#filters-form select').forEach(select => {
    select.addEventListener('change', () => {
      document.getElementById('filters-form').submit();
    });
  });
</script>
    
    <!-- query per cercare i prodotti-->
    <?php
    // Connessione al database
    $conn = mysqli_connect("localhost", "root", "root", "sito");

    // Recupera l'ID del tag selezionato
    $categoria = $_GET['categoria'] ?? 'all';
    $tag_id = null;

    if ($categoria !== 'all') {
        // Recupera l'ID del tag in base al nome (forzando case-insensitivity)
        $stmt = $conn->prepare("SELECT IdTag FROM tag WHERE LOWER(Nome) = LOWER(?)");
        $stmt->bind_param("s", $categoria);
        $stmt->execute();
        $stmt->bind_result($tag_id);
        $stmt->fetch();
        $stmt->close();

        // Stampa di debug per verificare cosa viene passato
        echo "Tag selezionato: " . htmlspecialchars($categoria) . "<br>";
        echo "ID Tag recuperato: " . $tag_id . "<br>";
    }

    // Costruzione della query SQL
    $sql = "
        SELECT DISTINCT c.Nome, c.Descrizione, c.Prezzo
        FROM computer c
    ";

    // Join per categoria solo se necessario
    if ($categoria !== 'all') {
        $sql .= " INNER JOIN tagComputer tc ON c.IDProdotto = tc.IDProdotto ";
    }

    // Clausola WHERE dinamica
    $sql .= " WHERE 1 = 1 ";

    $params = [];
    $types = "";

    // Filtro per categoria (tag)
    if ($categoria !== 'all' && $tag_id !== null) {
        $sql .= " AND tc.IdTag = ? ";
        $params[] = $tag_id;
        $types .= "i";
    }

    // Filtro per prezzo
    $prezzo_filtro = $_GET['prezzo'] ?? 'all';
    if ($prezzo_filtro === '0-500') {
        $sql .= " AND c.Prezzo <= ? ";
        $params[] = 500;
        $types .= "d";
    } elseif ($prezzo_filtro === '500-1000') {
        $sql .= " AND c.Prezzo > ? AND c.Prezzo <= ? ";
        $params[] = 500;
        $params[] = 1000;
        $types .= "dd";
    } elseif ($prezzo_filtro === '1000-1500') {
        $sql .= " AND c.Prezzo > ? AND c.Prezzo <= ? ";
        $params[] = 1000;
        $params[] = 1500;
        $types .= "dd";
    } elseif ($prezzo_filtro === '1500+') {
        $sql .= " AND c.Prezzo > ? ";
        $params[] = 1500;
        $types .= "d";
    }

    // Ordinamento
    $sort = $_GET['ordina'] ?? 'default';
    switch ($sort) {
        case 'price-asc':
            $sql .= " ORDER BY c.Prezzo ASC ";
            break;
        case 'price-desc':
            $sql .= " ORDER BY c.Prezzo DESC ";
            break;
        case 'name-asc':
            $sql .= " ORDER BY c.Nome ASC ";
            break;
        case 'name-desc':
            $sql .= " ORDER BY c.Nome DESC ";
            break;
        default:
            // Nessun ordinamento
            break;
    }

    // Preparazione e esecuzione della query
    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $prodotti = $result->fetch_all(MYSQLI_ASSOC);

    // Stampa a scopo di debug
    echo "<pre>";
    print_r($prodotti);
    echo "</pre>";
    ?>



    <section class="products-section">
      <h2>Articoli che potrebbero interessarti</h2>
      <div class="products-container">
      <div class="product-card" data-id="1" data-category="laptop" data-price="499">
    <div class="product-image-container">
        <img class="product-image" src="../immagini/laptop HP.jpg" alt="Laptop HP">
    </div>
    <div class="product-info">
        <h3>Laptop HP</h3>
        <span class="price">549€</span>
        <div class="specs">
            <p><i class="fas fa-microchip"></i> Intel Core i5-1235U</p>
            <p><i class="fas fa-memory"></i> 8GB RAM</p>
            <p><i class="fas fa-hdd"></i> SSD 256GB</p>
            <p><i class="fas fa-tv"></i> 17,3" Full HD IPS Antiriflesso</p>
        </div>
    </div>
    <div class="product-actions">
        <a href="#" class="add-to-cart" onclick="addToCart(1); return false;">
            <i class="fas fa-cart-plus"></i> Aggiungi
        </a>
        <a href="#"><i class="fas fa-info-circle"></i> Dettagli</a>
    </div>
</div>

<div class="product-card" data-id="2" data-category="gaming" data-price="899">
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
    <div class="product-actions">
        <a href="#" class="add-to-cart" onclick="addToCart(2); return false;"><i class="fas fa-cart-plus"></i> Aggiungi</a>
        <a href="#"><i class="fas fa-info-circle"></i> Dettagli</a>
    </div>
</div>

<div class="product-card" data-id="3" data-category="workstation" data-price="1299">
    <div class="product-image-container">
        <img class="product-image" src="../immagini/PC Gaming 4060.jpg" alt="Workstation">
    </div>
    <div class="product-info">
        <h3>PC Gaming 4060</h3>
        <span class="price">929€</span>
        <div class="specs">
            <p><i class="fas fa-microchip"></i> Intel i5-12400F</p>
            <p><i class="fas fa-memory"></i> 16GB RAM</p>
            <p><i class="fas fa-hdd"></i> SSD 1TB</p>
            <p><i class="fas fa-fan"></i> NVIDIA RTX 4060</p>
        </div>
    </div>
    <div class="product-actions">
        <a href="#" class="add-to-cart" onclick="addToCart(3); return false;"><i class="fas fa-cart-plus"></i> Aggiungi</a>
        <a href="#"><i class="fas fa-info-circle"></i> Dettagli</a>
    </div>
</div>

<div class="product-card" data-id="4" data-category="ultrabook" data-price="799">
    <div class="product-image-container">
        <img class="product-image" src="../immagini/PC Gaming 5080.jpg" alt="Ultrabook">
    </div>
    <div class="product-info">
        <h3>PC Gaming 5080</h3>
        <span class="price">2.499€</span>
        <div class="specs">
            <p><i class="fas fa-microchip"></i> Intel Core i9-12900KF</p>
            <p><i class="fas fa-memory"></i> 32GB RAM DDR5</p>
            <p><i class="fas fa-hdd"></i> SSD 1TB</p>
            <p><i class="fas fa-fan"></i> NVIDIA RTX 5080</p>
        </div>
    </div>
    <div class="product-actions">
        <a href="#" class="add-to-cart" onclick="addToCart(4); return false;"><i class="fas fa-cart-plus"></i> Aggiungi</a>
        <a href="#"><i class="fas fa-info-circle"></i> Dettagli</a>
    </div>
</div>

<div class="product-card" data-id="5" data-category="all-in-one" data-price="1099">
    <div class="product-image-container">
        <img class="product-image" src="../immagini/PC Fisso Intel I5.jpg" alt="All-in-One">
    </div>
    <div class="product-info">
        <h3>PC Fisso Intel I5 </h3>
        <span class="price">599€</span>
        <div class="specs">
            <p><i class="fas fa-microchip"></i> Intel Core i5-14400</p>
            <p><i class="fas fa-memory"></i> 32GB RAM DDR4</p>
            <p><i class="fas fa-hdd"></i> SSD 1TB</p>
            <p><i class="fas fa-fan"></i> Intel UHD 730 integrata</p>
        </div>
    </div>
    <div class="product-actions">
        <a href="#" class="add-to-cart" onclick="addToCart(5); return false;"><i class="fas fa-cart-plus"></i> Aggiungi</a>
        <a href="#"><i class="fas fa-info-circle"></i> Dettagli</a>
    </div>
</div>
          
      </div>
    </section>
  </div>

  <!--FOOTER-->
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

  <script>
    // Funzione per aggiungere al carrello
    async function addToCart(productId) {
      try {
        const response = await fetch('../php/backend_carrello.php?action=addToCart&id=' + productId);
        const data = await response.json();

        if(data.success) {
          showNotification('Prodotto aggiunto al carrello!');
          updateCartCounter();
        } else {
          showNotification('Errore: ' + data.message, 'error');
        }
      } catch (error) {
        console.error('Errore:', error);
        showNotification('Errore di connessione', 'error');
      }
    } 

    // Mostra una notifica temporanea
    function showNotification(message, type = 'success') {
      const notification = document.createElement('div');
      notification.className = `notification ${type}`;
      notification.textContent = message;
      document.body.appendChild(notification);

      setTimeout(() => {
        notification.remove();
      }, 3000);
    }

    // Aggiorna il contatore del carrello
    async function updateCartCounter() {
      const cartCounter = document.querySelector('.nav-links a[href="../html/carrello.html"]');
      if(cartCounter) {
        try {
          const response = await fetch('../php/backend_carrello.php?action=getCount');
          const data = await response.json();

          if(data.success) {
            const existingCounter = cartCounter.querySelector('.cart-counter');
            if(existingCounter) existingCounter.remove();

            if(data.count > 0) {
              const counter = document.createElement('span');
              counter.className = 'cart-counter';
              counter.textContent = data.count;
              cartCounter.appendChild(counter);
            }
          }
        } catch (error) {
          console.error('Errore nel contatore:', error);
        }
      }
    }

    // Inizializza il contatore del carrello al caricamento
    document.addEventListener('DOMContentLoaded', updateCartCounter);
  </script>
</body>
</html>