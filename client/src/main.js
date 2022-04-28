import { createApp } from 'vue'
import App from './App.vue'
import router from './router'

import './App.css'

import VueSweetalert2 from 'vue-sweetalert2'
import 'sweetalert2/dist/sweetalert2.css'

createApp(App)
  .use(VueSweetalert2)
  .use(router)  
  .mount('#app')
