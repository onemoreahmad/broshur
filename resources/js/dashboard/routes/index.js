    import { createRouter, createWebHistory } from 'vue-router';    
  
    const router = createRouter({
        history: createWebHistory('/dashboard'),
     
        routes: [
            { path: '/', component: () => import('../views/Home.vue'), name: 'home' },
            { path: '/orders', component: () => import('../views/Orders.vue'), name: 'orders' },
            { path: '/about', component: () => import('../views/About.vue'), name: 'about' },
            { path: '/preview', component: () => import('../views/Preview.vue'), name: 'preview' },
            { path: '/account', component: () => import('../views/Account.vue'), name: 'account' },
            { path: '/design', component: () => import('../views/Design.vue'), name: 'design' },
            { path: '/share', component: () => import('../views/Share.vue'), name: 'share' },
            { path: '/settings', component: () => import('../views/Settings.vue'), name: 'settings' },
        ],  
    });

    export default router;