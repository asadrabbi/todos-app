/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    data: {
        form: {
            name: ""
        },
        todos: [],
        totalCount: 0,
        completedCount: 0,
        activeCount: 0
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
        }
    },
    mounted() {
        this.getTodoData();
    }
});
