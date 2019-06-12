require('./bootstrap');

//import Vue from 'vue'
import VueRouter from 'vue-router'
import moment from 'moment'
import Datetime from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'

window.Form=Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.use(Datetime)

Vue.component('pagination', require('laravel-vue-pagination'));

import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);

import Swal from 'sweetalert2'
window.Swal=Swal;

const toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.toast = toast;

Vue.use(VueRouter)

const routes = [
  { path: '/dashboard', component: require('./components/Dashboard.vue').default },
  { path: '/profile', component: require('./components/Profile.vue').default },
  { path: '/users', component: require('./components/Users.vue').default },
  { path: '/developer', component: require('./components/Developer.vue').default },
  { path: '/slots', component: require('./components/Slots.vue').default },
  { path: '*', component: require('./components/NotFound.vue').default },
]

const router = new VueRouter({
  mode: 'history',
  routes // short for `routes: routes`
})

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '3px'
})

Vue.filter('capitalize', function (value) {
  if (!value) return ''
  value = value.toString()
  return value.charAt(0).toUpperCase() + value.toLowerCase().slice(1)
})

Vue.filter('myDate', function(created){
    return moment(created).format("MMM Do YYYY, h:mm a");
})

window.Fire = new Vue();

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

// Vue.component(
//     'not-found',
//     require('./components/Notfound.vue').default
// );

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router,
    data:{
      search: ''
    },
    methods:{
      searchit()
      {
          Fire.$emit('searching');
      },

      printme(){
        window.print();
      }
    }
});
