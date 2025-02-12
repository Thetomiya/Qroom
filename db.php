<?php
$dotenv = parse_ini_file('.env');
foreach ($dotenv as $key => $value) {
    putenv("$key=$value");
}

// Получаем переменные окружения
$botToken = getenv('BOT_TOKEN');
$channelId = getenv('CHANNEL_ID');

$servername = getenv('SERVER_NAME');
$username = getenv('USER_NAME'); 
$password = getenv('PASSWORD'); 
$dbname = getenv('DBNAME'); 

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Установить режим ошибок PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
}

?>