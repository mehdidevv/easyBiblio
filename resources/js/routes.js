import Home from './vue/Home'
import MyBooks from './vue/MyBooks'
import About from './vue/About'
import Login from './vue/auth/Login'
import Register from './vue/auth/Register'
import Logout from './vue/auth/Logout'

const routes = [
    {
      path: '/',
      name: 'Home',
      component: Home,
    },
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta: {
        requiresVisitor: true,
      }
    },
    {
      path: '/logout',
      name: 'Logout',
      component: Logout,
      meta: {
        requiresAuth: true,
      }
    },
    {
      path: '/register',
      name: 'Register',
      component: Register,
      meta: {
        requiresVisitor: true,
      }
    },
    {
      path: '/mybooks',
      name: 'MyBooks',
      component: MyBooks,
      meta: {
        requiresAuth: true,
      }
    },
    {
      path: '/about',
      name: 'About',
      component: About
    },
    
    
  ]
export default routes
