    import { createRouter, createWebHistory } from 'vue-router';    
  
    import Home from '../views/Home.vue';
    import Orders from '../views/Orders.vue';
    import About from '../views/About.vue';
    import Preview from '../views/Preview.vue';
    import Account from '../views/Account.vue';
    import Design from '../views/Design.vue';
    import Share from '../views/Share.vue';
    import Settings from '../views/Settings.vue';
    
    const router = createRouter({
        history: createWebHistory('/dashboard'),
     
        routes: [
            { path: '/', component: Home, name: 'home' },
            { path: '/orders', component: Orders, name: 'orders' },
            { path: '/about', component: About, name: 'about' },
            { path: '/preview', component: Preview, name: 'preview' },
            { path: '/account', component: Account, name: 'account' },
            { path: '/design', component: Design, name: 'design' },
            { path: '/share', component: Share, name: 'share' },
            { path: '/settings', component: Settings, name: 'settings' },
        ],  
    });

    export default router;