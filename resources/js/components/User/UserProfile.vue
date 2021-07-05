<template>
  <div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <div class="pl-1 text-xl text-gray-600">
        User Profile
      </div>
      <hr class="mt-2 bg-gray-300">

      <div align="center">
        <img :src="/storage/+data.profile_pic" alt="Profile Picture" class="rounded-full shadow-2xl" style="width: 110px; height: 115px;" />
      </div>

      <div class="flex mt-12 ml-3">
        <h6 class="flex font-bold">Name: <h6 class="ml-1">{{data.name}}</h6></h6>
        <h6 class="flex font-bold" style="margin-left: 400px;">Email: <h6 class="ml-1">{{data.email}}</h6></h6>
      </div>

      <div class="pt-4 pl-2">
        <router-link to="/edit/profile"  align="left" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-7 rounded shadow-xl">
          Edit
        </router-link>
      </div>
      </br>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return{
        data: {
          id: '',
          name: '',
          email: '',
          profile_pic: ''
        },
        errors:[]
      }
    },
    mounted(){
      axios.get('http://vuespajwt.test/user/detail').then((res) =>{
          console.log('User fetched successfully');
          this.data.id = res.data.id;
          this.data.name = res.data.name;
          this.data.email = res.data.email;
          this.data.profile_pic = res.data.profile_pic;
        })
        .catch((error)=>{
          this.errors = error.response.data.errors;
        })
    }
  }
</script>

