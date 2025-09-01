import Echo from "laravel-echo"

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    wsHost: 'socket.mediamonitor.it',
    wsPort: 80,
    wssHost: 'socket.mediamonitor.it',
    wssPort: 443,
    //encrypted: true,
    //forceTLS: false,
    disableStats: false,
    enableLogging: true,
    enabledTransports: ['ws', 'wss'],
    scheme: 'https'
});
