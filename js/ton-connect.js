const tonConnectUI = new TON_CONNECT_UI.TonConnectUI({
        manifestUrl: 'https://qroom.space/tonconnect-manifest.json',
        buttonRootId: 'ton-connect'
    });
    

    function connectToWallet() {
        if(tonConnectUI.wallet) {
            const address = tonConnectUI.wallet.account.address;

            
            // Отправляем адрес на сервер
            fetch('sign-up.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ address: address, tgUserId: tgUserId })
})
.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
})
.then(data => {
    console.log('Message:', data.status);

    if (data.status === 'error') {
        window.location.replace("error-already-used.php");
    } else if (data.status === 'success') {
        window.location.reload();
    }
    
})
.catch((error) => {
    console.error('Error:', error);

});
            
        } else {
            async function connectToWallet() {
                const connectedWallet = await tonConnectUI.connectWallet();
            }
            connectToWallet();
        }
    }

    document.getElementById('sign-up-task').addEventListener('click', connectToWallet);