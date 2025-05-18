<?php
session_start();
require '../php/db.php';
$username = "Login";

if (!isset($_SESSION['utente_id'])) {
    header("Location: ../php/login.php");
    exit;
}

if ($_SESSION['carrello'] == []){
  header("Location: ../php/carrello.php");
}

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
      <a href="../php/index.php"><i class="fas fa-home"></i> Home</a>
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
        
        <div class="payment-options">
          <label class="payment-option selected">
            <div class="payment-option-header">
              <input type="radio" name="payment-method" value="credit" checked>
              <i class="far fa-credit-card"></i>
              <h3>Carta di credito</h3>
            </div>
            
            <div class="payment-details">
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
          </label>
          
          <label class="payment-option">
            <div class="payment-option-header">
              <input type="radio" name="payment-method" value="paypal">
              <i class="fab fa-paypal"></i>
              <h3>PayPal</h3>
            </div>
            
            <div class="payment-details">
              <p>Sarai reindirizzato a PayPal per completare il pagamento</p>
              <a href="https://www.paypal.com/pool/9eM0UbGYoC?sr=accr"><img src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_37x23.jpg" alt="PayPal"></a>
            </div>
          </label>
        </div>
      </section>
      
      <!-- Sezione Riepilogo Ordine -->
      <?php

require_once 'db.php';

$carrello = $_SESSION['carrello'] ?? [];
$prodotti = [];
$totale = 0;
$spedizione = 9.99;

if (!empty($carrello)) {
    $placeholders = implode(',', array_fill(0, count($carrello), '?'));
    $stmt = $pdo->prepare("SELECT idprodotto, nome, prezzo FROM computer WHERE idprodotto IN ($placeholders)");
    $stmt->execute(array_keys($carrello));
    $prodotti = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<section class="order-summary">
  <h2><i class="fas fa-receipt"></i> Riepilogo ordine</h2>

  <div class="summary-items">
    <?php foreach ($prodotti as $prodotto): 
        $id = $prodotto['idprodotto'];
        $quantita = $carrello[$id];
        $subtotaleProdotto = $quantita * $prodotto['prezzo'];
        $totale += $subtotaleProdotto;
        $imgFile = str_replace(' ', '', $prodotto['nome']) . '.jpg';
    ?>
    <div class="summary-item">
      <img src="../immagini/<?= htmlspecialchars($imgFile) ?>" alt="<?= htmlspecialchars($prodotto['nome']) ?>">
      <div class="item-details">
        <h3><?= htmlspecialchars($prodotto['nome']) ?></h3>
        <p><?= $quantita ?> x €<?= number_format($prodotto['prezzo'], 2, ',', '.') ?></p>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <div class="summary-totals">
    <div class="summary-row">
      <span>Subtotale</span>
      <span>€<?= number_format($totale, 2, ',', '.') ?></span>
    </div>
    <div class="summary-row">
      <span>Spedizione</span>
      <span>€<?= number_format($spedizione, 2, ',', '.') ?></span>
    </div>
    <div class="summary-row total">
      <span>Totale</span>
      <span>€<?= number_format($totale + $spedizione, 2, ',', '.') ?></span>
    </div>
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
    // Minimale JavaScript per la selezione del metodo di pagamento
    document.addEventListener('DOMContentLoaded', function() {
      const paymentOptions = document.querySelectorAll('.payment-option');
      
      paymentOptions.forEach(option => {
        option.addEventListener('click', function() {
          // Rimuovi la classe selected da tutte le opzioni
          paymentOptions.forEach(opt => opt.classList.remove('selected'));
          
          // Aggiungi la classe selected all'opzione cliccata
          this.classList.add('selected');
          
          // Seleziona il radio button corrispondente
          const radio = this.querySelector('input[type="radio"]');
          radio.checked = true;
        });
      });
    });
    

    function processPayment() {
        // Prima verifica i campi di spedizione
        if (!validateShippingInfo()) {
            return;
        }
        
        const method = document.querySelector('input[name="payment-method"]:checked').value;
        
        if (method === 'credit' && !validateCreditCard()) {
          return; // Blocca se la carta non è "valida"
        }
        
        window.location.href = "../php/grazie_per_acquisto.php"
    }
    
    function validateShippingInfo() {
        const shippingFields = [
            {id: 'cap', name: 'CAP'},
            {id: 'provincia', name: 'Provincia'},
            {id: 'telefono', name: 'Telefono'}
        ];

        for (let field of shippingFields) {
            const value = document.getElementById(field.id).value.trim();
            if (value === '') {
                alert(`Il campo ${field.name} è obbligatorio`);
                return false;
            }
        }

        return true;
    }
    
    function validateCreditCard() {
      const fields = [
        {id: 'card-number', name: 'Numero carta', min: 16},
        {id: 'card-expiry', name: 'Scadenza', min: 5}, // MM/AA
        {id: 'card-cvv', name: 'CVV', min: 3},
        {id: 'card-name', name: 'Nome titolare', min: 2}
      ];

      for (let field of fields) {
        const value = document.getElementById(field.id).value.trim();
        if (value.length < field.min) {
          alert(`${field.name} non valido`);
          return false;
        }
      }

      return true; // Tutti i campi sono pieni
    }
  </script>
</body>
</html>
message.txt
13 KB