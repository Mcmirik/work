<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Метод не разрешён']);
    exit;
}

// === НАСТРОЙКИ (замените на свои!) ===
$botToken = '8241393708:AAHHHbAsjGG67AmtvNdRLx-FF5BxvU9jMUI'; // ← сюда вставьте токен от @BotFather
$chatId = '345780105';      // ← сюда вставьте ваш ID Telegram

// === Получаем данные ===
$name = htmlspecialchars($_POST['name'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$phone = htmlspecialchars($_POST['phone'] ?? '');
$message = htmlspecialchars($_POST['message'] ?? '');

if (empty($name) || empty($email)) {
    http_response_code(400);
    echo json_encode(['error' => 'Имя и email обязательны']);
    exit;
}

// === Формируем сообщение ===
$text = "📩 Новая заявка на курс!\n\n";
$text .= "👤 Имя: $name\n";
$text .= "📧 Email: $email\n";
if ($phone) $text .= "📱 Телефон: $phone\n";
if ($message) $text .= "💬 Комментарий: $message\n";

// === Отправляем в Telegram ===
$url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($text);
file_get_contents($url);

echo json_encode(['success' => true]);
?>