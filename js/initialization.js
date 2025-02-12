window.addEventListener('load', function() {

    if (window.Telegram.WebApp && window.Telegram.WebApp.initDataUnsafe && window.Telegram.WebApp.initDataUnsafe.user && window.Telegram.WebApp.initDataUnsafe.user.id) {
        let tgWebApp = window.Telegram.WebApp;
        let tgUserId = tgWebApp.initDataUnsafe.user.id;
        if (tgUserId !== 358487794 && tgUserId !== 551162498) {
            window.location.href = 'error.php';
        }

    } else {
        window.location.href = 'error.php';
    }

    const initData = Telegram.WebApp.initData; 
    
    fetch('process_initdata.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ initData: initData })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Success:', data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });


    checkSubscription(tgWebApp.initDataUnsafe.user.id, function(isSubscribed) {
        if (isSubscribed) {
            subscribeTaskBtn.innerText = 'Подписан';
            subscribeTaskBtn.classList.add('task-btn-done');
        } else {
            subscribeTaskBtn.innerText = 'Подписаться';
        }
    });
});
const tgWebApp = window.Telegram.WebApp;
const tgUserId = tgWebApp.initDataUnsafe.user.id;
console.log(window.Telegram.WebApp.initData);




document.cookie = `telegramUserId=${tgUserId}; path=/; max-age=2000000`; 

    

