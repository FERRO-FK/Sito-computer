<?php
session_start();
header('Content-Type: application/json');

// Configurazione CORS per sviluppo
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");



// Connessione al database
require_once 'db.php';


// Inizializza il carrello se non esiste
if (!isset($_SESSION['carrello'])) {
    $_SESSION['carrello'] = [];
}

$carrello = $_SESSION['carrello'];
$prodotti = [];


$stmt = $pdo->query("SELECT idprodotto AS id, nome, prezzo FROM computer");
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($result as $r) {
    $prodotti[$r['id']] = [
        'id' => $r['id'],
        'nome' => $r['nome'],
        'prezzo' => (float) $r['prezzo']
    ];
}






$action = $_GET['action'] ?? '';

switch ($action) {
    case 'addToCart':
        addToCart();
        break;
        
    case 'getCart':
        getCart();
        break;
        
    case 'updateQuantity':
        updateQuantity();
        break;
        
    case 'removeItem':
        removeItem();
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Azione non valida']);
}

function addToCart() {
    global $prodotti;
    
    $id = (int)($_GET['id'] ?? 0);
    
    if (!isset($prodotti[$id])) {
        echo json_encode(['success' => false, 'message' => 'Prodotto non trovato']);
        return;
    }
    
    // Aggiungi il prodotto al carrello o incrementa la quantità
    if (!isset($_SESSION['carrello'][$id])) {
        $_SESSION['carrello'][$id] = 1;
    } else {
        $_SESSION['carrello'][$id]++;
    }
    
    // Restituisci anche i dati aggiornati del carrello
    getCart();
}

function getCart() {
    global $prodotti;
    
    $cartItems = [];
    $totale = 0.0;
    $count = 0;
    
    foreach ($_SESSION['carrello'] as $id => $quantita) {
        if (isset($prodotti[$id])) {
            $prodotto = $prodotti[$id];
            $subtotale = $prodotto['prezzo'] * $quantita;
            
            $cartItems[] = [
                'id' => $prodotto['id'],
                'nome' => $prodotto['nome'],
                'prezzo' => $prodotto['prezzo'],
                'quantita' => $quantita,
                'subtotale' => $subtotale
            ];
            
            $totale += $subtotale;
            $count += $quantita;
        }
    }
    
    echo json_encode([
        'success' => true,
        'cartItems' => $cartItems,
        'totale' => $totale,
        'count' => $count // Nuovo campo per il contatore totale
    ]);
}

function updateQuantity() {
    global $prodotti;
    
    $id = (int)($_GET['id'] ?? 0);
    $change = (int)($_GET['change'] ?? 0);
    
    if (!isset($prodotti[$id])) {
        echo json_encode(['success' => false, 'message' => 'Prodotto non trovato']);
        return;
    }
    
    if (!isset($_SESSION['carrello'][$id])) {
        $_SESSION['carrello'][$id] = 1;
    } else {
        $_SESSION['carrello'][$id] += $change;
        
        // Impedisce quantità negative
        if ($_SESSION['carrello'][$id] < 1) {
            $_SESSION['carrello'][$id] = 1;
        }
    }
    
    // Restituisci i dati aggiornati del carrello
    getCart();
}

function removeItem() {
    $id = (int)($_GET['id'] ?? 0);
    
    if (isset($_SESSION['carrello'][$id])) {
        unset($_SESSION['carrello'][$id]);
    }
    
    // Restituisci i dati aggiornati del carrello
    getCart();
}
?>