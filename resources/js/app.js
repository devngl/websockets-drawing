import Vue from 'vue';
import store from '@/js/store'
window.Vue = Vue;

require('./bootstrap');

Vue.component('whiteboard', require('./components/Whiteboard'));
Vue.component('color-picker', require('./components/ColorPicker'));
Vue.component('tool-picker', require('./components/ToolPicker'));

const app = new Vue({
    el: '#app',
    store,
});
