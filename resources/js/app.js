
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Notifications from 'vue-notification'
import moment from 'moment'
import {ClientTable, ServerTable, Event} from 'vue-tables-2';
import StarRating from 'vue-star-rating';


Vue.use(Notifications);
Vue.use(ClientTable, {}, false, 'bootstrap4','default');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('star-rating', StarRating);
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('video-component', require('./components/video.vue'));
Vue.component('video-details', require('./components/VideoDetails.vue'));
Vue.component('dashboard-index', require('./components/dashboard/Index.vue'));
Vue.component('admin-index', require('./components/admin/Index.vue'));


Vue.prototype.moment = moment;


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
