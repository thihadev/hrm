
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
// Vue.component('chat-message', require('./components/ChatMessage.vue'));
// Vue.component('chat-log',require('./components/ChatLog.vue'));
// Vue.component('chat-composer',require('./components/ChatComposer.vue'));
Vue.component('chat-messages', require('./components/ChatMessages.vue'));
Vue.component('chat-form', require('./components/ChatForm.vue'));
// Vue.component('chat-list',require('./components/ChatList.vue'));
// Vue.component('chat-create',require('./components/ChatCreate.vue'));


const app = new Vue({
    el: '#app',

    data: {
        messages: []
    },

    created() {
        this.fetchMessages();

            Echo.presence('chatroom')
            .listen('MessagePosted', (e) => {
            this.messages.push({
            message: e.message.message,
            user: e.user
        });
      });
    },


    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.messages = response.data;
            });
        },

        addMessage(message) {
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
              console.log(response.data);
            });
        }

    }
});


// const app = new Vue({
//     el: '#app',

//     data: {
//          messages: [],
//          roomCount: []
//     },
//     methods: {
//      addMessage(message) {
//          this.messages.push(message);

//          axios.post('/messages', message).then(response => {

//          });
//      }
//     },
//     created() {
//      axios.get('/messages').then(response => {
//          this.messages = response.data;
//      });


//      Echo.join('chatroom')
//          .here((users) => {
//                  this.roomCount = users;
//              })
//          .joining((user) => {
//                  this.roomCount.push(user);
//              })
//          .leaving((user) => {
//                  this.roomCount = this.roomCount.filter(u => u != user);
//              })
//          .listen('MessagePosted', (e) => {
//                  this.messages.push({
//                  message: e.message.message,
//                  user: e.user
//              });
//      });
//     }
// });
