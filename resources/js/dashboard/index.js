import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './routes';
import App from './layouts/Dashboard.vue';
import { createHead } from '@unhead/vue/client'

const app = createApp(App);

const head = createHead( {
   titleTemplate: '%s | MySite'

  
})
// Load components
const components = import.meta.glob("./components/*.vue", { eager: true });
for (const path in components) {
    const componentName = path.split("/").at(-1).split(".")[0];
    app.component(`${componentName}`, components[path].default);
}
 
app.use(createPinia());
app.use(router);
app.use(head)
app.mount('#app');