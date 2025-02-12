<?php
include('db.php');

// Устанавливаем заголовок Content-Type для JSON
header('Content-Type: application/json');

// Проверяем, был ли отправлен POST-запрос
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из POST-запроса
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Проверяем, что адрес и tgUserId были переданы
    if (isset($data['address']) && isset($data['tgUserId'])) {
        $tgUserId = htmlspecialchars($data['tgUserId']);
        $address = htmlspecialchars($data['address']);

        
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM `betaAccessUsersList` WHERE tonWallet = :address OR telegramUserId = :telegramUserId");
        $stmt->bindParam(':telegramUserId', $tgUserId);
        $stmt->bindParam(':address', $address);
        $stmt->execute();
    
        $count = $stmt->fetchColumn();
    
        if ($count > 0) {
            echo json_encode(['status' => 'error', 'message' => 'Address or tgUserId already used']);
        } else {
            try {
                // Подготовка и выполнение запроса
                $stmt = $pdo->prepare("INSERT INTO `betaAccessUsersList` (telegramUserId, tonWallet) VALUES (:telegramUserId, :address)");
                $stmt->bindParam(':telegramUserId', $tgUserId);
                $stmt->bindParam(':address', $address);
                $stmt->execute();
                
                // Возвращаем успешный ответ
                echo json_encode(['status' => 'success', 'address' => $address, 'tgUserId' => $tgUserId]);
            } catch (PDOException $e) {
                // Обработка ошибок базы данных
                echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
            }
        }
        
        
    } else {
        // Если адрес или tgUserId не были переданы
        echo json_encode(['status' => 'error', 'message' => 'Address or tgUserId not provided']);
    }
} else {
    // Если запрос не является POST
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>