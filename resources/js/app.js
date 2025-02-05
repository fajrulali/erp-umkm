import './bootstrap';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';


createInertiaApp({
  resolve: (name) => {
    const page = resolvePageComponent(`./pages/${name}.vue`, import.meta.glob('./pages/**/*.vue'));

    // Cek apakah halaman ditemukan
    if (!page) {
      console.error(`Page not found: ./pages/${name}.vue`);
      throw new Error(`Page not found: ./pages/${name}.vue`);
    }

    return page;  // Mengembalikan komponen halaman
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .mount(el);  // Mount aplikasi ke elemen dengan id 'app'
  },
});
