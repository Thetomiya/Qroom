        const channelUrl = 'https://t.me/qroom_game';
        const serverUrl = 'subscribe-check.php';
        const subscribeTaskBtn = document.getElementById('subscribe-task-btn');
        
        // Обработчик нажатия на кнопку
        subscribeTaskBtn.addEventListener('click', function() {
            if (subscribeTaskBtn.innerText === 'Подписаться') {
                // Открываем канал в новой вкладке
        function isMobileDevice() {
            return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        }

    if (isMobileDevice()) {
        window.open(channelUrl, '_blank');
        
    } else {
        tgWebApp.openTelegramLink(channelUrl);
    }
                
                subscribeTaskBtn.innerText = 'Проверить';
            } else if (subscribeTaskBtn.innerText === 'Проверить') {
                // Показываем кружок загрузки
                subscribeTaskBtn.innerHTML = '<span class="d-flex"><div class="loading-spinner"></div> Проверка...</span>';

                // Проверяем подписку пользователя на канал
                checkSubscription(tgUserId, function(isSubscribed) {
                    if (isSubscribed) {
                        // Если пользователь подписан, меняем текст кнопки на "подписан"
                        subscribeTaskBtn.innerHTML = 'Подписан';
                        subscribeTaskBtn.classList.add('task-btn-done');
                    } else {
                        // Если пользователь не подписан, возвращаем текст "проверить"
                        subscribeTaskBtn.innerHTML = 'Проверить';
                    }
                });
            }
        });

        // Функция для проверки подписки пользователя на канал
        function checkSubscription(userId, callback) {
            fetch(serverUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ userId })
            })
            .then(response => response.json())
            .then(data => {
                callback(data.isSubscribed);
            })
            .catch(error => {
                console.error('Error:', error);
                callback(false);
            });
        }