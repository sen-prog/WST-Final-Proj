<template>
    <div class="main-container">
      <div class="register-container">
        <h2>Register</h2>
        <form class="register-form" @submit="register">
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" v-model="username" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" v-model="password" required>
          </div>
          <div class="form-group">
            <button type="submit">{{ buttonName }}</button>
          </div>
        </form>
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
  .register-container {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 20px;
    width: 400px;
    margin-left: 50%;
    margin-top: 2rem;
    transform: translate(-50%);
  }
  
  .register-container h2 {
    margin-top: 0;
    font-size: 24px;
    text-align: center;
  }
  
  .register-form {
    display: flex;
    flex-direction: column;
  }
  
  .form-group {
    margin-bottom: 15px;
  }
  
  .form-group label {
    font-weight: bold;
  }
  
  .form-group input[type="text"],
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
  </style>
  