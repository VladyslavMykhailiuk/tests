<template>
  <div class="dop">
<ValidForm/>
  </div>
</template>

<script>
import ValidForm from "@/components/ValidForm.vue";

export default {
  name: 'PostFormPage',
  data() {
    return {
    }
  },
  props: {

  },
  methods:{

  },
  components:{
    ValidForm
  }
}
</script>


<style scoped>
.dop {
  padding: 50px;
}
</style>