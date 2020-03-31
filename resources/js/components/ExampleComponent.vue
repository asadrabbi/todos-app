<template>
    <div class="div-to-align">
        <div class="">
            <form @submit.prevent="saveTodo">
                <div v-if="totalCount > 0" class="toggleall">
                    <span class="" @click.prevent="toggleTodo()"
                        ><i class="fa fa-chevron-down" aria-hidden="true"></i>
                    </span>
                </div>
                <div class="input-group input-group-lg">
                    <input
                        type="text"
                        v-model="form.name"
                        class="new-todo"
                        aria-label="Large"
                        aria-describedby="inputGroup-sizing-sm"
                        name="name"
                        placeholder="What needs to be done?"
                        autofocus=""
                    />
                </div>
            </form>
        </div>
        <div class="main tab-content">
            <ul class="todo-list tab-pane active" id="all">
                <li
                    class="list-group-item"
                    v-for="(todo, index) in todos.todos"
                >
                    <div
                        class="form-check checkbox-teal mb-2"
                        @dblclick="renameTodo(todo)"
                    >
                        <input
                            type="checkbox"
                            :checked="todo.status == 1 ? 'checked' : ''"
                            @click.prevent="doneTodo(todo.id)"
                            class="form-check-input"
                            :id="todo.id"
                        />

                        <input
                            class="rename new-todo"
                            type="text"
                            v-model="form.name"
                            v-if="form.id == todo.id"
                            @keyup.enter="updateRename"
                            @blur="updateRename"
                        />
                        <label
                            class="form-check-label"
                            :for="todo.id"
                            v-if="todo.id != form.id"
                        >
                            <span v-if="todo.status == 0">
                                {{ todo.name }}
                            </span>
                            <span v-else>
                                <del> {{ todo.name }}</del>
                            </span>
                        </label>
                    </div>
                    <button
                        v-if="todo.id != form.id"
                        class="destroy"
                        @click.prevent="clearTodo(todo.id)"
                    >
                        X
                    </button>
                </li>
            </ul>
            <ul class="todo-list tab-pane" id="active">
                <li
                    class="list-group-item"
                    v-for="(todo, index) in todos.active"
                >
                    <div
                        class="form-check checkbox-teal mb-2"
                        @dblclick="renameTodo(todo)"
                    >
                        <input
                            type="checkbox"
                            :checked="todo.status == 1 ? 'checked' : ''"
                            @click.prevent="doneTodo(todo.id)"
                            class="form-check-input"
                            :id="todo.id"
                        />

                        <input
                            class="rename new-todo"
                            type="text"
                            v-model="form.name"
                            v-if="form.id == todo.id"
                            @keyup.enter="updateRename"
                            @blur="updateRename"
                        />
                        <label
                            class="form-check-label"
                            :for="todo.id"
                            v-if="todo.id != form.id"
                        >
                            <span v-if="todo.status == 0">
                                {{ todo.name }}
                            </span>
                            <span v-else>
                                <del> {{ todo.name }}</del>
                            </span>
                        </label>
                    </div>
                    <button
                        v-if="todo.id != form.id"
                        class="destroy"
                        @click.prevent="clearTodo(todo.id)"
                    >
                        X
                    </button>
                </li>
            </ul>
            <ul class="todo-list tab-pane" id="completed">
                <li
                    class="list-group-item"
                    v-for="(todo, index) in todos.completed"
                >
                    <div
                        class="form-check checkbox-teal mb-2"
                        @dblclick="renameTodo(todo)"
                    >
                        <input
                            type="checkbox"
                            :checked="todo.status == 1 ? 'checked' : ''"
                            @click.prevent="doneTodo(todo.id)"
                            class="form-check-input"
                            :id="todo.id"
                        />

                        <input
                            class="rename new-todo"
                            type="text"
                            v-model="form.name"
                            v-if="form.id == todo.id"
                            @keyup.enter="updateRename"
                            @blur="updateRename"
                        />
                        <label
                            class="form-check-label"
                            :for="todo.id"
                            v-if="todo.id != form.id"
                        >
                            <span v-if="todo.status == 0">
                                {{ todo.name }}
                            </span>
                            <span v-else>
                                <del> {{ todo.name }}</del>
                            </span>
                        </label>
                    </div>
                    <button
                        v-if="todo.id != form.id"
                        class="destroy"
                        @click.prevent="clearTodo(todo.id)"
                    >
                        X
                    </button>
                </li>
            </ul>
            <ul v-if="totalCount > 0" class="nav nav-tabs">
                <li>{{ completedCount }} items left</li>
                <li class="active">
                    <a class="active" href="#all" data-toggle="tab">All</a>
                </li>
                <li><a href="#active" data-toggle="tab">Active</a></li>
                <li><a href="#completed" data-toggle="tab">Completed</a></li>
                <li v-if="activeCount > 0">
                    <a
                        href="#"
                        class="clear-completed"
                        @click.prevent="massClearTodo()"
                        >Clear Completed</a
                    >
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            visiable: false,
            form: {
                id: "",
                name: ""
            },
            todos: [],
            totalCount: 0,
            completedCount: 0,
            activeCount: 0
        };
    },

    methods: {
        getTodoData() {
            axios.get("get-todo").then(res => {
                this.todos = res.data;
                this.totalCount = res.data.totalCount;
                this.completedCount = res.data.completedCount;
                this.activeCount = res.data.activeCount;
            });
        },
        saveTodo() {
            axios.post("todo", this.form).then(res => {
                this.form = {};
                this.getTodoData();
            });
        },
        doneTodo(id) {
            axios.get(`update-todo/${id}`).then(res => {
                this.getTodoData();
            });
        },
        clearTodo(id) {
            axios.get(`delete/${id}`).then(res => {
                this.getTodoData();
            });
        },
        toggleTodo(id) {
            axios.get(`toggletodo`).then(res => {
                this.getTodoData();
            });
        },
        massClearTodo(id) {
            axios.get(`massdelete`).then(res => {
                this.getTodoData();
            });
        },
        renameTodo(todo) {
            this.form = todo;
        },
        updateRename() {
            axios.post("rename", this.form).then(res => {
                this.getTodoData();
                this.form = {};
            });
        }
    },
    mounted() {
        this.getTodoData();
    },
    created() {}
};
</script>
