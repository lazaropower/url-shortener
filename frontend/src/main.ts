import './assets/main.css';

import { createApp } from 'vue';
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router';
import ShortenedUrlHandler from './components/ShortenedUrlHandler.vue';
import UrlShortenerForm from './components/UrlShortenerForm.vue';
import NotFound404 from './components/NotFound404.vue';

const routes = [
    { path: '/', component: UrlShortenerForm},
    { path: '/404', component: NotFound404},
    { path: '/:hash', component: ShortenedUrlHandler},
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

const app = createApp(App)

app.use(router);

app.mount('#app');
