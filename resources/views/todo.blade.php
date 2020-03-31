<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" >
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Todos</title>



</head>
<body>
    
    
    <div class="justify-content-center align-items-center container" id="app">
        <div class="todoapp">
        <h1>Todos</h1> 
            <div class="div-to-align">
                <div class=""> 
                    <form @submit.prevent="saveTodo">
                        <div v-if="totalCount > 0" class="toggleall">
                            <span class="" @click.prevent="toggleTodo()"><i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </span>
                        </div>
                        <div class="input-group input-group-lg">
                            <input type="text" v-model='form.name' class="new-todo" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="name" placeholder="What needs to be done?" autofocus="">
                        </div>
                    
                    </form>
                </div>
                <div class="main tab-content">
                    <ul class="todo-list tab-pane active" id="all">
                               
                            <li class="list-group-item" v-for="(todo,index) in todos.todos">
                                 
                                    <div class="form-check checkbox-teal mb-2">
                                        <input
                                        type="checkbox"
                                        :checked="todo.status==1 ? 'checked' : ''" 
                                        @click.prevent="doneTodo(todo.id)"
                                        class="form-check-input"
                                        :id="todo.id"
                                        >
                                         
                                        <label class="form-check-label" :for="todo.id" >
                                            <span v-if="todo.status==0">
                                                @{{todo.name}}
                                            </span>
                                            <span v-else>
                                                <del> @{{todo.name}}</del>
                                            </span>
                                        </label>
                                    </div>
                                    <button class="destroy" @click.prevent="clearTodo(todo.id)">X</button>
                            </li>
                       
                    </ul>
                    <ul class="todo-list tab-pane" id="active">
                   
                        <li class="list-group-item" v-for="(todo,index) in todos.active">
                                <div class="form-check checkbox-teal mb-2">
                                    <input
                                    type="checkbox"
                                    :checked="todo.status==1 ? 'checked' : ''" 
                                    @click.prevent="doneTodo(todo.id)"
                                    class="form-check-input"
                                    :id="todo.id"
                                    >
                                     
                                    <label class="form-check-label" :for="todo.id" >
                                        <span v-if="todo.status==0">
                                            @{{todo.name}}
                                        </span>
                                        <span v-else>
                                            <del> @{{todo.name}}</del>
                                        </span>
                                    </label>
                                </div>
                                <button class="destroy" @click.prevent="clearTodo(todo.id)">X</button>
                        </li>
                      
                    </ul>
                    <ul class="todo-list tab-pane" id="completed">
                        <li class="list-group-item" v-for="(todo,index) in todos.completed">
                            <div class="form-check checkbox-teal mb-2">
                                <input
                                type="checkbox"
                                :checked="todo.status==1 ? 'checked' : ''" 
                                @click.prevent="doneTodo(todo.id)"
                                class="form-check-input"
                                :id="todo.id"
                                >
                                 
                                <label class="form-check-label" :for="todo.id" >
                                    <span v-if="todo.status==0">
                                        @{{todo.name}}
                                    </span>
                                    <span v-else>
                                        <del> @{{todo.name}}</del>
                                    </span>
                                </label>
                            </div>
                            <button class="destroy" @click.prevent="clearTodo(todo.id)">X</button>
                        </li>
                    </ul>
                    <ul v-if="totalCount > 0" class="nav nav-tabs">
                        <li>@{{completedCount}} items left</li>
                        <li class="active"><a class="active" href="#all" data-toggle="tab">All</a></li>
                        <li><a href="#active" data-toggle="tab">Active</a></li>
                        <li><a href="#completed" data-toggle="tab">Completed</a></li>
                        <li v-if="activeCount > 0"><a href="#" class="clear-completed" @click.prevent="massClearTodo()">Clear Completed</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="{{asset('js/app.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>