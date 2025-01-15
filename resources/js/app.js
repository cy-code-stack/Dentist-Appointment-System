import './bootstrap';
import router from './routes/index.js';
import { createApp } from 'vue';

// import Echo from 'laravel-echo';
// import Pusher from 'pusher-js';

// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: '03b2f532ecf413dd3847',
//     cluster: 'ap1',      
//     forceTLS: true,
// });

createApp(app).use(router).mount("#app");