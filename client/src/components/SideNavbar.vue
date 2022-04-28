<template>
  <div class="navbar navbar-expand m-0 d-flex flex-column align-items-center bg-light d-flex justify-content-center align-items-center">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <div class="nav-link">
      <RouterLink to="/admin/dashboard">
        <span class="material-symbols-outlined">
          dashboard
        </span>
      </RouterLink>
      <div class="title border position-fixed bg-light p-2">
        dashboard
      </div>
    </div>
    <div class="nav-link">
      <RouterLink to="/admin/dashboard/post">
        <span class="material-symbols-outlined">
          post_add
          </span>
      </RouterLink>
      <div class="title border position-fixed bg-light p-2">
        post page
      </div>
    </div>
    <div class="nav-link">
      <RouterLink to="/admin/dashboard/slide">
      <span class="material-symbols-outlined">
        feed
      </span>
      </RouterLink>
      <div class="title border position-fixed bg-light p-2">
        slide page
      </div>
    </div>
    <div class="nav-link">
      <RouterLink to="/admin/dashboard/admin">
      <span class="material-symbols-outlined">
        admin_panel_settings
      </span>
      </RouterLink>
      <div class="title border position-fixed bg-light p-2">
        admin page
      </div>
    </div>
    <div class="logout nav-link">
      <RouterLink to="/admin/dashboard/admin">
      <span class="material-symbols-outlined">
        logout
      </span>
      </RouterLink>
      <div class="title border position-fixed bg-light p-2">
        logout
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SlideNavbarComponent',
  data() {
    return {
      links: [
        '/admin/dashboard',
        '/admin/dashboard/post',
        '/admin/dashboard/slide',
        '/admin/dahsboard/admin'
      ]
    }
  }
}
</script>

<style>
  .navbar {
    height: 100%;
    border-right: 3px solid black;
  }

  .navbar span {
    cursor: pointer;
    color: black;
  }

  .navbar .title {
    width: 10%;
    border-radius: 15px 50px 30px;
    display: none;
    color: black;
    transform: translateX(50%) translateY(-90%);;
  }

  .nav-link:hover .title {
    display: block;
  }

  .logout {
    position: fixed;
    bottom: 1em;
  }
</style>