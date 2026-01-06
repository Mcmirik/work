<?php
if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $message = trim($_POST['message']);
    $tariff = $_POST['tariff'] ?? 'Не указан';

    // Ваш Telegram Bot Token и Chat ID
    $botToken = "ВАШ_ТОКЕН_БОТА";
    $chatId = "ВАШ_CHAT_ID";

    $text = "🔔 Новая заявка на курс!\n\n";
    $text .= "Имя: $name\n";
    $text .= "Email: $email\n";
    $text .= "Телефон: $phone\n";
    $text .= "Тариф: $tariff\n";
    $text .= "Сообщение: $message";

    // Отправка в Telegram
    $url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($text);
    file_get_contents($url);

    // Ответ пользователю
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error"]);
}
?>