require('./bootstrap');

import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import VueRouter from 'vue-router'
import routes from './routes'


Vue.use(BootstrapVue)
Vue.use(VueRouter)


const router = new VueRouter({
routes})
  
import App from './vue/app'

const app = new Vue ({
    el: '#app',
    router: router,
    components: { App }
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
      if (localStorage.getItem('access_token') === null ) {
        next({
          name: 'Login',
        })
      } else {
        next()
      }
    } else if (to.matched.some(record => record.meta.requiresVisitor)) {
      if (localStorage.getItem('access_token') !== null) {
        next({
          name: 'Home',
        })
      } else {
        next()
      }
    } else {
      next()
    }
})