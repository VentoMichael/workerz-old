/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
//
//Vue.component('conversation-button', require('./components/ConversationButton.vue').default);
//Vue.component('conversation-content', require('./components/ConversationContent.vue').default);
//Vue.component('conversation-message', require('./components/ConversationMessage.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//const app = new Vue({
//    el: '#app',
//    data: {
//        messages: [],
//    },
//    methods: {
//        saveMessage(e) {
//            console.log(e)
//            axios.post('/dashboard/messages/coiffeurbellhair', {message:e})
//                .then(
//                    response => {
//                        console.log(error.response.data)
//                    })
//                .catch(error => {
//                    console.log(error.response.data)
//                })
//        }
//    },
//    created(){
//        console.log(this.to_id)
//        axios.get('/dashboard/messages/coiffeurbellhair')
//            .then(response =>{
//                this.messages = response.data
//            })
//            .catch(error => {
//                console.log(error)
//            })
//        Echo.join('conversation').listen('.message.created',e =>{
//            this.messages.push(e.message)
//        })
//    }
//});
