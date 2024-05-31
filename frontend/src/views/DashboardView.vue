<template>
    <div class = "main_box">

         <div class = "TODOLIST"> 
            <h1> TO DO LIST </h1>

        </div>
   

       
            
        <div class = "type_box">
            <!-- <textarea ref = "todo"> </textarea>  -->
            <!-- <button v-on:click=" post_func"> ADD </button> -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form ref="todo">
                      <div class="mb-3">
                        <input ref="todo" class="form-control">
                      </div>
                      <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- <button v-on:click=" post_func" class="btn btn-primary">Add Task</button> -->
                    <button v-on:click=" post_func"> ADD </button>
                  </div>
                    </form>
                  </div>

                </div>
              </div>
            </div>
        </div>
        
        <div class = "update_modal" v-if="ModalOpen">
            <h4 >  {{modal_todo}}   </h4>
            <textarea class = "modal field" ref = "newtodo" > </textarea> 
            <button v-on:click="update_func"> UPDATE </button>
            <button v-on:click="modal_func()"> CANCEL </button>

        </div>
    
    
        <div class = "task_box">
           

              <li class = "todo_box" v-for="item in todos" :key="item.id">

               
                    <p v-if="!item.status"> {{ item.to_do }}   </p>
                    <p v-if ="item.status" class = "crossed"> {{ item.to_do }}</p>


                    <button v-on:click="delete_func(item.id)"> delete </button> 
                    <button v-if ="!item.status" v-on:click="() => {modal_func(); id_give_update(item.id, item.to_do)}"> update </button>
                    <button v-on:click="change_status(item.id)" v-if="item.status"> Undo {{ item.status }}</button>
                    <button v-on:click="change_status(item.id)" v-if ="!item.status"> Done {{ item.status }}</button>
                
              </li> 

           
            
            
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
                axios.get(`http://127.0.0.1:8000/api/todos/${this.user_id}`)
                .then(response => {
                this.todos = response.data[0];
                // console.log( this.todos);
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
    .TODOLIST{
        margin-top: 50px;
    }
    .main_box{
        /* border: solid black; */
        height: auto;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
        
        
    
    }
    p{
         word-wrap: break-word;
    }
    
    .type_box{
        margin-top: 30px;

    }

    .task_box{
    border: solid black;  
    padding: 10px;  
    width: 500px;
    height: auto;
    margin-top: 50px;
    }

    .todo_box{
        border: solid black; 

    }
    
    textarea{
        width: 500px;
    }


    .update_modal{
        border: solid black;
        background: white;
        height: 300px;
        width: 550px;
        position: fixed;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-evenly;
    }

    .crossed {
        text-decoration: line-through;
        color: red;
    }

    .box_done{
        background: skyblue;
    }
   
    
    </style>