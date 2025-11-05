import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './routes';
import App from './layouts/Dashboard.vue';
import { createHead } from '@unhead/vue/client'
import Notifications from '@kyvg/vue3-notification'
import { useAuthStore } from './stores/auth'
 
const app = createApp(App);
app.use(createPinia())

const head = createHead( {
   titleTemplate: '%s | MySite'
})
 
// Load components
const components = import.meta.glob("./components/*.vue", { eager: true });
for (const path in components) {
    const componentName = path.split('/').pop().split('.')[0];
    app.component(`${componentName}`, components[path].default);
}
 

const uiComponents = import.meta.glob("./components/Ui/*.vue", { eager: true });
for (const path in uiComponents) {
    const componentName = 'Ui' + path.split('/').pop().split('.')[0];
    app.component(`${componentName}`, uiComponents[path].default);
}
 
 
const { setAuth } = useAuthStore()

setAuth().then(() => {
    app.use(head)
    app.use(Notifications)
    app.use(router)
      .mount('#app');
})
 