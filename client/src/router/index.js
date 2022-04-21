import { createRouter, createWebHashHistory } from 'vue-router'
import LoginPage from '@/views/private/LoginPage'
import ClientPage from '@/views/public/ClientPage'

const routers = [
  {
    path: '/',
    name: 'clientPage',
    component: ClientPage
  },
  {
    path: '/admin',
    name: 'loginPage',
    component: LoginPage
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routers
})

export default router