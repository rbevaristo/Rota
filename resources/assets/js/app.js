/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('../../../node_modules/jquery/dist/jquery');
require('../../../node_modules/popper.js/dist/popper');
require('./bootstrap');
require('../../../node_modules/scrollreveal/dist/scrollreveal');
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('notification', require('./components/notification.vue'));

const app = new Vue({
    el: '#app',
    data: {
        messages: ''
    },
    created() {
        if (window.Laravel.userId) {
            axios.post('employee/dashboard/notifications/message/notification').then(response => {
                this.messages = response.data;

            });

            Echo.private('App.Employee.' + window.Laravel.userId).notification((response) => {
                data = { "data": response };
                this.messages.push(data);
            });
        }
    }
});