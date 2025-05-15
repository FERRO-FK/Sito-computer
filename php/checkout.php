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
  <title>Tecno shop - Checkout</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/styles_navbar.css">
  <link rel="stylesheet" href="../css/styles_checkout.css">
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
      <a href="../html/carrello.php"><i class="fas fa-shopping-cart"></i> Carrello</a>
      <a href="../php/login.php"><i class="fas fa-user"></i> Login</a>
    </div>
  </div>

  <div class="checkout-container">
    <h1><i class="fas fa-shopping-bag"></i> Procedi all'acquisto</h1>
    
    <div class="checkout-grid">
      <!-- Sezione Informazioni di Spedizione -->
      <section class="checkout-section">
        <h2><i class="fas fa-truck"></i> Informazioni di spedizione</h2>
        
        <form id="shipping-form">
          <div class="form-group">
            <label for="nome">Nome completo</label>
            <input type="text" id="nome" name="nome" value="<?php echo isset($user['nome']) ? htmlspecialchars($user['nome']) : ''; ?>" required>
          </div>
          
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo isset($user['mail']) ? htmlspecialchars($user['mail']) : ''; ?>" required>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="via">Via</label>
              <input type="text" id="via" name="via" value="<?php echo isset($user['via']) ? htmlspecialchars($user['via']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
              <label for="civico">Numero civico</label>
              <input type="text" id="civico" name="civico" value="<?php echo isset($user['numerocivico']) ? htmlspecialchars($user['numerocivico']) : ''; ?>" required>
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="citta">Città</label>
              <input type="text" id="citta" name="citta" value="<?php echo isset($user['citta']) ? htmlspecialchars($user['citta']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
              <label for="cap">CAP</label>
              <input type="text" id="cap" name="cap" pattern="\d{5}" required>
            </div>
          </div>
          
          <div class="form-group">
            <label for="provincia">Provincia</label>
            <input type="text" id="provincia" name="provincia" maxlength="2" required>
          </div>
          
          <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="tel" id="telefono" name="telefono" pattern="[0-9]{10}" required>
          </div>
        </form>
      </section>
      
      <!-- Sezione Metodo di Pagamento -->
      <section class="checkout-section">
        <h2><i class="fas fa-credit-card"></i> Metodo di pagamento</h2>
        
        <div class="payment-methods">
          <div class="payment-method active" data-method="credit">
            <i class="far fa-credit-card"></i> Carta di credito
          </div>
          <div class="payment-method" data-method="paypal">
            <i class="fab fa-paypal"></i> PayPal        
          </div>
        </div>
        
        <div class="payment-details" id="credit-card-details">
          <div class="form-group">
            <label for="card-number">Numero carta</label>
            <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456" pattern="[\d ]{16,19}" required>
          </div>
          
          <div class="form-row">
            <div class="form-group">
              <label for="card-expiry">Scadenza</label>
              <input type="text" id="card-expiry" name="card-expiry" placeholder="MM/AA" pattern="\d{2}/\d{2}" required>
            </div>
            
            <div class="form-group">
              <label for="card-cvv">CVV</label>
              <input type="text" id="card-cvv" name="card-cvv" placeholder="123" pattern="\d{3}" required>
            </div>
          </div>
          
          <div class="form-group">
            <label for="card-name">Nome sulla carta</label>
            <input type="text" id="card-name" name="card-name" required>
          </div>
        </div>
        
        <div class="payment-details" id="paypal-details" style="display: none;">
          <p>Sarai reindirizzato a PayPal per completare il pagamento</p>
          <a href="https://www.paypal.com/pool/9eM0UbGYoC?sr=accr"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" alt="PayPal"></a>
          
        </div>
      </section>
      
      <!-- Sezione Riepilogo Ordine -->
      <section class="order-summary">
        <h2><i class="fas fa-receipt"></i> Riepilogo ordine</h2>
        
        <div class="summary-items">
          <div class="summary-item">
            <img src="../immagini/PC Gaming.jpg" alt="PC Gaming">
            <div class="item-details">
              <h3>PC Gaming</h3>
              <p>1 x €899,00</p>
            </div>
          </div>
          
          <div class="summary-item">
            <img src="../immagini/notebook-ufficio.jpg" alt="Notebook Ufficio">
            <div class="item-details">
              <h3>Notebook da ufficio</h3>
              <p>1 x €499,00</p>
            </div>
          </div>
        </div>
        
        <div class="summary-totals">
          <div class="summary-row">
            <span>Subtotale</span>
            <span>€1.398,00</span>
          </div>
          <div class="summary-row">
            <span>Spedizione</span>
            <span>€9,99</span>
          </div>
          <div class="summary-row total">
            <span>Totale</span>
            <span>€1.407,99</span>
          </div>
        </div>
        
        <div class="coupon-form">
          <input type="text" placeholder="Codice sconto">
          <button class="apply-btn">Applica</button>
        </div>
        
        <button class="checkout-btn" onclick="processPayment()">
          <i class="fas fa-lock"></i> Completa l'ordine
        </button>
        
        <p class="secure-checkout">
          <i class="fas fa-shield-alt"></i> Pagamento sicuro con crittografia SSL
        </p>
      </section>
    </div>
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

  <script>
    // Cambio metodo di pagamento
    document.querySelectorAll('.payment-method').forEach(method => {
      method.addEventListener('click', function() {
        document.querySelectorAll('.payment-method').forEach(m => m.classList.remove('active'));
        this.classList.add('active');
        
        document.querySelectorAll('.payment-details').forEach(d => d.style.display = 'none');
        document.getElementById(this.dataset.method + '-details').style.display = 'block';
      });
    });
    
    // Formattazione numero carta
    document.getElementById('card-number').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\s+/g, '');
      if (value.length > 0) {
        value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
      }
      e.target.value = value;
    });
    
    // Formattazione data scadenza
    document.getElementById('card-expiry').addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.length > 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
      }
      e.target.value = value;
    });
    
    function processPayment() {
      // Validazione del form
      const forms = document.querySelectorAll('form');
      let isValid = true;
      
      forms.forEach(form => {
        const inputs = form.querySelectorAll('input[required]');
        inputs.forEach(input => {
          if (!input.value) {
            input.classList.add('error');
            isValid = false;
          } else {
            input.classList.remove('error');
          }
        });
      });
      
      if (isValid) {
        alert('Pagamento elaborato con successo! Grazie per il tuo acquisto.');
        // Qui andrebbe il codice per inviare i dati al server
      } else {
        alert('Per favore completa tutti i campi obbligatori.');
      }
    }
  </script>
</body>
</html>