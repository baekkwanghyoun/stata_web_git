const routes = [
    {
        path: '/khp', // http://localhost:8083/klips/
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                component: () => import('pages/Khp.vue')
            }
        ]
    },
    {
        path: '/', // http://localhost:8083/klips/
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                component: () => import('pages/Index.vue')
            }
        ]
    },
    {
        path: '/smartklips.html',
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                component: () => import('pages/Index.vue')
            }
        ]
    },
    {
        path: '/webstata.html',
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                component: () => import('pages/Index.vue')
            }
        ]
    },
    {
        path: '/smartklips.do',
        component: () => import('layouts/MainLayout.vue'),
        children: [
            {
                path: '',
                component: () => import('pages/Index.vue')
            }
        ]
    },
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
    // Always leave this as last one,
    // but you can also remove it
    {
        path: '*',
        component: () => import('pages/Error404.vue')
    }
]

export default routes
