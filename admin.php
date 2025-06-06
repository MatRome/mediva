<?php
header('Content-Type: application/json');

$host = 'localhost';
$db   = 'scrubsy';
$user = 'root';
$pass = ''; // domyślnie w XAMPP hasło jest puste
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Pobierz zamówienia wraz z produktami
    $stmt = $pdo->query("SELECT 
                            o.id AS order_id,
                            o.imie_nazwisko,
                            o.email,
                            o.adres,
                            o.data_zamowienia,
                            p.nazwa,
                            p.rozmiar,
                            p.kolor,
                            p.cena,
                            oi.ilosc
                        FROM orders o
                        JOIN order_items oi ON o.id = oi.zamowienie_id
                        JOIN products p ON p.id = oi.produkt_id
                        ORDER BY o.data_zamowienia DESC");

    $results = $stmt->fetchAll();

    // Grupowanie produktów po zamówieniu
    $orders = [];
    foreach ($results as $row) {
        $orderId = $row['order_id'];

        if (!isset($orders[$orderId])) {
            $orders[$orderId] = [
                'id' => $orderId,
                'imie_nazwisko' => $row['imie_nazwisko'],
                'email' => $row['email'],
                'adres' => $row['adres'],
                'data_zamowienia' => $row['data_zamowienia'],
                'produkty' => []
            ];
        }

        $orders[$orderId]['produkty'][] = [
            'nazwa' => $row['nazwa'],
            'rozmiar' => $row['rozmiar'],
            'kolor' => $row['kolor'],
            'cena' => $row['cena'],
            'ilosc' => $row['ilosc']
        ];
    }

    echo json_encode(array_values($orders));

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Błąd połączenia z bazą danych: ' . $e->getMessage()]);
    exit;
}