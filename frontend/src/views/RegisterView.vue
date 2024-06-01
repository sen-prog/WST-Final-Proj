<template>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 align-items-center">
      <div class="log mb-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
          </svg>
      </div>
      <h2 class="card-title text-center">Register</h2>
      <form class="register-form mt-3 w-100" @submit.prevent="register">
        <div class="mb-3">
          <label for="username" class="form-label">Username:</label>
          <input type="text" class="form-control" id="username" v-model="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password:</label>
          <input type="password" class="form-control" id="password" v-model="password" required>
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-dark">{{ buttonName }}</button>
        </div>
      </form>
      <div class="text-center mt-3">
        <p>Already have an account? 
          <router-link to="/login" class="text-decoration-none" id="reg">
            Login here
          </router-link>
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import axios from '../../axios-config.js'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const username = ref('')
const password = ref('')
const buttonName = ref('Register')
const router = useRouter()

const register = (e) => {
  e.preventDefault();
  buttonName.value = "Registering..."
  axios.post('/register', {
    username: username.value,
    password: password.value
  }).then((res) => {
    if (res.status === 201) {
      buttonName.value = "Register"
      router.push('/login')
    }
  }).catch((error) => {
    console.log(error)
    buttonName.value = "Register"
  })
}
</script>

<style lang="scss" scoped>
.card {
  width: 500px;
  padding: 60px;
  border: 1px solid black;
}

.form-control {
  box-shadow: none !important;
  border: 1px solid #cecdc5 !important;
}

.form-control:focus {
  box-shadow: none !important;
  border: 1px solid #73726e !important;
}
#reg{
  color: black;
}

#reg:hover{
  color: gray;
}

</style>
