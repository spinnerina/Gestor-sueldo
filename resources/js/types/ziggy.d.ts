// resources/js/types/ziggy.d.ts


// Declara la variable global Ziggy que es inyectada por @routes
declare const Ziggy: {
    url: string;
    port: number | null;
    defaults: Record<string, string | number>;
    routes: {
        [name: string]: {
            uri: string;
            methods: string[];
            bindings?: Record<string, string>;
            wheres?: Record<string, string>;
            domain?: string;
        };
    };
};

// Extiende las propiedades globales de Vue para incluir la función `route`
// Esto es para que puedas usar `this.route()` en opciones API o `route()` en composición API
import { Config, Router } from 'ziggy-js'; // Importa los tipos necesarios de ziggy-js

declare module '@vue/runtime-core' {
    interface ComponentCustomProperties {
        route: ((name: string, params?: Config | undefined, absolute?: boolean) => string) & Router;
    }
}