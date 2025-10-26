    import { createRouter, createWebHistory } from 'vue-router';    
  
    import Home from '../views/Home.vue';
    import Orders from '../views/Orders.vue';
    import About from '../views/About.vue';
    import Preview from '../views/Preview.vue';
    import Account from '../views/Account.vue';
    import Design from '../views/Design.vue';
    import Share from '../views/Share.vue';
    import Settings from '../views/Settings.vue';

    // blocks
    import HeaderBlock from '../components/Blocks/Header.vue';
    import CtaBlock from '../components/Blocks/Cta.vue';
    import LinksBlock from '../components/Blocks/Links.vue';
    import AboutBlock from '../components/Blocks/About.vue';
    import FeaturesBlock from '../components/Blocks/Features.vue';
    import FaqBlock from '../components/Blocks/Faq.vue';
    import GalleryBlock from '../components/Blocks/Gallery.vue';
    import ReviewsBlock from '../components/Blocks/Reviews.vue';

    
    const router = createRouter({
        history: createWebHistory('/dashboard'),
     
        routes: [
            {   
                path: '/', 
                component: Home,
                children: [
                    {
                      path: '',
                      name: 'home',
                      component: HeaderBlock,
                    },
                    {
                      path: 'cta',
                      name: 'blocks.cta',
                      component: CtaBlock,
                    },
                    {
                      path: 'links',
                      name: 'blocks.links',
                      component: LinksBlock,
                    },
                    {
                      path: 'about',
                      name: 'blocks.about',
                      component: AboutBlock,
                    },
                     
                    {
                      path: 'features',
                      name: 'blocks.features',
                      component: FeaturesBlock,
                    },
                    {
                      path: 'faq',
                      name: 'blocks.faq',
                      component: FaqBlock,
                    },
                    {
                      path: 'reviews',
                      name: 'blocks.reviews',
                      component: ReviewsBlock,
                    },
                    {
                      path: 'gallery',
                      name: 'blocks.gallery',
                      component: GalleryBlock,
                    },
                  ],
             },
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