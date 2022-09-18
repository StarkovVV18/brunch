//VUE
import Vue from 'vue';
import VueRouter from 'vue-router';
import App from './App.vue';
//VUEX
// import store from './components/store/store.js';
//SEMANTIC UI
import 'semantic-ui-css/semantic.min.css';
import SuiVue from 'semantic-ui-vue';
//VUETIFY
import vuetify from './plugins/vuetify.js';
//AXIOS
import Axios from 'axios';
// import Convert from './components/reagent/convert.js';
//COMPONENTS
// import Login from "./components/auth/login.vue";
// import Singup from "./components/auth/singup.vue";
import Users from "./components/index.vue";

Vue.prototype.$http = Axios;
// Vue.prototype.$convert = Convert;
// const token = localStorage.getItem('token');
// if(token){
//   Vue.prototype.$http.defaults.headers.common['Authorization'] = 'Bearer ' + token;
// }
if(process.env.NODE_ENV === 'production') Vue.prototype.$http.defaults.baseURL = 'http://192.168.0.156';
Vue.prototype.$http.defaults.baseURL = 'http://brunch.dev';

Vue.use(SuiVue);
Vue.use(VueRouter);

var router = new VueRouter({
  mode: 'history',
  routes: [
    { path: '/', component: Users, meta: { name: 'users'} }
  ]
});

new Vue({
  el: '#app',
  router: router,
  render: h => h(App),
  vuetify
})
