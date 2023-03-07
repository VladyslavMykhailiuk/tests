<template>
 <div class="main">
   <h1>Зареєструйтеся прямо зараз!</h1>
   <form>
     <div class="mb-3">
       <label for="exampleInputEmail1" class="form-label">Електронна пошта</label>
       <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="forValidation.email" ref="email">
       <div v-if="errorEmail" class="text-danger">{{errorEmail}}</div>
       <div v-if="errorCheckedEmail" class="text-danger">{{errorCheckedEmail}}</div>
     </div>
     <div class="mb-3">
       <label for="login" class="form-label">Логін</label>
       <input type="email" class="form-control" id="login" aria-describedby="emailHelp" v-model="forValidation.login" ref="login" >
       <div v-if="errorLogin" class="text-danger">{{errorLogin}}</div>
       <div v-if="errorCheckedLogin" class="text-danger">{{errorCheckedLogin}}</div>
     </div>
     <div class="mb-3">
       <label for="city" class="form-label">Місто</label>
       <input type="email" class="form-control" id="city" aria-describedby="emailHelp" v-model="forValidation.city" ref="city">
       <div v-if="errorCity" class="text-danger">{{errorCity}}</div>
     </div>
     <div class="form-group row">
       <label for="sex" class="col-md-2 col-form-label">Стать</label>
       <div class="col-md-10">
         <select id="sex" class="form-control" name="sex" v-model="forValidation.sex">
           <option disabled selected>Виберіть стать зі списка..</option>
           <option value="1">Чоловіча</option>
           <option value="2">Жіноча</option>
         </select>
         <div v-if="errorSex" class="text-danger">{{errorSex}}</div>
       </div>
     </div>
     <div class="mb-3">
       <label for="phone" class="form-label">Номер телефона</label>
       <input type="email" name="phone" class="form-control" id="phone" aria-describedby="emailHelp" v-model="forValidation.phone">
       <div v-if="errorPhone" class="text-danger">{{errorPhone}}</div>
     </div>
     <div class="mb-3">
       <label for="password" class="form-label">Пароль</label>
       <input type="password" class="form-control" id="password" name="password" v-model="forValidation.password">
       <div v-if="errorPassword" class="text-danger">{{errorPassword}}</div>
     </div>
     <div class="mb-3">
       <label for="confirmPassword" class="form-label">Підтвердження пароля</label>
       <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" v-model="forValidation.confirmPassword">
       <div v-if="errorConfirmPassword" class="text-danger">{{errorConfirmPassword}}</div>
     </div>
     <button type="submit" @click.prevent="validateInput();" class="btn btn-primary">Зареєструватися</button>
   </form>
 </div>
</template>

<script>

import axiosInstance from "@/assets/AxiosInstance";
import router from "@/router/router";

export default {
  name: 'RegisterPage',
  data() {
    return {
      isAuthenticated: false,
      forValidation: {
        email:'',
        login:'',
        city:'',
        sex:0,
        phone:'',
        password:'',
        confirmPassword:'',
        checkedEmail:'',
        checkedLogin:'',
        success:false,
      },
      errorEmail: '',
      errorLogin:'',
      errorCity:'',
      errorSex:'',
      errorPhone:'',
      errorPassword:'',
      errorConfirmPassword:'',
      errorCheckedEmail:'',
      errorCheckedLogin:'',
    }
  },
  props: {

  },
    methods:{
      validateInput() {
        let valForm = this.toFormData(this.forValidation);
        axiosInstance.post('/registerValidate.php',valForm)
            .then( (response) => {
              console.log(response);
              this.validate(response);
            });
      },
      validate($resp) {
        this.errorEmail = '';
        this.errorLogin = '';
        this.errorCity = '';
        this.errorSex = '';
        this.errorPhone = '';
        this.errorPassword = '';
        this.errorConfirmPassword = '';
        this.errorCheckedEmail = '';
        this.errorCheckedLogin = '';
        if($resp.data.email) {
          this.errorEmail = $resp.data.message;
          this.$refs.email.focus();
        }
        if($resp.data.login) {
          this.errorLogin = $resp.data.message;
          this.$refs.login.focus();
        }
        if($resp.data.city) {
          this.errorCity = $resp.data.message;
          this.$refs.city.focus();
        }
        if($resp.data.sex) {
          this.errorSex = $resp.data.message;
        }
        if($resp.data.phone) {
          this.errorPhone = $resp.data.message;
        }
        if($resp.data.password) {
          this.errorPassword = $resp.data.message;
        }
        if($resp.data.confirmPassword) {
          this.errorConfirmPassword = $resp.data.message;
        }
        if($resp.data.checkedEmail) {
          this.errorCheckedEmail = $resp.data.message;
        }
        if($resp.data.checkedLogin) {
          this.errorCheckedLogin = $resp.data.message;
        }
        if($resp.data.success) {
          router.push('/form');
        }
      },
      toFormData(obj) {
        let form_data = new FormData();
        for(let key in obj){
          form_data.append(key,obj[key]);
        }
        return form_data;
      },
    },

  components:{

  }
}
</script>


<style scoped>
h1 {
  margin-bottom: 30px;
}
.main {
  flex-direction: column;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 50px;
}
</style>