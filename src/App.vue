<template>
  <div class="main">
    <HeaderComp/>
    <router-view/>
  </div>
</template>

<script>
// import ValidForm from './components/ValidForm.vue'

import HeaderComp from "@/components/HeaderComp.vue";

export default {
  name: 'App',
  components: {
    HeaderComp
    // ValidForm,
  }
}
</script>

<style scoped>

</style>
