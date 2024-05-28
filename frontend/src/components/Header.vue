<template>
    <header class="header" >
     <nav class="nav">
       <router-link class="link" to="/">Dashboard</router-link>
       <h1> {{ user_display }}</h1>

       <!-- <h1> {{ propValue.username }} </h1> -->
       <!-- <router-link class="link" to="/enroll">Enroll</router-link>
       <router-link class="link" to="/bulk">Bulk-Enroll</router-link>
       <router-link class="link" to="/students">Students</router-link> -->
       <router-link class="logout" @click="$emit('my_event')" to="#" >Logout</router-link>
       <!-- @click="logout" -->
     </nav>
  </header>
</template>



<script>


export default {

  props:['user_display']

}

</script>



<style scoped>
.header{
 border:1px solid var(--main);
 position:fixed;
 top:0;
 left:0;
 padding:10px;
 width: 100vw;
 height: 50px;
 background-color: var(--main);
 box-shadow: 0 0 3.5px 0 rgba(0, 0, 0, 0.3);
 z-index: 3;
}
.nav{
 display: flex;
 width: 95vw;
}
.nav .link{
 text-decoration: none;
 color:#000;
 font-size: 20px;
 margin:5px;
 padding:5px 10px 5px 10px;
 border-radius: 5px;
}
.nav .link:hover{
 background-color: var(--secondary);
 color:#fff;
}
.nav .link.router-link-exact-active {
 background-color: var(--secondary);
 color:#fff;
}
.nav .logout{
 text-decoration: none;
 color:#000;
 font-size: 20px;
 margin:5px 5px 5px auto;
 padding:5px 10px 5px 10px;
 border-radius: 5px;
 background-color: var(--secondary);
 color:#fff;
}

</style>