<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Carrello - Tecno shop</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_navbar.css">
  <link rel="stylesheet" href="../css/styles_carrello.css">
  <link rel="stylesheet" href="../css/styles_footer.css">
  <link rel="icon" type="image/png" href="../immagini/favicon.png">
</head>
<body>

  <div class="top-bar">
    <div class="logo">Tecno shop</div>
    <div class="nav-links">
      <a href="../php/index.php"><i class="fas fa-home"></i> Home</a>
      <a href="../php/prodotti.php"><i class="fas fa-laptop"></i> Prodotti</a>
      <a href="../html/carrello.php"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <?php
      session_start();
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
      <h1>Il Tuo Carrello</h1>
    </header>
    
    <div class="cart-container">
      <div class="cart-items">
        <!-- Prodotto 1 -->
        <div class="cart-item">
          <div class="quantity-controls">
            <button>-</button>
            <span>1</span>
            <button>+</button>
          </div>
          <button class="remove-item"><i class="fas fa-trash"></i></button>
        </div>

        <!-- Prodotto 2 -->
        <div class="cart-item">
          <img src="https://via.placeholder.com/80" alt="PC Gaming">
          <div class="item-details">
          </div>
          <div class="quantity-controls">
            <button>-</button>
            <span>1</span>
            <button>+</button>
          </div>
          <button class="remove-item"><i class="fas fa-trash"></i></button>
        </div>
      </div>

      <div class="cart-summary">
        <div class="summary-row">
          <span>Subtotale</span>
          <span>costo-carello</span>
        </div>
        <div class="summary-row">
          <span>Spedizione</span>
          <span>Gratuita</span>
        </div>
        <div class="summary-row total">
          <span>Totale</span>
          <span></span>
        </div>

        <a href="../php/checkout.php" class="checkout-btn">Procedi all'acquisto</a>
        <a href="../html/index.php" class="continue-shopping"><i class="fas fa-arrow-left"></i> Continua lo shopping</a>
      </div>
    </div>
  </div>

  <script>
    // Variabile globale per il carrello
    let cartItems = [];
  
    // Carica il carrello dal server al caricamento della pagina
    document.addEventListener('DOMContentLoaded', async function() {
      await loadCartFromServer();
      renderCart();
    });
  
    // Carica il carrello dal server PHP
    async function loadCartFromServer() {
      try {
        const response = await fetch('../php/backend_carrello.php?action=getCart');
        const data = await response.json();
        
        if(data.success) {
          cartItems = data.cartItems;
        } else {
          console.error('Errore nel caricamento del carrello:', data.message);
        }
      } catch (error) {
        console.error('Errore di connessione:', error);
      }
    }
  
    // Renderizza il carrello nella pagina
    function renderCart() {
      const cartContainer = document.querySelector('.cart-items');
      cartContainer.innerHTML = '';
  
      let subtotal = 0;
  
      cartItems.forEach(item => {
        const itemTotal = item.prezzo * item.quantita;
        subtotal += itemTotal;
        let nomeprodottocorretto = item.nome.replace(/\s+/g, '');
        const itemElement = document.createElement('div');
        itemElement.className = 'cart-item';
        itemElement.dataset.id = item.id;
        itemElement.innerHTML = `
          <img src= "../immagini/${nomeprodottocorretto}.jpg" alt="${item.nome}">
          <div class="item-details">
            <h3>${item.nome}</h3>
            <span class="item-price">${item.prezzo.toFixed(2)}€</span>
          </div>
          <div class="quantity-controls">
            <button onclick="updateQuantity(${item.id}, -1)">-</button>
            <span>${item.quantita}</span>
            <button onclick="updateQuantity(${item.id}, 1)">+</button>
          </div>
          <button class="remove-item" onclick="removeItem(${item.id})">
            <i class="fas fa-trash"></i>
          </button>
        `;
        cartContainer.appendChild(itemElement);
      });
  
      // Aggiorna i totali
      document.querySelector('.summary-row span:last-child').textContent = subtotal.toFixed(2) + '€';
      document.querySelector('.total span:last-child').textContent = subtotal.toFixed(2) + '€';
    }
  
    // Aggiorna la quantità di un articolo
    async function updateQuantity(productId, change) {
      try {
        const response = await fetch(`../php/backend_carrello.php?action=updateQuantity&id=${productId}&change=${change}`);
        const data = await response.json();
        
        if(data.success) {
          await loadCartFromServer();
          renderCart();
        } else {
          alert('Errore: ' + data.message);
        }
      } catch (error) {
        console.error('Errore:', error);
      }
    }
  
    // Rimuove un articolo dal carrello
    async function removeItem(productId) {
      try {
        const response = await fetch(`../php/backend_carrello.php?action=removeItem&id=${productId}`);
        const data = await response.json();
        
        if(data.success) {
          await loadCartFromServer();
          renderCart();
        } else {
          alert('Errore: ' + data.message);
        }
      } catch (error) {
        console.error('Errore:', error);
      }
    }
    async function addToCart(productId) {
    try {
        const response = await fetch(`../php/backend_carrello.php?action=addToCart&id=${productId}`);
        const data = await response.json();
        
        if(data.success) {
            await loadCartFromServer();
            renderCart();
        }
    } catch (error) {
        console.error('Errore:', error);
    }
}
  </script>
  
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

</body>
</html>