@extends('layouts.app')

@section('content')
<div class="rounded-b-2xl shadow-2xl flex bg-blue-500" style="height: 230px; z-index: -1;">
	<div class="mx-auto h-full flex justify-center items-center bg-white" style="margin-top: 185px;">
		<div class="bg-gray-300 p-3 rounded-2xl shadow-xl">
		    <div class="w-96 bg-white rounded-2xl shadow-2xl pr-6 pl-6 pt-4 pb-4">
		        <svg class="text-blue-500 pl-6" width="120px" xmlns="http://www.w3.org/2000/svg" 
					viewBox="0 0 600.000000 500.000000">
		            <g transform="translate(0.000000,516.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none">
						<path d="M3275 4830 l-150 -150 1048 -1048 c576 -576 1047 -1052 1047 -1059 0
						-7 -8 -18 -17 -26 -10 -7 -481 -477 -1047 -1044 l-1030 -1032 148 -147 147
						-148 1202 1202 1202 1202 -1200 1200 -1200 1200 -150 -150z"/>
						<path class="fill-current" d="M1385 3773 l-1194 -1198 1197 -1197 1197 -1198 1192 1193 c656 655 1192 1198 1190 1205 -2 10 -2376 2392 -2385 2392 -2 0 -541 -539 -1197 -1197z m2669 -503 c63 -17 147 -50 164 -65 3 -3 -125 -275 -133 -283 -2 -2 -14 3 -27 11 -86 56 -324 86 -412 53 -33 -13 -47 -25 -55 -46 -19 -56 25 -87 232 -161 108 -39 156 -61 189 -87 9 -8 22 -11 28 -7 6 3 9 3 8 -2 -3 -10 71 -89 81 -86
						4 1 7 -6 8 -15 1 -9 11 -44 23 -77 17 -47 20 -71 15 -115 -27 -218 -167 -363 -393 -406 -96 -18 -283 -18 -402 1 -103 17 -139 27 -212 57 l-47 20 70 139	c38 76 74 139 80 139 5 0 22 -6 38 -14 60 -32 195 -59 291 -59 153 -1 220 30 220 99 0 49 -38 72 -245 143 -258 90 -363 220 -336 417 26 183 157 312 365 360 92 21 347 12 450 -16z m-2567 -22 c-4 -18 -9 -78 -12 -133 -8 -137 -57 -697 -85 -980 -5 -49 -10 -102 -10 -117 l0 -28 -171 0 -171 0 7 113 c3 61 15 211 25 332 11 121 24 274 30 340 20 227 41 440 46 473 l5 32 171 0 170 0 -5 -32z m650 -208 c75 -129 157 -275 183 -323 l47 -88 37 63 c20 35 56 89 79 120 50 67 247 340 298 412 l35 51 152 3 152 3 0 -24 c0 -13 -6 -91 -14 -173 -8 -82 -18 -192 -21 -244 -3 -52 -10 -131 -15 -175 -5 -44 -12 -116 -15 -160 -8 -105 -25 -301 -30 -345 -2 -19 -7 -65 -11 -102 l-6 -68 -173 0 -173 0 4 43 c17 185 45 505 49 562 l5 70 -22 -29 c-13 -15 -91 -119 -173 -230 l-151 -201 -59 0 -59 0 -54 85 c-29 47 -56 91 -59 99 -4 8 -43 74 -88 146 l-81 132 -2 -44 c-2 -45 -37 -458 -48 -570 l-7 -63 -163 0 -164 0 0 26 c0 15 7 97 15 183 8 86 23 264 35 396 27 320 27 321 40 470 6 72 13 139 15 150 2 11 4 30 4 43	l1 23 151 -3 152 -3 134 -235z"/>
					</g>
		        </svg>
		        <h1 class="text-gray-600 text-3xl pt-8">Welcome Back</h1>
		        <h6 class="text-blue-500 font-bold">Enter your login credentials below</h6>

		        <form method="POST" action="{{ route('login') }}" class="pt-6">
		            @csrf
		            <div class="relative">
		                <label for="email" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2"><i class="fa fa-envelope"></i> E-mail</label>
		                <input id="email" type="email" class="pt-4 w-full rounded p-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" name="email" value="{{ old('email') }}" placeholder="your@email.com" autocomplete="email" autofocus>

		                @error('email')
		                    <span class="text-red-500 text-sm pl-3" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
		            </div>

		            <div class="relative pt-3">
		                <label for="password" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2"><i class="fas fa-lock"></i> Password</label>
		                <input id="password" type="password" class="pt-4 w-full rounded p-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" name="password" placeholder="********" autocomplete="current-password">
		                @error('password')
		                    <span class="text-red-500 text-sm pl-3" role="alert">
		                        <strong>{{ $message }}</strong>
		                    </span>
		                @enderror
		            </div>

		            <div class="pt-3">
		                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
		                <label class="text-blue-500 font-bold" for="remember">
		                    {{ __('Remember Me') }}
		                </label>
		            </div>

		            <div class="pt-3">
		                <button type="submit" class="w-full uppercase rounded text-left text-white bg-blue-500 py-2 px-3 font-bold">
		                    {{ __('Login') }}
		                </button>
		            </div>

		            <div class="flex justify-between pt-8 text-sm font-bold">
		                <a href="{{ route('password.request') }}" class="text-blue-500">
		                    Forgot Your Password?
		                </a>
		                <a href="{{ route('register') }}" class="text-blue-500">
		                    Register
		                </a>
		            </div>
		        </form>
		    </div>
		</div>
	</div>
</div>
@endsection
