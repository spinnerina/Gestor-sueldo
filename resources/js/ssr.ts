import { createInertiaApp } from '@inertiajs/vue3';
import createServer from '@inertiajs/vue3/server';
import { renderToString } from '@vue/server-renderer';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createSSRApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js'; // Importa ZiggyVue también para consistencia

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createServer((page) =>
    createInertiaApp({
        page,
        render: renderToString,
        title: (title) => `${title} - ${appName}`,
        resolve: (name) => resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue')),
        setup({ App, props, plugin }) {
            const app = createSSRApp({ render: () => h(App, props) });

            // Importante: La configuración de Ziggy para SSR
            // 'page.props.ziggy' contiene la información de rutas necesaria desde Laravel
            const ziggyConfig = {
                ...page.props.ziggy,
                location: new URL(page.props.ziggy.location), // Asegura que la ubicación sea un objeto URL
            };

            // Usa el plugin ZiggyVue con la configuración específica de SSR
            // Esto es más consistente con cómo lo usas en el cliente (app.ts)
            app.use(plugin);
            app.use(ZiggyVue, ziggyConfig); // Pasa ziggyConfig directamente al plugin ZiggyVue

            // Si aún necesitas `global.route` para otras partes de tu SSR (menos común con ZiggyVue)
            // if (typeof window === 'undefined') {
            //     global.route = (name: string, params?: any, absolute?: boolean) => {
            //         // Aquí debes usar la función de Ziggy Vue si la necesitas globalmente
            //         // No es lo más común hacer esto si ya usas ZiggyVue.
            //         // Si realmente lo necesitas, sería algo como app.config.globalProperties.route
            //         // o importar `route` directamente de `ziggy-js` como antes:
            //         // return ziggyRoute(name, params, absolute, ziggyConfig);
            //     };
            // }


            return app;
        },
    }),
);