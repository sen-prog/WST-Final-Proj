<template>
<div>
  <div v-if="myStore.isLoggedIn">
    <Header @my_event="logout" :user_display="user_dis"/>
  </div>
    
    <br> <br>
  <router-view @pass_user_display="user_display_handler"></router-view>

</div>
</template>



<script setup>
import Header from './components/Header.vue'
import {useUserStore} from '@/stores/user'
import { useRouter } from 'vue-router'
import axios from '../axios-config.js'
import { onMounted } from 'vue';

const router = useRouter()
const myStore = useUserStore()
var user_dis;




const logout = ()=>{

   var data = new FormData();
   data.append("tokenValue",localStorage.getItem('token'));
   
   axios.post('/logout',data,{
     headers:{
     'Authorization': `Bearer ${localStorage.getItem('token')}`
     }
   }).then((res)=>{
     console.log(res)
     localStorage.removeItem('token')
     localStorage.removeItem('isLoggedIn')
     myStore.isLoggedIn = false
     router.push('/login')
   }).catch((error)=>{
     console.log(error)
   })

}


const user_display_handler = (user) =>{

  user_dis = user

}

// const onMountHandler = () => {
  
//   if
// };

// onMounted(onMountHandler);
</script>

<style scoped>

</style>