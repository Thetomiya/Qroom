

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/logo.svg" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <title>QRoom</title>
</head>
<script src="https://telegram.org/js/telegram-web-app.js"></script>
<script src="https://unpkg.com/@tonconnect/ui@latest/dist/tonconnect-ui.min.js"></script>
<script src="js/initialization.js"></script>
<body class="scrollable normal-bg">
<main>
    <div class="container">
        <div class="row">
            <div class="form-container mb-4 mx-auto text-center d-flex flex-column">
                <img src="img/logo-no-bg.svg" alt="logo" class="non-selectable mx-auto mb-2">
                <h1 class="pink-title" id="pink-title">QRoom</h1>
                <p class="semi-opacity-text" id="title-about">
                    Разгадывай загадки, собирай NFT, зарабатывай токены!
                </p>
                <div class="advantages-container row d-flex">
                    <div class="advantage col-4">
                        <img src="img/key.svg" alt="key" class="non-selectable mx-auto mb-2">
                        <p id="advantage-1">NFT-Ключи</p>
                    </div>
                    <div class="advantage col-4">
                        <img src="img/lock.svg" alt="lock" class="non-selectable mx-auto mb-2">
                        <p id="advantage-2">Уникальные комнаты</p>
                    </div>
                    <div class="advantage col-4">
                        <img src="img/coins.svg" alt="coins" class="non-selectable mx-auto mb-2">
                        <p id="advantage-3">Крипто награды</p>
                    </div>
                </div>
                <p class="demi-opacity-text" id="game-description">
                    Погрузитесь в мир загадочных комнат, где каждая дверь открывает новые возможности! Используй NFT для доступа к эксклюзивным локациям и собирай ценные награды.
                </p>

                <?php 
                    include('db.php');
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM `betaAccessUsersList`");
                    $stmt->execute();
                    $totalCount = $stmt->fetchColumn();
                ?>


                <div class="participants-count-container mx-auto">
                    <span class="demi-opacity-text m-0" id="participants-count">Всего заявок:</span> <span class="demi-opacity-text"><?=$totalCount?></span>
                </div>



            <?php 
                $tgUserId = $_COOKIE['telegramUserId'];
                $stmt = $pdo->prepare("SELECT COUNT(*) FROM `betaAccessUsersList` WHERE telegramUserId = :telegramUserId");
                $stmt->bindParam(':telegramUserId', $tgUserId);
                $stmt->execute();
                $count = $stmt->fetchColumn();
                if ($count > 0) {
                    $isParticipant = true;
                } else {
                    $isParticipant = false;
                }
                if ($isParticipant): ?>
                    <p>Вы подали заявку на участие</p>
                <?php else: ?>
                    <a class="mx-auto mb-2" id="subscribe-task">
                        <div class="task-btn-container">
                            <span>Подписка на канал</span>
                            <div id="subscribe-task-btn" class="task-btn">Подписаться</div>
                        </div>
                    </a>
                    <a class="mx-auto mb-2" id="connect-task">
                        <div class="task-btn-container">
                            <span>Кошелёк</span>
                            <div class="connect-task-btn" id="connect-task-btn"><div id="ton-connect" class="connect-btn-custom"></div></div>
                        </div>
                    </a>
                    <a class="mx-auto" id="sign-up-task">
                        <div class="sign-up-btn" id="sign-up-task-btn">Записаться на бета-тест</div>
                    </a>
                    <?php endif;?>
            </div>
            
            
            <div class="custom-accordion-container">
                <div class="custom-accordion">
                    <button class="custom-accordion-button">
                        Что получат ранние участники?
                        <span class="custom-accordion-icon"></span>
                    </button>
                    <div class="custom-accordion-content">
                        <div class="custom-accordion-body">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                        </div>
                    </div>
                </div>
                <div class="custom-accordion">
                    <button class="custom-accordion-button">
                        Какой стимул в прохождении квестов?
                        <span class="custom-accordion-icon"></span>
                    </button>
                    <div class="custom-accordion-content">
                        <div class="custom-accordion-body">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                        </div>
                    </div>
                </div>
                <div class="custom-accordion">
                    <button class="custom-accordion-button">
                        Как работает система NFT в игре?
                        <span class="custom-accordion-icon"></span>
                    </button>
                    <div class="custom-accordion-content">
                        <div class="custom-accordion-body">
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p>
                        </div>
                    </div>
                </div>
            </div>
        


    




        </div>
    </div>
</main>

<script src='js/language-script.js'></script>
<?php if (!$isParticipant): ?>
    <script src="js/subscribe-check.js"></script>
    <script type="module" src="js/ton-connect.js"></script> 
<?php endif;?>
<script>
    document.querySelectorAll('.custom-accordion-button').forEach(button => {
    button.addEventListener('click', function () {
        // Закрываем все аккордеоны, кроме текущего
        document.querySelectorAll('.custom-accordion-content').forEach(content => {
            if (content !== this.nextElementSibling) {
                content.style.maxHeight = null;
                content.previousElementSibling.classList.remove('active');
            }
        });

        // Переключаем текущий аккордеон
        const content = this.nextElementSibling;
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
            this.classList.remove('active');
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
            this.classList.add('active');
        }
    });
});
</script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

