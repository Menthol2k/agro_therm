require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Toast from "vue-toastification";
import { useToast } from "vue-toastification";

import 'animate.css';
import "vue-toastification/dist/index.css";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        const inertiaApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Toast)
            .component('useToast', useToast)
            .mixin({ methods: { route } });
            inertiaApp.config.globalProperties.$toast = useToast();
            inertiaApp.mount(el);
    },
});

InertiaProgress.init({ 
    color: '#FF0000',
    delay: 30,
    showSpinner: false,
});
