<template>
  <div>
    <h1>{{post.title}}</h1>
  </div>
</template>

<script>
import axiosInstance from "@/assets/AxiosInstance";

export default {
  name: 'OnePost',
  data() {
    return {
      post: {},
    }
  },
  props: {

  },
  methods:{

  },
  mounted(){
    const id = this.$route.params.id;
    axiosInstance.get(`post/${id}`).then((response) => {
      this.post = response.data;
      console.log(response.data)
    });
  }
}
</script>


<style scoped>

</style>