<template>

    <!-- <header class="header" > -->
     <!-- <nav class="nav">
       <router-link class="link" to="/">Dashboard</router-link>
       <h1> {{ user_display }}</h1>

       <h1> {{ propValue.username }} </h1>
       <router-link class="link" to="/enroll">Enroll</router-link>
       <router-link class="link" to="/bulk">Bulk-Enroll</router-link>
       <router-link class="link" to="/students">Students</router-link>
       <router-link class="logout" @click="$emit('my_event')" to="#" >Logout</router-link>
       @click="logout"
     </nav> -->

     <nav class="navbar navbar-expand-lg bg-dark">
      <div class="container">
        <a class="navbar-brand text-light" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0"/>
            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z"/>
          </svg> &#8203; &#8203;To-Do List</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item d-flex flex-row">

                <!-- <a class="nav-link text-light" aria-current="page" href="#" style="padding-right: 30px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                  </svg>
                </a> -->

              

              <router-link class="logout" @click="$emit('my_event')" to="#" style="padding-right: 25px;">
                <a class="nav-link text-light" aria-current="page" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                  </svg>
                </a>
              </router-link>

            </li>
            
            
            
          </ul>
          <!-- <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form> -->
    </div>
  </div>
</nav>
  <!-- </header> -->
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