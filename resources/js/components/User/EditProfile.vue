<template>
  <div class="bg-gray-100 p-8 rounded-xl shadow-xl">
    <div class="md:h-auto bg-white pl-8 pr-8 pt-4 w-auto rounded-xl shadow-xl">
      <div class="pl-1 text-xl text-gray-600">
        Edit User Profile
      </div><hr class="mt-2 bg-gray-300">

      <div v-if="data.success" class="alert alert-success">
        <strong>Success! </strong>{{data.success}}
      </div>
      <div v-for="error in errors">
        <div v-if="errors" class="alert alert-danger">
          <strong>Error: </strong>{{error}}
        </div>
      </div>

      <div v-if="data.url">
          <img :src="data.url" id="picture_preview" class="rounded-full shadow-2xl" style="width: 150px; height: 155px;" alt="Profile Picture">
          <button class="rounded text-center text-white shadow-xl bg-blue-500 hover:bg-blue-700 py-2 px-3 font-bold mt-3 ml-7" onClick="document.getElementById('picture').click();">Change</button>
      </div>
      <div v-else="data.profile_pic">
          <img :src="/storage/+data.profile_pic" id="picture_preview" class="rounded-full shadow-2xl" style="width: 140px; height: 145px;" alt="Profile Picture">
          <button class="rounded text-center text-white shadow-xl bg-blue-500 hover:bg-blue-700 py-2 px-3 font-bold mt-3 ml-7" onClick="document.getElementById('picture').click();">Change</button>
      </div>

      <form @submit.prevent="updateProfile">
        <div class="flex pt-10 justify-between ">
          <div class="relative">
            <label for="name" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Name</label>
            <input type="name" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 500px; height:60px" id="name" placeholder="Name" autocomplete="name" autofocus>
          </div>
          <div class="relative">
            <label for="email" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Email</label>
            <input type="email" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 500px; height:60px" id="email" placeholder="Email" autocomplete="email" autofocus>
          </div>
        </div>

        <div class="pl-1 pt-12 text-xl text-gray-600">
          Change Password
        </div>
        <hr class="mt-2 bg-gray-300">

        <div class="relative">
          <label for="old_password" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Old Password</label>
          <input type="password" class="pt-4 rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width:650px; height:60px" id="old_password" placeholder="Old Password" autocomplete="old_password" autofocus>
        </div>
        <div class="relative pt-2">
          <label for="new_password" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">New Password</label>
          <input type="password" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width:650px; height:60px" id="new_password" placeholder="New Password" autocomplete="new_passworde" autofocus>
        </div>
        <div class="relative pt-2">
          <label for="confirm_password" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2">Confirm Password</label>
          <input type="password" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width:650px; height:60px" id="confirm_password" placeholder="Confirm Password" autocomplete="confirm_password" autofocus>
        </div>
        <div class="relative">
          <label for="picture" class="uppercase text-blue-300 text-xs font-bold absolute pl-3 pt-2" hidden>Profile Picture</label>
          <input type="file" class="pt-4 w-full rounded pl-3 bg-blue-800 text-white placeholder-gray-300 outline-none focus:bg-blue-700" style="width: 400px; height:60px" id="picture" name="picture" autocomplete="picture" @change="onFileChange" autofocus hidden>
        </div>
        <hr class="mt-4 bg-gray-300">
        
        <div class="pt-2 text-right">
          <button  type="submit" class="w-70 rounded text-center text-white bg-blue-500 hover:bg-blue-700 py-2 px-3 font-bold shadow-xl">
            Save Changes
          </button>
          <button  type="submit" class="w-60 ml-2 rounded text-center text-white bg-yellow-400 hover:bg-yellow-500 py-2 px-3 font-bold shadow-xl">
            Cancel
          </button>
        </div>
      </form>
      </br>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return{
        formFields: {
          picture: null
        },
        data: {
          id: '',
          name: '',
          email: '',
          profile_pic: '',
          url: null,
          success: '',
          error: []
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

        $("#name").val(res.data.name);
        $("#email").val(res.data.email);
      })
      .catch((error)=>{
        this.errors = error.response.data.errors;
      })
    },
    methods:{
      updateProfile(){
        let formData = new FormData();

        formData.append("picture", this.formFields.picture);
        formData.append("id", this.data.id);
        formData.append("name", $("#name").val());
        formData.append("email", $("#email").val());
        formData.append("old_password", $("#old_password").val());
        formData.append("new_password", $("#new_password").val());
        formData.append("confirm_password", $("#confirm_password").val());

        axios.post('/update/profile', formData).then((res) =>{
          this.data.success = null;
          this.errors = [];

          var i = 0;
          if(res.data.status == 'updated')
          {
            this.data.success = 'Profile Updated Successfully';
          }
          if(res.data.old_password == 'matched' && res.data.new_password == 'matched')
          {
            this.data.success = null;
            this.data.success = 'Profile Updated Successfully';
          }
          
          if(res.data.old_password == 'not matched')
          {
            this.errors[i] = '[ "Old password is not matched with existing credentials." ]';
          }

          if(res.data.new_password == 'not matched')
          {
            this.errors[i] = '[ "New password and confirmation password are not matched." ]';
            i++;
          }
        }).catch((error)=>{
          this.data.success = null;
          this.errors = [];
          this.errors = error.response.data.errors;

          console.log(this.data.error);
        })
      },
      onFileChange(event){
        this.formFields.picture = event.target.files[0];

        const file = event.target.files[0];
        this.data.url = URL.createObjectURL(file);
      }
    }
  }
</script>

