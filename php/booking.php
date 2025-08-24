<?php
require 'db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$service = $data['service'] ?? '';
$date = $data['date'] ?? '';
$time = $data['time'] ?? '';
$name = $data['name'] ?? '';
$phone = $data['phone'] ?? '';
$address = $data['address'] ?? '';

if (!$service || !$date || !$time || !$name || !$phone || !$address) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO bookings (service, date, time, name, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$service, $date, $time, $name, $phone, $address]);

echo json_encode(['status' => 'success', 'message' => 'Booking successful']);
?>
