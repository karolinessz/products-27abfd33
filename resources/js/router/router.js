import Home from '../vue/Home.vue'
import Products from '../vue/Products.vue'
import History from '../vue/History.vue'
import ErrorPage from '../vue/ErrorPage.vue'

const routes = [
    {
        path: '/',
        component: Home,
        name: 'Home',
        children: [
            {
                path: '/products',
                name: "Products",
                component: Products,
            },
            {
                path: '/history',
                name: "History",
                component: History,
            },
        ],
    },
    {
        path: '*',
        name: "Error",
        component: ErrorPage,
    },
]

export default routes;