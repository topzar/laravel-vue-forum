
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.$http = require('axios');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('follow-question-button', require('./components/FollowQuestionButton.vue'));
Vue.component('user-follow-button', require('./components/UserFollowButton.vue'));
Vue.component('votes-answer', require('./components/VoteForAnswer.vue'));
Vue.component('send-message', require('./components/SendMessage.vue'));
Vue.component('comment', require('./components/Comment.vue'));
Vue.component('user-avatar', require('./components/Avatar.vue'));

const app = new Vue({
    el: '#app'
});
