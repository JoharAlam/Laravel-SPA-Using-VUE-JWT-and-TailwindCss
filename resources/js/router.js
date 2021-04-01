// import Vue from 'vue';
// import VueRouter from 'vue-router';
import Dashboard from './components/Dashboards/Dashboard';

import AddSale from './components/Inventory/AddSale';
import Customers from './components/Inventory/Customers';
import InventorySale from './components/Inventory/InventorySale';

import AddPurchase from './components/Inventory/AddPurchase';
import Retailers from './components/Inventory/Retailers';
import InventoryPurchase from './components/Inventory/InventoryPurchase';

import Products from './components/Product/Products';
import ShowProduct from './components/Product/ShowProduct';
import EditProduct from './components/Product/EditProduct';

import UserProfile from './components/User/UserProfile';
import EditProfile from './components/User/EditProfile';

import SalesReturn from './components/ProductReturn/SalesReturn';
import PurchaseReturn from './components/ProductReturn/PurchaseReturn';

import Stock from './components/Record/Stock';
import Monthly from './components/Record/Monthly';
import Yearly from './components/Record/Yearly';
import About from './components/About';

export default{
	mode: 'history',
	linkActiveClass: 'bg-blue-500 rounded text-white',
	routes: [
		{ 
			path: '/dashboard', 
			component: Dashboard
		},
		{ 
			path: '/add/sale', 
			component: AddSale
		},
		{ 
			path: '/add/purchase', 
			component: AddPurchase
		},
		{ 
			path: '/inventory/sale', 
			component: InventorySale
		},
		{ 
			path: '/inventory/purchase', 
			component: InventoryPurchase
		},
		{ 
			path: '/stock/record', 
			component: Stock
		},
		{ 
			path: '/monthly/record', 
			component: Monthly
		},
		{ 
			path: '/yearly/record', 
			component: Yearly
		},
		{ 
			path: '/about', 
			component: About
		},
		{ 
			path: '/customers', 
			component: Customers
		},
		{ 
			path: '/retailers', 
			component: Retailers
		},
		{ 
			path: '/products', 
			component: Products
		},
		{ 
			path: '/show/product', 
			component: ShowProduct
		},
		{ 
			path: '/edit/product', 
			component: EditProduct
		},
		{ 
			path: '/user/profile', 
			component: UserProfile
		},
		{ 
			path: '/edit/profile', 
			component: EditProfile
		},
		{ 
			path: '/return/sales', 
			component: SalesReturn
		},
		{ 
			path: '/return/purchases', 
			component: PurchaseReturn
		}
	],
}