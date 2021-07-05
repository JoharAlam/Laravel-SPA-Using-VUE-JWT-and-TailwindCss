@extends('layouts.app')
@section('content')
	<head>
		<link href='site.css' rel='stylesheet' />
        <link rel="stylesheet" href="{{ asset('css/scrollbar-style.css') }}">
	</head>
	<body class="bg-white flex flex-col">
		@if(Auth::user())
			<div class="rounded-b-2xl shadow-xl bg-blue-500" style="height: 230px; margin-left: 256px;">
				<div class="flex pr-4 justify-end pt-2">
					<ul>
						<li id="profile-dropdown" class="text-gray-200 items-center justify-center mr-12">
							<a class="rounded-full dropdown-btn mr-5 shadow-2xl" style="width: 80px; height: 80px;">
							<img src="{{ asset('storage/'. Auth::user()->profile_pic) }}" alt="Profile Picture" class="p-1 bg-gray-200 rounded-full shadow" style="width: 80px; height: 80px;"><h6 class="mt-1 text-gray-100"> {{Auth::user()->name}}</h6></a>
							<div id="profile-dropdown-menu" class="p-1 bg-gray-200 hover:text-white rounded shadow-xl" style="display: none; position: absolute;">
								<a href="/user/profile" class="flex items-center text-black p-2 rounded hover:bg-blue-500 hover:text-white">
									<svg class="h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
									  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
									</svg>
									User Profile
				                </a>
								<a href="{{ route('logout') }}" class="flex items-center text-black p-2 rounded hover:bg-blue-500 hover:text-white" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
									<svg class="h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
								  		<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
									</svg>
									Logout
				                </a>
							</div>
						</li>
					</ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
				</div>
				<div class="h-auto rounded-2xl w-auto mr-8 pb-4" style="margin-left: 30px; margin-top: 27px;">
					<router-view></router-view>
				</div>
			</div>
			<div class="flex bg-gray-300">
				<div class="flex flex-1">
					<div class="shadow-xl w-80 h-full fixed-top">
						<div class='sidebar pin-topleft pin-bottomleft pin-topright'>
						  	<div class=' fill-white round sidebar-inner'>
						    	<div class='flex-scroll scroll-styled'>
						    		<div align="center" class="pt-2">
										<router-link id="logo" to="/dashboard">
											<svg class="text-blue-500 pt-6 pl-3" width="105px" height="100px" xmlns="http://www.w3.org/2000/svg" 
												viewBox="0 50 700.000000 500.000000">
									            <g transform="translate(0.000000,516.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
													<path d="M3275 4830 l-150 -150 1048 -1048 c576 -576 1047 -1052 1047 -1059 0	-7 -8 -18 -17 -26 -10 -7 -481 -477 -1047 -1044 l-1030 -1032 148 -147 147 -148 1202 1202 1202 1202 -1200 1200 -1200 1200 -150 -150z"/>
													<path class="fill-current" d="M1385 3773 l-1194 -1198 1197 -1197 1197 -1198 1192 1193 c656 655 1192 1198 1190 1205 -2 10 -2376 2392 -2385 2392 -2 0 -541 -539 -1197 -1197z m2669 -503 c63 -17 147 -50 164 -65 3 -3 -125 -275 -133 -283 -2 -2 -14 3 -27 11 -86 56 -324 86 -412 53 -33 -13 -47 -25 -55 -46 -19 -56 25 -87 232 -161 108 -39 156 -61 189 -87 9 -8 22 -11 28 -7 6 3 9 3 8 -2 -3 -10 71 -89 81 -86 4 1 7 -6 8 -15 1 -9 11 -44 23 -77 17 -47 20 -71 15 -115 -27 -218 -167 -363	-393 -406 -96 -18 -283 -18 -402 1 -103 17 -139 27 -212 57 l-47 20 70 139 c38 76 74 139 80 139 5 0 22 -6 38 -14 60 -32 195 -59 291 -59 153 -1 220 30	220 99 0 49 -38 72 -245 143 -258 90 -363 220 -336 417 26 183 157 312 365 360 92 21 347 12 450 -16z m-2567 -22 c-4 -18 -9 -78 -12 -133 -8 -137 -57 -697 -85 -980 -5 -49 -10 -102 -10 -117 l0 -28 -171 0 -171 0 7 113 c3 61 15 211 25 332 11 121 24 274 30 340 20 227 41 440 46 473 l5 32 171 0 170 0 -5 -32z m650 -208 c75 -129 157 -275 183 -323 l47 -88 37 63 c20 35 56 89 79 120 50 67 247 340 298 412 l35 51 152 3 152 3 0 -24 c0 -13 -6 -91 -14 -173 -8	-82 -18 -192 -21 -244 -3 -52 -10 -131 -15 -175 -5 -44 -12 -116 -15 -160 -8 -105 -25 -301 -30 -345 -2 -19 -7 -65 -11 -102 l-6 -68 -173 0 -173 0 4 43	c17 185 45 505 49 562 l5 70 -22 -29 c-13 -15 -91 -119 -173 -230 l-151 -201 -59 0 -59 0 -54 85 c-29 47 -56 91 -59 99 -4 8 -43 74 -88 146 l-81 132 -2 -44 c-2 -45 -37 -458 -48 -570 l-7 -63 -163 0 -164 0 0 26 c0 15 7 97 15 183	8 86 23 264 35 396 27 320 27 321 40 470 6 72 13 139 15 150 2 11 4 30 4 43 l1 23 151 -3 152 -3 134 -235z"/>
												</g>
									        </svg>
									    </router-link>
									</div>
									<ul class="pl-6 pr-6 pt-10">
										<li class="rounded hover:bg-blue-500">
											<router-link id="dashboard" to="/dashboard" class="flex items-center px-3 py-2 my-3 pl-2 text-gray-600 hover:text-white"
											exact>
												<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
												  <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
												  <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
												</svg>
												Dashboard
											</router-link>
										</li>
										<li class="rounded" id="sale-dropdown" >
										  	<button id="sale-btn" class="flex dropdown-btn items-center px-3 py-2 my-1 w-full text-gray-600 hover:text-white rounded hover:bg-blue-500">
										  		<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
												  <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
												</svg>
										  		Sale
										  		<i class="fa fa-caret-down ml-1"></i>
										  	</button>

											<div class="bg-gray-200 rounded shadow-xl p-1" id="sale-dropdown-menu" style="display: none;">
												<router-link to="/inventory/sale" class="flex items-center px-3 py-2 my-1 text-gray-600 hover:text-white rounded hover:bg-blue-500">
													<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
													  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
													  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
													</svg>
													Sale Detail
												</router-link>
												<router-link to="/add/sale" class="flex items-center px-3 py-2 my-1 text-gray-600 hover:text-white rounded hover:bg-blue-500">
													<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
													  <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd" />
													</svg>
													Add Sale
												</router-link>
												<router-link to="/return/sales" class="flex items-center px-3 py-2 my-1 text-gray-600 hover:text-white rounded hover:bg-blue-500">
													<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
													  <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm4.707 3.707a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L8.414 9H10a3 3 0 013 3v1a1 1 0 102 0v-1a5 5 0 00-5-5H8.414l1.293-1.293z" clip-rule="evenodd" />
													</svg>
													Sales Return
												</router-link>
												<router-link to="/monthly/record" class="flex items-center px-3 py-2 my-1 text-gray-600 hover:text-white rounded hover:bg-blue-500">
													<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
													  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
													</svg>
													Monthly Sale
												</router-link>
												<router-link to="/yearly/record" class="flex items-center px-3 py-2 my-1 text-gray-600 hover:text-white rounded hover:bg-blue-500 rounded hover:bg-blue-500">
													<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
													  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
													</svg>
													Yearly Sale
												</router-link>
												<router-link to="/customers" class="flex items-center px-3 py-2 my-1 text-gray-600 hover:text-white rounded hover:bg-blue-500">
													<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
													  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
													</svg>
													Customers
												</router-link>
											</div>
										</li>
										<li class="rounded" id="purchase-dropdown" >
										  	<button id="purchase-btn" class="flex dropdown-btn items-center px-3 py-2 my-3 w-full text-gray-600 hover:text-white rounded hover:bg-blue-500">
										  		<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
												  <path d="M4 3a2 2 0 100 4h12a2 2 0 100-4H4z" />
												  <path fill-rule="evenodd" d="M3 8h14v7a2 2 0 01-2 2H5a2 2 0 01-2-2V8zm5 3a1 1 0 011-1h2a1 1 0 110 2H9a1 1 0 01-1-1z" clip-rule="evenodd" />
												</svg>
										  		Purchase
										  		<i class="fa fa-caret-down ml-1"></i>
										  	</button>

											<div class="bg-gray-200 rounded shadow-xl p-1" id="purchase-dropdown-menu" style="display: none;">
												<router-link to="/inventory/purchase" class="flex items-center px-3 py-2 my-1 text-gray-600 hover:text-white rounded hover:bg-blue-500">
													<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
													  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
													  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
													</svg>
													Purchase Detail
												</router-link>
												<router-link to="/add/purchase" class="flex items-center px-3 py-2 my-1 text-gray-600 hover:text-white rounded hover:bg-blue-500">
													<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
													  <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd" />
													</svg>
													Add Purchase
												</router-link>
												<router-link to="/return/purchases" class="flex items-center px-3 py-2 my-1 text-gray-600 hover:text-white rounded hover:bg-blue-500">
													<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
													  <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v14l3.5-2 3.5 2 3.5-2 3.5 2V4a2 2 0 00-2-2H5zm4.707 3.707a1 1 0 00-1.414-1.414l-3 3a1 1 0 000 1.414l3 3a1 1 0 001.414-1.414L8.414 9H10a3 3 0 013 3v1a1 1 0 102 0v-1a5 5 0 00-5-5H8.414l1.293-1.293z" clip-rule="evenodd" />
													</svg>
													Purchase Return
												</router-link>
												<router-link to="/retailers" class="flex items-center px-3 py-2 my-1 text-gray-600 hover:text-white rounded hover:bg-blue-500 rounded hover:bg-blue-500">
													<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
													  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
													</svg>
													Retailers
												</router-link>
											</div>
										</li>
										<li class="rounded hover:bg-blue-500">
											<router-link id="stock" to="/stock/record" class="flex items-center px-3 py-2 my-3 pl-2 text-gray-600 hover:text-white" exact>
												<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
												  <path d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
												</svg>
												Stock
											</router-link>
										</li>
										<li class="rounded hover:bg-blue-500">
											<router-link id="products" to="/products" class="flex items-center px-3 py-2 my-3 pl-2 text-gray-600 hover:text-white rounded hover:bg-blue-500">
												<svg class="h-4 pr-2" version="1.0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45.000000 45.000000"
												 preserveAspectRatio="xMidYMid meet">
													<g  class="fill-current" transform="translate(0.000000,45.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
														<path d="M113 403 l-103 -35 0 -184 0 -184 220 0 220 0 0 184 0 184 -108 36
														c-59 20 -112 36 -117 35 -6 0 -56 -16 -112 -36z m267 -248 c0 -128 -1 -135
														-20 -135 -17 0 -20 7 -20 50 l0 50 -50 0 -50 0 0 -50 c0 -27 -4 -50 -10 -50
														-5 0 -10 23 -10 50 l0 50 -50 0 -50 0 0 -50 c0 -43 -3 -50 -20 -50 -19 0 -20
														7 -20 135 l0 135 150 0 150 0 0 -135z"/>
														<path d="M180 190 l0 -50 50 0 50 0 0 50 0 50 -50 0 -50 0 0 -50z"/>
													</g>
												</svg>
												Products
											</router-link>
										</li>
										<li class="rounded hover:bg-blue-500">
											<router-link id="about" to="/about" class="flex items-center px-3 py-2 my-3 pl-2 text-gray-600 hover:text-white">
												<svg class="h-4 pr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
											  		<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
												</svg>
												About
											</router-link>
										</li>
										<li></li>
										<input type="hidden" id="url" value="{{$_SERVER['REQUEST_URI']}}" name="">
									</ul>
								</div>
					  		</div>
						</div>
					</div>
				</div>
			</div>
		@else
			<div class="rounded-b-2xl shadow-2xl flex bg-blue-500" style="height: 230px; z-index: -1;">
				<div class="text-3xl mx-auto h-full items-center" style="margin-top: 300px;">
					Please <a href="{{route('login')}}">Login</a> or <a href="{{route('register')}}">Register </a>First to Access the Site!
				</div>
			</div>
		@endif
	</body>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		if($("#url").val() == '/inventory/sale' || $("#url").val() == '/add/sale' || $("#url").val() == '/monthly/record' || $("#url").val() == '/yearly/record' || $("#url").val() == '/customers' || $("#url").val() == '/return/sales')
		{
			$('#sale-btn').addClass("active");
			$("#sale-dropdown-menu").slideDown("fast");
		}

		if($("#url").val() == '/inventory/purchase' || $("#url").val() == '/add/purchase' || $("#url").val() == '/retailers' || $("#url").val() == '/return/purchases')
		{
			$('#purchase-btn').addClass("active");
		 	$("#purchase-dropdown-menu").slideDown("fast");
		}

        $(document).on("click", function(event){
	        var sale = $("#sale-dropdown");
	        var purchase = $("#purchase-dropdown");
	        var profile = $("#profile-dropdown");
	        var logo = $("#logo");
	        var dashboard = $("#dashboard");
	        var stock = $("#stock");
	        var products = $("#products");
	        var about = $("#about");

	        if(profile !== event.target && !profile.has(event.target).length){
	        	$("#profile-dropdown-menu").slideUp("fast");
	        }
	        else
	        {
	        	localStorage['key'] = 'profile';
	        }

	        if(dashboard[0] == event.target || stock[0] == event.target || products[0] == event.target || about[0] == event.target)
	        {
	        	console.log('remove');
	        	$('#sale-btn').removeClass("active");
	        	$('#purchase-btn').removeClass("active");
	        	$("#sale-dropdown-menu").slideUp("fast");
	        	$("#purchase-dropdown-menu").slideUp("fast");
	        }
	        else
	        {
		        if(sale !== event.target && !sale.has(event.target).length){
		        	$("#sale-dropdown-menu").slideUp("fast");
		        }
		        else
		        {
		        	$('#sale-btn').addClass("active");
	        		$('#purchase-btn').removeClass("active");
		        	localStorage['key'] = 'sale';
		        }

		        if(purchase !== event.target && !purchase.has(event.target).length){
		        	$("#purchase-dropdown-menu").slideUp("fast");
		        }
		        else
		        {
		        	$('#purchase-btn').addClass("active");
		        	$('#sale-btn').removeClass("active");
		        	localStorage['key'] = 'purchase';
		        }
	        }
    	});
    });

	function editCustomer(id) {
		$("#id").val(id);
	}

	function customerName(name) {
		$("#customer_name").val(name);
		document.getElementById("received").focus();
	}

	function editRetailer(id) {
		$("#id").val(id);
	}

	function retailerName(name) {
		$("#retailer_name").val(name);
		document.getElementById("received").focus();
	}

	function show(id)
	{
        localStorage.setItem('productID', id);
        window.location.href = '/show/product';
    }

    function edit(id)
    {
        localStorage.setItem('productID', id);
        window.location.href = '/edit/product';
    }

    function Id(id)
    {
    	console.log(id);
    	$("#id").val(id);
    	
    }

    function Name(name) {
		$("#name").val(name);
	}

	function Product(product) {
		$("#product").val(product);
		if($("#url").val() == '/return/sales')
		{
			document.getElementById("status").focus();
		}
		else
		{
			document.getElementById("return").focus();
		}
	}
</script>
