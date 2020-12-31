const routes = [
    {
        path: '/',
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                component: () => import('pages/Index.vue')
            }
        ]
    },
/*    {
        path: '/quasar',
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                component: () => import('pages/Index.vue')
            }
        ]
    },*/
    {
        path: '/smartklips',
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                component: () => import('pages/Index.vue')
            }
        ]
    },
    {
        path: '/klips/smartklips/',
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                component: () => import('pages/Index.vue')
            }
        ]
    },
    {
        path: '/klips/smartklips.html',
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                component: () => import('pages/Index.vue')
            }
        ]
    },
    // Always leave this as last one,
    // but you can also remove it
    {
        path: '*',
        component: () => import('pages/Error404.vue')
    }
]

export default routes
