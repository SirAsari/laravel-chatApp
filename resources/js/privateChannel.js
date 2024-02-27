import Echo from 'laravel-echo';
const chatId = 1;

Window.Echo.private(`chats.${chatId}`)
    .listen('.message.sent', (e) => {
        console.log(e.message, e.sentBy);
    });