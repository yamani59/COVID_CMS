<template>
  <div id="LoginPage">
    <link rel="stylesheet" href="https://fonts.sandbox.google.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <div class="row">

      <div class="image col-7">
        <div class="title">
          <h1>World</h1>
          <p>write news about the latest events</p>
        </div>
        <div class="title-b d-flex align-items-end justify-content-end flex-column">
          <h1>Calm & Relaxed</h1>
          <p>Contact: +62 831 9321 9402</p>
        </div>
      </div>

      <div class="col d-flex align-items-center">
        <form class="p-5 m-2" @submit.prevent="submitHandler">
          <h1>Login Here!</h1>
          <div class="p-2 d-flex align-items-center">
            <span class="me-3 material-symbols-outlined">
              account_circle
            </span>
            <input type="email" v-model="form.email" name="email" class="form-control" placeholder="Email">
          </div>
          <div class="p-2 d-flex align-items-center">
            <span class="me-3 material-symbols-outlined">
              lock_open
            </span>
            <input type="password" v-model="form.password" name="password" class="form-control" placeholder="Password">
          </div>
          <div class="p-2 d-flex justify-content-end">
            <div class="d-flex bg-dark btn btn-dark align-items-center justify-content-center">
              <input type="submit" value="Login" class="submit">
              <span class="material-symbols-outlined">
                trending_flat
              </span>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  name: 'LoginPage',
  data() {
    return {
      form: {
        email : '',
        password : ''
      }
    }
  },
  methods: {
    async submitHandler() {
      axios.post('http://127.0.0.1:8000/api/v1/login', {
        email: this.form.email,
        password: this.form.password
      }).then(res => {
        console.log(res.data)
        localStorage.setItem('access_token', res.data.access_token)
        localStorage.setItem('refresh_token', res.data.refresh_token)
        this.$router.push({ path: '/admin/dashboard' })
      }).catch((e) => {
        console.log(e)
        this.$swal({
          icon: 'error',
          title: 'Oops..',
          text: 'Failed to Login',
          showConfirmButton: false,
          timer: 2000
        })
      })
    }
  }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Belleza&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Syne:wght@500&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

#LoginPage .row {
  margin: 0; 
  padding: 0;
  height: 100vh;
}

#LoginPage .title {
  font-family: 'Belleza', sans-serif;
  color: white;
  text-align: end;
  padding: 3em;
}

#LoginPage .title h1 {
  font-size: 6em;
  margin-bottom: -20px;
}

#LoginPage .title p {
  color: rgb(255, 255, 255);
  font-size: 1.5em;
  border-bottom: 1px solid white;
}

#LoginPage .title-b {
  font-size: 1em;
  padding: 3em;
  color: white;
  height: 60vh; 
}

#LoginPage .title-b p {
  color: rgb(175, 175, 175);
}

#LoginPage form {
  width: 100%;
}

#LoginPage form h1 {
  text-align: start;
  font-family: 'Poppins', sans-serif;
  font-weight: bolder;
}


#LoginPage .form-control {
  padding: 0.8em;
  border-radius: 50px;
  border: 2px;
  box-shadow: 0 0 10px rgba(85, 87, 90, 0.25);
  transition: 0.5s all;
}

#LoginPage .btn {
  width: 40%;
  border-radius: 50px;
}

#LoginPage .btn .submit {
  background: none;
  color: white;
  outline: none;
  border: none;
}

#LoginPage .form-control:focus {
  box-shadow: 0 0 10px rgba(47, 48, 49, 0.733);
}

.image {
  background: url('../../assets/cover.png');
  background-size: cover;
  background-position: center;
}
</style>