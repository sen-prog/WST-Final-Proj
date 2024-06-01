<template>
  <!-- <div class="main-container">
    <div class="login-container">
         <h2>Login</h2>
        <form class="login-form" @submit="login">
            <div class="form-group">
              <label for="username">Username:</label>
              <input type="text" id="username" v-model="username"  required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" id="password" v-model="password"  required>
            </div>
              <div class="form-group">
              <button type="submit">{{ buttonName }}</button>
            </div>
        </form>
          <div class="register-link">
              <p>Don't have an account? <router-link to="/register">Register here</router-link></p>
          </div>
    </div>
  </div> -->

  <div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card p-4 align-items-center">
    <div class="log mb-3">
          <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
          </svg>
    </div>
    <h2 class="card-title text-center">Login</h2>
    <form class="login-form mt-3 w-100" @submit.prevent="login">
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
      <p>Don't have an account? 
        <router-link to="/register" class="text-decoration-none" id="reg">
          Register here
        </router-link>
      </p>
    </div>
  </div>
</div>

</template>

<script setup>
import { getCurrentInstance } from 'vue'
import axios from '../../axios-config.js'
import {ref,onMounted} from 'vue'
import { useRouter } from 'vue-router'
import {useUserStore} from '@/stores/user'


const myStore = useUserStore()

const username = ref('')
const password = ref('')
const buttonName= ref('Login')
const router = useRouter()

const instance = getCurrentInstance()



const login = (e)=>{
e.preventDefault();
buttonName.value="Logging In..."
axios.post('/login',{
username:username.value,
password:password.value
}).then((res)=>{
if(res.status===200){
    buttonName.value="Login";
    localStorage.setItem("token",res.data.token)
    localStorage.setItem("isLoggedIn",true)
    myStore.isLoggedIn = true;
    router.push('/')
}
}).catch((error)=>{
console.log(error)
buttonName.value="Login"
})
}
onMounted(()=>{
localStorage.removeItem('token')
localStorage.removeItem('isLoggedIn')
myStore.isLoggedIn = false
router.push('/login')
})
</script>

<style lang="scss" scoped>
.login-container {
background-color: #fff;
border-radius: 5px;
box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
padding: 20px;
width: 400px;
margin-left: 50%;
margin-top:2rem;
transform: translate(-50%);
}

.login-container h2 {
margin-top: 0;
font-size: 24px;
text-align: center;
}

.login-form {
display: flex;
flex-direction: column;
}

.form-group {
margin-bottom: 15px;
}

.form-group label {
font-weight: bold;
}

.form-group input[type="username"],
.form-group input[type="password"] {
width: 95%;
padding: 8px;
border: 1px solid #ccc;
border-radius: 3px;
}

.form-group button[type="submit"] {
background-color: #007bff;
color: #fff;
border: none;
border-radius: 3px;
padding: 10px 15px;
cursor: pointer;
}

.form-group button[type="submit"]:hover {
background-color: #0056b3;
}

.register-link {
text-align: center;
margin-top: 15px;
}

.register-link a {
color: #007bff;
text-decoration: none;
}

.register-link a:hover {
text-decoration: underline;
}

#reg{
  color: black;
}

#reg:hover{
  color: gray;
}

.card{
  width: 500px;
  padding: 60px;
  border: 1px solid black;
}

.form-control{
        box-shadow: none !important;
        border: 1px solid #cecdc5 !important;
    }

    .form-control:focus{
        box-shadow: none !important;
        border: 1px solid #73726e !important;
    }
</style>