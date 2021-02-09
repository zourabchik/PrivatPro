<template>
  <div class="height-control bg-light">
    <router-view />
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "App",
  computed: {
    ...mapGetters("user", ["userData", "token"])
  },
  methods: {
    ...mapActions("user", ["setUserData"]),

    fetchData() {
      this.$axios
        .get("/auth/me")
        .then(response => {
          if (response.data) {
            this.setUserData(response.data.data);

            const hasRoleManager = this.userData.roles.find(
              item => item.title === "Manager"
            );

            if (hasRoleManager) {
              this.$router.push({ name: "SearchPage" });
            } else {
              this.$router.push({ name: "Index" });
            }
          }
        })
        .catch(() => {
          localStorage.removeItem("auth_token");
        });
    }
  },
  mounted() {
    if (this.userData?.id === 0) {
      const token = this.token
        ? this.token
        : localStorage.getItem("auth_token");

      if (token) {
        this.$axios.defaults.headers.common["Authorization"] =
          "Bearer " + token;
        this.fetchData();
      } else {
        this.$router.push({ name: "Authorization" });
      }
    }
  }
};
</script>

<style lang="scss">
#app {
  margin: 0;
  padding: 0;
}
.height-control {
  display: flex;
  justify-content: center;
}
</style>
