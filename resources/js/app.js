import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import moment from 'moment';

moment.locale('pt-br');

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({el, App, props, plugin}) {
        const appVue =  createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            //.mount(el);

        appVue.config.globalProperties.$filters = {
            formatDate(value) {
                if(value){
                    return moment(value).format('DD/MM/YYYY HH:mm');
                }
            }
        }
        appVue.mount(el);
        //return appVue;
    },
    progress: {
        color: '#4B5563',
    },
});
