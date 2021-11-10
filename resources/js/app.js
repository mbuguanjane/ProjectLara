/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');
 require('admin-lte');
 
 window.Vue = require('vue').default;
 
 import VueRouter from 'vue-router'
 import { Form} from 'vform'
 import Vue from 'vue';
 import VueProgressBar from 'vue-progressbar'
 import Gate from "./Gate"
 Vue.component('pagination', require('laravel-vue-pagination'));
 
 
 Vue.prototype.$gate=new Gate(window.user);
 
 Vue.use(VueProgressBar, {
   color: 'rgb(143, 255, 199)',
   failedColor: 'red',
   height: '4px'
 })
 
 import moment from 'moment';
 
 Vue.filter('myDate',function(created){
        return moment(created).format('MMMM Do YYYY, h:mm:ss a');
 })
 // ES6 Modules or TypeScript
 import Swal from 'sweetalert2'
 
 // CommonJS
 window.Swal = Swal
 
 const Toast = Swal.mixin({
   toast: true,
   position: 'top-end',
   showConfirmButton: false,
   timer: 3000,
   timerProgressBar: true,
   didOpen: (toast) => {
     toast.addEventListener('mouseenter', Swal.stopTimer)
     toast.addEventListener('mouseleave', Swal.resumeTimer)
   }
 })
 
 window.toast=Toast;
 
 //Fire eventd
 window.Fire=new Vue();
 //end Events
 window.Form=Form;
 Vue.use(VueRouter);
 
 let routes = [
     { path: '/Dashboard', component: require('./components/Dashboard.vue').default },
     { path: '/home', component: require('./components/Dashboard.vue').default },
     { path: '/profile', component: require('./components/profile.vue').default },
     { path: '/management', component: require('./components/Management.vue').default },
     { path: '/users', component: require('./components/users.vue').default },
     { path: '/Internship', component: require('./components/Internships.vue').default },
     { path: '*', component: require('./components/NotFound.vue').default },
     
   ]
 
   const router = new VueRouter({
     mode: 'history',
     routes // short for `routes: routes`
   })
 
   
 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */
 
 // const files = require.context('./', true, /\.vue$/i)
 // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
 Vue.component('Internship', require('./components/Internships.vue').default);
 Vue.component('example-component', require('./components/ExampleComponent.vue').default);
 Vue.component('NotFound', require('./components/NotFound.vue').default);
 
 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */
 
 const app = new Vue({
     el: '#app',
     router,
     data: () => ({
       
       search:''
     }),
     methods:{
       clearsearch(){
         this.search = ""
       },
 
       searchit: _.debounce(()=>{
         Fire.$emit('searching');
         
         console.log('Searching..');
       },1000),
 
      
      
     }
 });
 