// import Vue from 'vue';
// import VueRouter from 'vue-router';
import Dashboard from './components/Dashboard';
import About from './components/About';
import NotFound from './components/NotFound';
import Login from './components/Login';
import Register from './components/Register';
import Reset from './components/PasswordReset';

export default{
	mode: 'history',
	linkActiveClass: 'font-bold',
	routes: [
		{ 
			path: '/dashboard', 
			component: Dashboard
		},
		{ 
			path: '/about', 
			component: About
		},
		{ 
			path: '/login', 
			component: Login
		},
		{ 
			path: '/register', 
			component: Register
		}
	],
}