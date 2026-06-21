import '../css/app.css';
import { createApp, h } from 'vue';
import type { DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { createPinia } from 'pinia';

const pages = import.meta.glob<{ default: DefineComponent }>('./Pages/**/*.vue', { eager: true });

createInertiaApp({
  resolve: (name) => {
    const page = pages[`./Pages/${name}.vue`];

    if (!page) {
      throw new Error(`Unknown Inertia page: ${name}`);
    }

    return page;
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });
    app.use(plugin);
    app.use(createPinia());
    app.mount(el);
  },
});
