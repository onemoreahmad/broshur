    import { createRouter, createWebHistory } from 'vue-router';    
    import { useAuthStore } from '../stores/auth'

    import Home from '../views/Home.vue';
    import Content from '../views/Content.vue';
    import Orders from '../views/Orders.vue';
    import OrderDetail from '../views/OrderDetail.vue';
    import Account from '../views/Account.vue';
    import Design from '../views/Design.vue';
    import Share from '../views/Share.vue';
    import Settings from '../views/Settings.vue';
    import Subscription from '../views/Subscription.vue';


    // blocks
    import HeaderBlock from '../components/Blocks/Header.vue';
    import CtaBlock from '../components/Blocks/Cta.vue';
    import LinksBlock from '../components/Blocks/Links.vue';
    import AboutBlock from '../components/Blocks/About.vue';
    import FeaturesBlock from '../components/Blocks/Features.vue';
    import FaqBlock from '../components/Blocks/Faq.vue';
    import GalleryBlock from '../components/Blocks/Gallery.vue';
    import ReviewsBlock from '../components/Blocks/Reviews.vue';
    import PortfolioBlock from '../components/Blocks/Portfolio.vue';
    import TeamBlock from '../components/Blocks/Team.vue';
    import ServicesBlock from '../components/Blocks/Services.vue';
    import AgreementBlock from '../components/Blocks/Agreement.vue';
      
    const router = createRouter({
        history: createWebHistory('/dashboard'),
     
        routes: [
            { path: '/', component: Home, name: 'home' },
            {   
                path: '/content', 
                component: Content,
                children: [
                    {
                      path: '',
                      name: 'content',
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
                    {
                      path: 'portfolio',
                      name: 'blocks.portfolio',
                      component: PortfolioBlock,
                    },
                    {
                      path: 'team',
                      name: 'blocks.team',
                      component: TeamBlock,
                    },
                    {
                      path: 'services',
                      name: 'blocks.services',
                      component: ServicesBlock,
                    },
                    {
                      path: 'agreement',
                      name: 'blocks.agreement',
                      component: AgreementBlock,
                    },
                  ],
             },
            { path: '/orders', component: Orders, name: 'orders' },
            { path: '/orders/:id', component: OrderDetail, name: 'orders.detail' },
            { path: '/account', component: Account, name: 'account' },
            { path: '/design', component: Design, name: 'design' },
            { path: '/share', component: Share, name: 'share' },
            { path: '/settings', component: Settings, name: 'settings' },
            { path: '/subscription', component: Subscription, name: 'subscription' },
        ],  
    });

    router.beforeEach((to, from, next) => {
      const authStore = useAuthStore()
    
      document.title = to.meta.title || 'إدارة البروشور';

      if (!authStore.user) {
        window.location.reload();
      } else {
        next();
      }
    });
     
    export default router;