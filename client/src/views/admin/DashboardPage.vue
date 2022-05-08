<template>
  <div id="Dashboard">
    <div class="home row">
      <div class="col-1 ">
        <SideNavbar />
      </div>
      <div class="col bg-white">
        <RouterView />
      </div>
    </div>
  </div>
</template>

<script>
import SideNavbar from '../../components/SideNavbar.vue'
import { RouterView } from 'vue-router'

export default {
  name: 'DashboardPage',
  components: {
    SideNavbar,
    RouterView,
  },
  mounted() {
    if (!localStorage.getItem('access_token'))
      this.$router.push({ path: '/admin' })
  }

}
</script>

<style>
  #Dashboard {
    height: 100vh;
    overflow: hidden;
  }

  #Dashboard .home {
    height: 100vh;
  }
</style>