// import Vue from 'vue';
// import VueRouter from 'vue-router';
import ShoesDashboard from './components/ShoesDashboard';
import GarmentsDashboard from './components/GarmentsDashboard';
import About from './components/About';
import NotFound from './components/NotFound';
import Login from './components/Login';
import Register from './components/Register';
import Reset from './components/PasswordReset';
import InventorySale from './components/InventorySale';
import InventoryPurchase from './components/InventoryPurchase';

export default{
	mode: 'history',
	routes: [
		{ 
			path: '/dashboard/Shoes', 
			component: ShoesDashboard
		},
		{ 
			path: '/dashboard/Garments', 
			component: GarmentsDashboard
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
		},
		{ 
			path: '/inventory/sale', 
			component: InventorySale
		},
		{ 
			path: '/inventory/purchase', 
			component: InventoryPurchase
		}
	],
}