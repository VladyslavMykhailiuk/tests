<template>
  <div class="main">
    <h1>Увійдіть на сайт</h1>
    <form>
      <div class="mb-3">
        <label for="login" class="form-label">Логін</label>
        <input type="email" class="form-control" name="email" id="login" aria-describedby="emailHelp" v-model="forValidation.email" ref="email">
        <div v-if="errorCheckedEmail" class="text-danger">{{errorCheckedEmail}}</div>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="password" v-model="forValidation.password" name="password">
        <div v-if="errorCheckedPassword" class="text-danger">{{errorCheckedPassword}}</div>
      </div>
      <button type="submit" @click.prevent="validateInput();" class="btn btn-primary">Ввійти</button>
    </form>
  </div>
</template>

<script>
import axiosInstance from "@/assets/AxiosInstance";
import router from "@/router/router";
export default {
  name: 'LoginPage',
  data() {
    return {
      isAuthenticated:null,
      forValidation: {
        email:'',
        password:'',
        checkedEmail:'',
        checkedPassword:'',
        success:false,
      },
      errorCheckedEmail:'',
      errorCheckedPassword:'',
    }
  },
  props: {

  },
  mounted() {
    axiosInstance.get('/checkAuth.php')
        .then(response => {
          this.isAuthenticated = response.data.authenticated;
          console.log(this.isAuthenticated)
        });
  },
  methods:{
    validateInput() {
      let valForm = this.toFormData(this.forValidation);
      axiosInstance.post('/loginValidate.php',valForm)
          .then( (response) => {
            console.log(response);
            this.validate(response);
          });
    },
    validate($resp) {
      this.errorCheckedEmail = '';
      this.errorCheckedPassword = '';

      if($resp.data.checkedEmail) {
        this.errorCheckedEmail = $resp.data.message;
      }
      if($resp.data.checkedPassword) {
        this.errorCheckedPassword = $resp.data.message;
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

}
</script>


<style scoped>
h1 {
  margin-bottom: 50px;
}
.main {
  flex-direction: column;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 150px;
}
</style>