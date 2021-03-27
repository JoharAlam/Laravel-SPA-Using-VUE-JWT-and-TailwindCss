<template>
	<div class="mx-auto h-screen flex justify-center items-center bg-gray-300">
    <div class="w-96 bg-blue-900 rounded-lg shadow-xl p-6">
        <svg class="fill-current" width="100px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1754.000000 1241.000000">
            <g transform="translate(0.000000,1241.000000) scale(0.100000,-0.100000)">
                <path d="M10970 10119 c-30 -5 -89 -26 -130 -46 -69 -33 -101 -62 -385 -343 -303 -299 -442 -426 -655 -601 -701 -573 -1435 -1024 -2034 -1249 -161 -60 -203 -64 -240 -20 -46 55 -46 47 14 1156 39 703 39 717 13 774 -23 51 -85 112 -140 136 -62 28 -161 22 -278 -16 -236 -76 -378 -180 -392 -289 -3 -20 11 -220 31 -446 97 -1108 113 -1712 51 -1860 -7 -17 -91 -132 -187 -255 -912 -1175 -1181 -1604 -1371 -2195 -227 -706 -220 -1463 18 -1960 235 -489 706 -717 1176 -569 378 119 603 383 784 917 216 639 324 1649 325 3047 0 307 14 586 32 658 10 40 28 64 132 170 67 68 150 148 186 177 133 107 147 101 106 -53 -66 -246 -70 -274 -70 -477 -1 -209 11 -281 74 -442 91 -237 308 -465 555 -583 219 -105 489 -158 675 -131 293 41 556 185 715 392 164 212 242 539 215 899 -34 454 -144 725 -413 1020 -162 178 -160 175 -152 207 10 42 222 247 625 605 195 173 371 332 389 352 39 40 60 45 83 19 32 -36 38 -96 38 -378 0 -390 -24 -771 -76 -1215 -24 -206 -42 -319 -118 -751 -103 -586 -130 -778 -130 -939 -1 -271 31 -355 158 -420 65 -33 76 -35 181 -39 121 -3 220 13 305 50 106 47 125 101 116 328 -21 551 -22 513 25 1006 29 304 157 1256 170 1270 17 17 266 9 454 -14 287 -37 423 -22 461 51 27 49 32 236 9 314 -23 82 -43 101 -118 109 -105 12 -323 54 -531 102 -183 43 -199 49 -209 73 -6 15 -13 194 -18 455 -11 661 -32 783 -155 915 -75 80 -185 111 -314 89z m-1732 -2743 c81 -42 151 -150 187 -286 22 -87 31 -314 16 -421 -34 -242 -113 -394 -235 -456 -42 -22 -64 -26 -129 -26 -66 0 -86 5 -141 32 -142 70 -213 208 -237 464 -33 357 66 604 278 693 50 21 70 24 143 21 55 -2 97 -9 118 -21z m-2363 -1173 c35 -141 30 -802 -10 -1373 -52 -725 -167 -1286 -330 -1615 -66 -133 -122 -200 -207 -245 -57 -31 -71 -34 -148 -35 -73 0 -93 4 -142 28 -135 66 -226 238 -264 497 -22 155 -15 498 15 682 109 675 378 1309 760 1793 108 138 272 295 306 295 7 0 16 -12 20 -27z"/>
                <path d="M11950 6015 c-112 -31 -130 -60 -130 -210 0 -205 29 -365 75 -411 23
                -23 31 -24 147 -24 135 0 282 19 340 43 47 20 53 46 52 232 0 160 -22 280 -57
                321 -30 34 -112 53 -257 59 -85 4 -129 1 -170 -10z"/>
            </g>
        </svg>
        <h1 class="text-white text-3xl pt-8">Welcome Back</h1>
        <h2 class="text-blue-300">Enter your credentials below</h2>
        <div class="relative pt-8">
            <label for="email" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">E-mail</label>
            <input type="email" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700" v-model="form.email" placeholder="your@email.com" autocomplete="email" autofocus>
        </div>

        <div class="relative pt-3">
            <label for="password" class="uppercase text-blue-500 text-xs font-bold absolute pl-3 pt-2">Password</label>
            <input type="password" class="pt-8 w-full rounded p-3 bg-blue-800 text-gray-100 outline-none focus:bg-blue-700"
            v-model="form.password" placeholder="********" autocomplete="current-password">
        </div>

        <div class="pt-2">
            <input type="checkbox" v-model="form.remember" value="1">
            <label class="text-white" for="remember">
                Remember Me
            </label>
        </div>

        <div class="pt-8">
            <button @click.prevent="saveForm" type="submit" class="w-full uppercase rounded text-left text-blue-900 bg-gray-400 py-2 px-3 font-bold">
                Login
            </button>
        </div>

        <div class="flex justify-between pt-8 text-white text-sm font-bold">
            <a href="/passwordReset">
                Forgot Your Password?
            </a>
            <a href="/register">
                Register
            </a>
        </div>
    </div>
</div>
</template>

<script>
	export default{
		data(){
			return{
				form:{
					email: '',
					password: '',
					remember: ''
				},
				errors:[]
			}
		},
		methods:{
			saveForm(){
				axios.post('/api/loginUser', this.form).then(() =>{
				window.location.href = '/dashboard';
				}).catch((error)=>{
					this.errors = error.response.data.errors;
				})
			}
		}
	}
</script>