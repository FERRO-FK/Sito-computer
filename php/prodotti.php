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
  <link rel="stylesheet" href="../css/styles_footer.css">
</head>
<body>
  <div class="top-bar">
    <div class="logo">Tecno shop</div>
    <div class="nav-links">
      <a href="../html/index.php"><i class="fas fa-home"></i> Home</a>
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
        //'Nvdia' => 'Nvdia',
        'Nvdia Serie 3000' => 'Nvidia 3000',
        'Nvdia Serie 4000' => 'Nvidia 4000',
        'Nvdia Serie 5000' => 'Nvidia 5000',
        //'AMD RX' => 'AMD RX',
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
          <div class="filter-group">
            <label for="search-filter"><i class="fas fa-search"></i> Cerca:</label>
            <input 
              type="text" 
              name="query" 
              id="search-filter" 
              class="filter-input" 
              placeholder="Cerca prodotti..." 
              value="<?php echo htmlspecialchars($_GET['query'] ?? ''); ?>">
          </div>

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
        //echo "Tag selezionato: " . htmlspecialchars($categoria) . "<br>";
        //echo "ID Tag recuperato: " . $tag_id . "<br>";
    }

    // Costruzione della query SQL
    $sql = "
        SELECT DISTINCT c.IDProdotto, c.Nome, c.Descrizione, c.Prezzo
        FROM computer c
    ";

    // Join per categoria solo se necessario
    if ($categoria !== 'all') {
        $sql .= "
            INNER JOIN tagComputer tc ON c.IDProdotto = tc.IDProdotto
            INNER JOIN tag t ON tc.IdTag = t.IdTag
        ";
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

    // Filtro per ricerca testuale
    $query = $_GET['query'] ?? '';
    if (!empty($query)) {
        $sql .= " AND c.Nome LIKE ? ";
        $params[] = '%' . $query . '%';
        $types .= "s";
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

    // Ora per ogni prodotto, otteniamo i tag associati
    foreach ($prodotti as &$prodotto) {
        $id_prodotto = $prodotto['IDProdotto'];
        
        // Query per ottenere i tag associati a questo prodotto
        $tag_sql = "
            SELECT t.Nome
            FROM tag t
            INNER JOIN tagComputer tc ON t.IdTag = tc.IdTag
            WHERE tc.IDProdotto = ?
        ";
        
        $stmt_tag = $conn->prepare($tag_sql);
        $stmt_tag->bind_param("i", $id_prodotto);
        $stmt_tag->execute();
        $result_tag = $stmt_tag->get_result();
        
        // Salviamo tutti i tag associati al prodotto
        $tags = [];
        while ($row = $result_tag->fetch_assoc()) {
            $tags[] = $row['Nome'];
        }
        
        // Aggiungiamo l'elenco dei tag al prodotto
        $prodotto['tags'] = $tags;
        $stmt_tag->close();
    }

    // Stampa a scopo di debug
    //echo "<pre>";
    //print_r($prodotti);
    //echo "</pre>";
    ?>

    <script>
      const prodotti = <?php echo json_encode($prodotti, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); ?>;
    </script>



    <section class="products-section">
      <h2>Articoli che potrebbero interessarti</h2>
      <div class="products-container">
      <script>
      // Funzione per creare e renderizzare dinamicamente le product card
      function renderProducts() {
        const container = document.querySelector(".products-container");
        container.innerHTML = ""; // Pulisce eventuali contenuti statici

        prodotti.forEach(product => {
          const card = document.createElement("div");
          card.className = "product-card";
          card.setAttribute("data-id", product.IDProdotto);
          card.setAttribute("data-category", product.tags?.[0] || "none"); // Usa il primo tag, se esiste
          card.setAttribute("data-price", product.Prezzo);

          // Percorso dell'immagine - fallback se non esiste
          const imagePath = `../immagini/${product.Nome}.jpg`;

          card.innerHTML = `
            <div class="product-image-container">
                <img class="product-image" src="${imagePath}" alt="${product.Nome}">
            </div>
              <div class="product-info">
      <h3>${product.Nome}</h3>
      <span class="price">${parseFloat(product.Prezzo).toFixed(2)}€</span>
      <!-- Ciclo su tutti i tag del prodotto e li visualizzo con icona -->
      <div class="product-tags">
          ${product.tags?.map(tag => `<span class="tag"><i class="fas fa-tag"></i> ${tag}</span>`).join(" ") || ""}
      </div>

  </div>
  <div class="product-actions">
      <a href="#" class="add-to-cart" onclick="addToCart(${product.IDProdotto}); return false;">
          <i class="fas fa-cart-plus"></i> Aggiungi
      </a>
      <a href="#"><i class="fas fa-info-circle"></i> Dettagli</a>
  </div>
          `;

          container.appendChild(card);
        });
      }

      // Esegui la funzione dopo il caricamento
      document.addEventListener("DOMContentLoaded", renderProducts);
    </script>
    </div>

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