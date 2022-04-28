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
  {
    path: '/admin/dashboard',
    name: 'DashboardPage',
    children: [
      {
        path: 'admin',
        name: 'AdminPage',
        component: () => import('../views/admin/Admin.vue')
      },
      {
        path: 'post',
        name: 'PostPage',
        component: () => import('../views/admin/Post.vue')
      },
      {
        path: 'slide',
        name: 'SlidePage',
        component: () => import('../views/admin/Slide.vue')
      },
      {
        path: '',
        name: 'Main',
        component: () => import('../views/admin/Dashboard.vue')
      }
    ],
    component: () => import('../views/admin/DashboardPage.vue')
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router