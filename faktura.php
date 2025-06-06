<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ładuje zarówno PHPMailer, jak i mPDF
require 'config.php'; // Zawiera SMTP_USER i SMTP_PASS

// Debug lokalny (opcjonalnie)
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

header('Content-Type: application/json');
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['email'])) {
    http_response_code(400);
    echo json_encode(["success" => false, "message" => "Brak danych wejściowych"]);
    exit;
}

$name = htmlspecialchars($data["name"]);
$email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
$address = htmlspecialchars($data["address"]);
$phone = htmlspecialchars($data["phone"]);
$products = $data["products"];
$total = $data["total"];
$paymentMethod = htmlspecialchars($data["paymentMethod"]);

if (!$email) {
    echo json_encode(["success" => false, "message" => "Nieprawidłowy e-mail"]);
    exit;
}

// 🔸 Generowanie HTML faktury
$datetime = date('d.m.Y H:i'); // np. 15.05.2025 14:23
$logoPath = __DIR__ . '/img/logo.jpg';
$logoPath = str_replace('\\', '/', realpath($logoPath)); // dla Windows
$html = "<img src='file://$logoPath' style='height: 240px;'><br>";

$html .= "<h1>Faktura – Mediva Wear</h1>"; // Użyj .= zamiast = !!!
$html .= "<p><strong>Data i godzina wystawienia:</strong> $datetime</p>";
$html .= "<p><strong>Imię i nazwisko:</strong> $name<br>";
$html .= "<strong>Telefon:</strong> $phone<br>";
$html .= "<strong>Adres dostawy:</strong> $address</p>";
$html .= "<strong>Metoda płatności:</strong> $paymentMethod</p>";
$html .= "<table border='1' cellpadding='8' cellspacing='0' width='100%'>";
$html .= "<tr><th>Produkt</th><th>Rozmiar</th><th>Ilość</th><th>Cena</th></tr>";


foreach ($products as $p) {
    $linePrice = number_format($p['price'] * $p['quantity'], 2);
    $html .= "<tr>
        <td>{$p['name']}</td>
        <td>{$p['size']}</td>
        <td>{$p['quantity']}</td>
        <td>{$linePrice} zł</td>
    </tr>";
}

$html .= "</table><br><strong>Razem: " . number_format($total, 2) . " zł</strong>";

// 🔸 Generowanie PDF jako string
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$pdfContent = $mpdf->Output('', 'S');

// 🔸 Wysyłka e-maila do klienta i do właściciela
try {
    // Mail do klienta
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = SMTP_USER;
    $mail->Password   = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';
    $mail->Encoding   = 'base64';

    $mail->setFrom(SMTP_USER, 'Mediva Store');
    $mail->addAddress($email);
    $mail->Subject = "Faktura za zamówienie – Mediva Wear";
    $mail->Body    = "Dziękujemy za zamówienie, $name! W załączniku znajdziesz fakturę PDF.";
    $mail->addStringAttachment($pdfContent, 'faktura.pdf');
    $mail->send();

    // Mail do właściciela
    $adminMail = new PHPMailer(true);
    $adminMail->isSMTP();
    $adminMail->Host       = 'smtp.gmail.com';
    $adminMail->SMTPAuth   = true;
    $adminMail->Username   = SMTP_USER;
    $adminMail->Password   = SMTP_PASS;
    $adminMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $adminMail->Port       = 587;
    $adminMail->CharSet    = 'UTF-8';

    $adminMail->setFrom(SMTP_USER, 'Mediva Store');
    $adminMail->addAddress(SMTP_USER);
    $adminMail->Subject = "Nowe zamówienie od $name";

    $adminBody = "<p><strong>Klient:</strong> $name<br>
    <strong>Email:</strong> $email<br>
    <strong>Telefon:</strong> $phone<br>
    <strong>Adres:</strong> $address</p><ul>";

    foreach ($products as $p) {
        $adminBody .= "<li>{$p['quantity']}× {$p['name']} ({$p['size']})</li>";
    }

    $adminBody .= "</ul><p><strong>Suma:</strong> " . number_format($total, 2) . " zł</p>";
    $adminMail->isHTML(true);
    $adminMail->Body = $adminBody;
    $adminMail->send();

    echo json_encode(["success" => true]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Mailer Error: " . $e->getMessage()]);
}


