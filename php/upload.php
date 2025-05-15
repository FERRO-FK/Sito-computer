<?php
$targetDir = __DIR__ . '/../immagini/';
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $filename = basename($file["name"]);
    $targetFile = $targetDir . $filename;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Controlli base
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed)) {
        die("Errore: solo file JPG, JPEG, PNG, GIF sono ammessi.");
    }

    if ($file["size"] > 5 * 1024 * 1024) { // 5MB max
        die("Errore: l'immagine è troppo grande.");
    }

    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        echo "Immagine caricata con successo: <a href='$targetFile'>$filename</a>";
    } else {
        echo "Errore durante il caricamento.";
    }
} else {
    echo "Nessun file ricevuto.";
}
?>