<template>
  <div class="d-flex">
    <button class="btn btn-dark" v-on:click="logout()" type="submit">
      Вихід
    </button>
  </div>
</template>

<script>
export default {
  name: "Logout",
  methods: {
    logout() {
      this.$axios
        .post("/auth/logout", {
          submit: this.submit,
        })
        .then(() => (location.href = "/auth"));
    },
    // logout() {
    //   this.$auth.logout({
    //     url: "http://127.0.0.1:8000/api/auth/logout",
    //     makeRequest: true,
    //     redirect: { name: "Authorization" },
    //   });
    // },
  },
};
</script>