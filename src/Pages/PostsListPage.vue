<template>
  <div>
    <h2>Список постів</h2>
    <ul>
      <li v-for="post in posts" :key="post.id">
        <router-link :to="{ name: 'post', params: { id: post.id } }">{{ post.title }}</router-link>
      </li>
    </ul>
  </div>
</template>

<script>
import axiosInstance from "@/assets/AxiosInstance";

export default {
  name: 'MainPage',
  data() {
    return {
      posts: []
    }
  },
  mounted() {
    this.getPosts();

  },
  props: {

  },
  methods:{
    getPosts() {
      axiosInstance.get('/posts.php')
          .then(response => {
            this.posts = response.data;
            console.log(response.data);
          })
          .catch(error => {
            console.log(error);
          });
    },
  },
}
</script>


<style scoped>
h2 {
  text-align: center;
}
</style>