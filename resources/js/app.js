import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


const chatId = 1;

Echo.private(`chats.${chatId}`)
    .listen('.message.sent', (e) => {
        console.log(e.message, e.sentBy);
    });