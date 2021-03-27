@extends('layouts.app')
@section('content')
	<body class="bg-black flex flex-col">
		<div class="h-0.5 bg-pink-800"></div>
		<div class="h-2"></div>
		<div class="text-white ml-5 h-12 flex items-center justify-between">
			<div class="px-4">
				<h1 class="pl-3 text-xl">VUE-SPA Dashboard</h1>
			</div>
			<div class="flex items-center px-4">
				<div>User Name</div>
				<div class="ml-2">
					<img src="./avatar.png" alt="" class="h-8 rounded-full border">
					<svg class="ml-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 50 24" stroke="currentColor">
					  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
					</svg>
				</div>
			</div>
		</div>
		<div class="flex">
		<div class="flex flex-1 pl-5 pt-5">
			<div class="bg-pink-800 text-gray-200 p-8 w-80 rounded-md h-full fixed">
				<ul>
					<li class="flex items-center px-4 py-2 my-3">
						<svg class="h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
						  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
						</svg>
						<router-link to="/dashboard/shoes" class="pl-2 text-gray-200 hover:text-gray-400">
							Dashboard
						</router-link>
					</li>
					<li class="flex items-center px-4 py-2 my-3">
						<svg class="h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
						</svg>
						<router-link to="/inventory/sale" class="pl-2 text-gray-200 hover:text-gray-400">
							Inventory
						</router-link>
					</li>
					<li class="flex items-center px-4 py-2 my-3">
						<svg class="h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
						</svg>
						<router-link to="/about" class="pl-2 text-gray-200 hover:text-gray-400">
							About
						</router-link>
					</li>
				</ul>
			</div>
		</div>
		<div class="h-screen w-responsive pt-5 pr-3">
				<router-view></router-view>
			</div>
		</div>
	</body>
@endsection
