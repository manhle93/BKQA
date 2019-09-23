/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');
import Vue           from 'vue'
import Notifications from 'vue-notification'
import VueSweetalert2 from 'vue-sweetalert2';

import FlashMessage from '@smartweb/vue-flash-message';
 
// If you don't need the styles, do not connect
import 'sweetalert2/dist/sweetalert2.min.css';
 
Vue.use(VueSweetalert2);
Vue.use(FlashMessage);

 
/*
or for SSR:
import Notifications from 'vue-notification/dist/ssr.js'
*/
 
Vue.use(Notifications)
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('nhap-cauhoi', require('./components/NhapCauhoi.vue').default);
Vue.component('tatca-cauhoi', require('./components/TatCaCauHoi.vue').default);
Vue.component('binh-luan', require('./components/BinhLuan.vue').default);
Vue.component('cauhoi-chude', require('./components/CauHoiChuDe.vue').default);
Vue.component('trang-chu', require('./components/TrangChu.vue').default);
Vue.component('tim-kiem', require('./components/TimKiem.vue').default);
Vue.component('tai-khoan', require('./components/TaiKhoan.vue').default);
Vue.component('ca-nhan', require('./components/CaNhan.vue').default);
Vue.component('ketqua-timkiem', require('./components/KetQuaTimKiem.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
