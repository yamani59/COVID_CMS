import { createRouter, createWebHashHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'HomePage',
    component: () => import('../views/public/HomePage.vue')
  },
  {
    path: '/admin',
    name: 'LoginPage',
    component: () => import('../views/admin/LoginPage.vue')
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router