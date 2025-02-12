<?php
$dotenv = parse_ini_file('.env');
foreach ($dotenv as $key => $value) {
    putenv("$key=$value");
}

// Получаем переменные окружения
$botToken = getenv('BOT_TOKEN');
$channelId = getenv('CHANNEL_ID');

// Получаем данные из тела запроса
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Получаем userId из данных
$userId = $data['userId'] ?? null;


// Формируем URL для запроса к Telegram Bot API
$url = "https://api.telegram.org/bot$botToken/getChatMember?chat_id=$channelId&user_id=$userId";

// Отправляем запрос к Telegram Bot API
$response = file_get_contents($url);

// Парсим ответ
$data = json_decode($response, true);

// Проверяем статус подписки
$isSubscribed = false;
if (isset($data['result']['status'])) {
    $status = $data['result']['status'];
    $isSubscribed = $status === 'member' || $status === 'creator' || $status === 'administrator';
}

// Возвращаем результат в формате JSON
header('Content-Type: application/json');
echo json_encode(['isSubscribed' => $isSubscribed]);
?>