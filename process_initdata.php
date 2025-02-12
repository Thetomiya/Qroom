<?php

// Функция для записи логов в файл
function logToFile($message) {
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents('debug.log', "[$timestamp] $message" . PHP_EOL, FILE_APPEND);
}

// Записываем начало выполнения скрипта
logToFile("Запущен скрипт process_initdata.php");

// Получаем данные из POST-запроса
$data = json_decode(file_get_contents('php://input'), true);
logToFile("Полученные данные: " . print_r($data, true));

// Проверяем, есть ли initData
if (isset($data['initData'])) {
    $initData = $data['initData'];
    logToFile("initData: $initData");

    // Здесь вы можете вызвать функцию для валидации и извлечения ID пользователя
    $botToken = "7990085599:AAGV_GVBUU4sL34XAkRL5bvcse9_Tm3H-cM"; // Замените на ваш токен
    try {
        $userId = validateInitData($initData, $botToken);
        logToFile("ID пользователя: $userId");
        
        // Возвращаем успешный ответ
        echo json_encode(['userId' => $userId]);
    } catch (Exception $e) {
        logToFile("Ошибка: " . $e->getMessage());
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    logToFile("Ошибка: initData не предоставлена");
    echo json_encode(['error' => 'initData not provided']);
}

// Функция для валидации initData
function validateInitData($initData, $botToken) {
    // Разделяем initData на параметры
    parse_str($initData, $params);
    
    // Проверяем, есть ли хеш
    if (!isset($params['hash'])) {
        throw new Exception("Hash not found in initData");
    }

    // Формируем строку проверки данных
    ksort($params); // Сортируем параметры по ключам
    $dataCheckString = '';
    foreach ($params as $key => $value) {
        if ($key !== 'hash') {
            $dataCheckString .= "$key=$value\n";
        }
    }
    logToFile("data checking str: $dataCheckString");
    // Создаем секретный ключ
    $secretKey = hash_hmac('sha256', $botToken . "WebAppData", true);
    
    // Проверяем хеш
    $hashReceived = $params['hash'];
    $hashCalculated = hash_hmac('sha256', $dataCheckString, $secretKey);

    // Логируем хеши
    logToFile("Hash Received: $hashReceived");
    logToFile("Hash Calculated: " . $hashCalculated);

    // Сравниваем хеши
    if (hash_equals($hashReceived, $hashCalculated)) {
        // Данные валидны, извлекаем ID пользователя
        $userData = json_decode($params['user'], true);
        return $userData['id']; // Получаем ID пользователя
    } else {
        throw new Exception("Invalid data received");
    }
}

?>