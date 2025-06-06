<?php
header('Content-Type: application/json');

// DEBUG START
file_put_contents("debug.txt", "=== START ===\n", FILE_APPEND);

// Dane do połączenia z bazą
$host = 'localhost';
$db   = 'scrubsy';
$user = 'root';
$pass = ''; // w XAMPP domyślnie puste
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$data = json_decode(file_get_contents("php://input"), true);
file_put_contents("debug.txt", "Dane wejściowe:\n" . print_r($data, true), FILE_APPEND);

// Walidacja danych
if (!isset($data['name'], $data['email'], $data['address'], $data['products']) || !is_array($data['products'])) {
    file_put_contents("debug.txt", "BŁĄD: Brak wymaganych danych!\n", FILE_APPEND);
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Brak wymaganych danych.']);
    exit;
}

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    file_put_contents("debug.txt", "Połączono z bazą\n", FILE_APPEND);

    // 1. Dodaj zamówienie
    $stmt = $pdo->prepare("INSERT INTO orders (imie_nazwisko, email, adres, status) VALUES (?, ?, ?, 'oczekujące')");
    $stmt->execute([
        htmlspecialchars($data['name']),
        filter_var($data['email'], FILTER_SANITIZE_EMAIL),
        htmlspecialchars($data['address'])
    ]);

    $orderId = $pdo->lastInsertId();
    file_put_contents("debug.txt", "Zamówienie ID: $orderId dodane\n", FILE_APPEND);

    // 2. Dodaj produkty
    $itemStmt = $pdo->prepare("INSERT INTO order_items (zamowienie_id, produkt_id, ilosc) VALUES (?, ?, ?)");

    foreach ($data['products'] as $product) {
        if (!isset($product['id'], $product['quantity'])) {
            file_put_contents("debug.txt", "Pominięto produkt z brakującym ID lub ilością\n", FILE_APPEND);
            continue;
        }

        $produktId = (int)$product['id'];
        $ilosc = (int)$product['quantity'];

        if ($produktId > 0 && $ilosc > 0) {
            $itemStmt->execute([$orderId, $produktId, $ilosc]);
            file_put_contents("debug.txt", "Dodano produkt ID $produktId, ilość $ilosc\n", FILE_APPEND);
        } else {
            file_put_contents("debug.txt", "Błąd walidacji produktu – ID: $produktId, ilość: $ilosc\n", FILE_APPEND);
        }
    }

    echo json_encode(['success' => true, 'order_id' => $orderId]);
    file_put_contents("debug.txt", "Zakończono pomyślnie\n", FILE_APPEND);

} catch (PDOException $e) {
    file_put_contents("debug.txt", "BŁĄD BAZY: " . $e->getMessage() . "\n", FILE_APPEND);
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Błąd bazy danych: ' . $e->getMessage()]);
}
?>
