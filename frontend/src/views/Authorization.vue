<template>
  <div class="login_page d-flex justify-content-center align-items-center">
    <Login />
  </div>
</template>

<script>
import Login from "../components/Auth/Login.vue";
export default {
  name: "Authorization",
  components: {
    Login,
  },
};
</script>

<style lang="scss">
</style>