<template>
    <div class = "main_box">

         <!-- <div class = "TODOLIST"> 
            <h1> TO DO LIST </h1>

        </div> -->
        
        <div class="guide">
            <div class="search_box mt-3 w-100">
                <div class="input-group mb-3">
                    <input type="text" ref="searchz" class="form-control" placeholder="Search...">
                    <button class="btn btn-secondary" id="search" type="button" v-on:click="get_all_todos">Search</button>
                </div>
            </div>

        
                
            <div class = "type_box mt-3 w-100">
                <!-- <input type="type" ref = "todo"> </input>  
                <button v-on:click=" post_func"> ADD </button>
                <button class="btn btn-primary">Submit</button> -->
                <div class="input-group mb-3">
                 <input type="text" class="form-control" ref="todo" placeholder="Enter to-do item">
                 <button class="btn btn-dark" id="add" type="button" v-on:click="post_func">Add Task</button>
                </div>
            </div>
            

         

           
            <div class="update_modal" v-if="ModalOpen">
                <h4>{{ modal_todo }}</h4>
                <form @submit.prevent="update_func" class="mt-3 w-100" id="updateForm">
                    <input type="text" class="form-control mb-3" ref="newtodo">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-dark me-2" @click="update_func">Update</button>
                        <button type="button" class="btn btn-secondary" @click="modal_func">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="designBox">
            <div class="inviBox">
                <div class = "task_box">
                

                    <div class = "todo_box d-flex flex-row" v-for="item in todos" :key="item.id">

                    
                            <p v-if="!item.status"> {{ item.to_do }}   </p>
                            <p v-if ="item.status" class = "crossed"> {{ item.to_do }}</p>

                            <div class="btns ms-auto">

                                <button v-on:click="change_status(item.id)" v-if ="!item.status" class="done"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                </button>

                                <button v-on:click="delete_func(item.id)" class="trash">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                </button> 

                                <button v-if ="!item.status" v-on:click="() => {modal_func(); id_give_update(item.id, item.to_do)}" class="update">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>                       
                                </button>

                                <button v-on:click="change_status(item.id)" v-if="item.status" class="undo">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2z"/>
                                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466"/>
                                    </svg>
                                </button>



                            </div>
                    </div> 

                
                    
                    
                </div>
            </div>
        </div>
       
    
    
    </div>
    
    </template>
    
    <script>
    import Todo_box from '../components/Todo_box.vue'
    import axios from 'axios'
    
    
    export default{
        
        props: ['propValue']
        ,
        data(){
            return{
                user_name:"",
                user_id:0,
                todos: [],
                ModalOpen:false,
                update_id: 0,
                modal_todo: "",
               
            }
            
        },
        methods: {
            post_func(){ 
                
                axios.post('http://127.0.0.1:8000/api/todos', {user_id: this.user_id, to_do: this.$refs.todo.value, status: 0})
                .then(response => {
                console.log(response.data);
                this.get_all_todos()
                this.$refs.todo.value = ""
                 })
                .catch(error => {
                 console.error('Error fetching todos:', error);
                 });
               
               
                
            },
            update_func(){
                // console.log(this.$refs.newtodo.value)
                this.modal_func()
                axios.patch(`http://127.0.0.1:8000/api/todos/${this.update_id}`, {to_do: this.$refs.newtodo.value})
                .then(response => {
                console.log(response.data);
                this.get_all_todos()
                // this.get_user_username()
                 })
                .catch(error => {
                 console.error('Error fetching todos:', error);
                 });

                console.log(this.update_id);
                
    
            },
            id_give_update(id, todo){
                this.update_id = id
                this.modal_todo = todo
            },
            delete_func(id){
                axios.delete(`http://127.0.0.1:8000/api/todos/ ${id}`)
                .then(response => {
                console.log(response.data);
                this.get_all_todos()
                 })
                .catch(error => {
                 console.error('Error fetching todos:', error);
                 });

                console.log(id);
    
            },
            test_func(){
                // console.log(this.propValue)
                // console.log(this.user_id)
                // console.log(this.todos)
                // console.log(this.todos.data.user_id)

                console.log(this.user_name);
               
    
            },
            retrieve_func(){        
                axios.post('http://127.0.0.1:8000/api/todos', {id: this.user_id})
                .then(response => {
                console.log(response.data);
                 })
                .catch(error => {
                 console.error('Error fetching todos:', error);
                 });

            },
            get_user_username(){
                axios.get('http://127.0.0.1:8000/api/user', {
                headers: {
                Authorization: `Bearer ${localStorage.token}`
                }
                 })
                .then(response => {
                this.user_name = response.data.username;
                console.log(this.user_name);
                this.get_user_id()
                this.$emit('pass_user_display', this.user_name)
                 })
                .catch(error => {
                 console.error('Error fetching todos:', error);
                 });
            },
            get_user_id(){
                axios.post('http://127.0.0.1:8000/api/current_user_id', {username: this.user_name} 
                )
                .then(response => {
                this.user_id = response.data.id;
                console.log(this.user_id);
                this.get_all_todos()
                 })
                .catch(error => {
                 console.error('Error fetching todos:', error);
                 });

            },
            get_all_todos(){


                axios.get(`http://127.0.0.1:8000/api/get_search?user_id=${this.user_id}&search=${this.$refs.searchz.value}`)
                    .then(response => {
                    this.todos = response.data
                    })
                    .catch(error => {
                    console.error('Error fetching todos:', error);
                    });

            },
            change_status(id){
                axios.patch('http://127.0.0.1:8000/api/change_status', {id: id})
                .then(response => {
                console.log(response.data);
                this.get_all_todos()
                 })
                .catch(error => {
                 console.error('Error fetching todos:', error);
                 });


            },
            modal_func(){
                this.ModalOpen = !this.ModalOpen
                console.log(this.ModalOpen)
            },
            cross_out(todo){
               
            },
          
    
        },
        mounted(){
           this.get_user_username()
           console.log("MOUNT LOOPED")

        }
    }
    </script>

    <style scoped>
    .designBox{
        background-color:#e5e4db;
        height: 524px;
        width: 524px;
        border-radius: 15px;
        padding: 12px;
    }

    .guide {
    /* display: flex; */
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: none;
    /* border: 1px solid red; */
    height: auto;
    width: 524px;
    }

    .inviBox{
        background-color:#e5e4db;
        height: 500px;
        border-radius: 15px;
        overflow-y: auto;
        overflow-X: hidden;
    }

    /* .TODOLIST{
        margin-top: 50px;
    } */
    .main_box{
        /* border: solid black; */
        height: auto;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
        padding: 0;
    }
    p{
         word-wrap: break-word;
    }
    
    .type_box{
        margin-top: 30px;

    }

    /* .task_box{
    border: solid black;  
    padding: 10px;  
    width: 500px;
    height: auto;
    } */

    .todo_box{
        background-color: #cecdc5;
        width: 500px;
        height: 55px;
        border-radius: 12px;
        margin-bottom: 12px;
        padding: 13px;
    }
    
    textarea{
        width: 500px;
    }


    .update_modal{
        border: 1px solid gray;
        border-radius: 10px;
        background: white;
        height: 300px;
        width: 550px;
        position: fixed;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
        padding: 30px;
    }

    .crossed {
        text-decoration: line-through;
        color: rgb(150, 60, 60);
    }

    .box_done{
        background: skyblue;
    }

    .done{
        background: none;
        border: none;
        color: #a0a099;
        margin-right: 10px;
    }

    .done:hover{
        color: #76ba1b;
    }

    .trash{
        background: none;
        border: none;
        color: #a0a099;
        margin-right: 10px;
    }

    .trash:hover{
        color: #c30010;
    }

    .update{
        background: none;
        border: none;
        color: #a0a099;
    }

    #add:hover{
        background-color: white !important;
        color: black !important;
    }

    .update:hover{
        color: #02367b;
    }

    .form-control{
        box-shadow: none !important;
        border: 1px solid #cecdc5 !important;
    }

    .form-control:focus{
        box-shadow: none !important;
        border: 1px solid #73726e !important;
    }

    .undo{
        background: none;
        border: none;
        color: #a0a099;
    }

    .undo:hover{
        color: #2e2e2c;
    }

    .type_box{
        width: auto;
    }

    #search{
        width: 89px;
    }

    ::-webkit-scrollbar {
        width: 0px;   
    }

    ::-webkit-scrollbar-track {
        /* background: #e5e4db;
        border-radius: 10px; */
        background: none;     
    }

    ::-webkit-scrollbar-thumb {
        /* background: #cecdc5;
        border-radius: 10px; */
        background: none; 
    }

    ::-webkit-scrollbar-thumb:hover {
        /* background: #b7b6af; */
        background: none; 
}
    </style>