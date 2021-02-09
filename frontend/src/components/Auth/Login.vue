<template>
  <div class="log border border-dark shadow-lg p-3 mb-5 bg-white rounded">
    <span class="heading d-flex justify-content-center">Вхід</span>
    <form class="login" @submit.prevent="login()" method="post">
      <div class="form-group form-group-tel d-flex justify-content-center">
        <input
          v-model="tel"
          class="form-control shadow-none px-5 w-75 position-relative"
          :class="errors?.phone ? 'is-invalid' : null"
          type="tel"
          placeholder="Телефон"
        />
      </div>
      <div
        class="form-group control form-group-password d-flex justify-content-center"
      >
        <input
          id="exampleInputPassword1"
          v-model="password"
          class="form-control shadow-none px-5 w-75 position-relative"
          :class="errors?.password ? 'is-invalid' : null"
          type="password"
          placeholder="Пароль"
        />
      </div>
      <div class="btn_control d-flex justify-content-center mb-3">
        <button type="submit" class="btn btn-dark shadow-none">Увійти</button>
      </div>
    </form>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Login",
  computed: {
    ...mapGetters("user", ["userData"])
  },
  data() {
    return {
      tel: "",
      password: "",
      errors: {}
    };
  },
  methods: {
    ...mapActions("user", ["setUserData", "setToken"]),

    login() {
      this.$axios
        .post("/auth/login", {
          phone: this.tel,
          password: this.password
        })
        .then(response => {
          if (response.data.token) {
            this.$axios.defaults.headers.common["Authorization"] =
              "Bearer " + response.data.token;
            this.setToken(response.data.token);
            localStorage.setItem("auth_token", response.data.token);
            this.fetchData();
          }
        })
        .catch(errors => {
          this.errors = errors.response.data.errors;
        });
    },
    fetchData() {
      this.$axios.get("/auth/me").then((response) => {
        console.log(response);
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
      });
    }
  }
};
</script>

<style lang="scss">
.log {
  width: 370px;
  margin-bottom: 60px;
}
.heading {
  font-size: 40px;
  font-weight: 700;
  padding: 15px 0;
  border-bottom: 1px solid #000;
  margin-bottom: 30px;
}
.control {
  margin: 25px 0 25px 0;
}
.form-group-password::before {
  content: "\f023";
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  position: absolute;
  margin-right: 205px;
  margin-top: 7px;
  z-index: 2;
}
.form-group-tel::before {
  content: "\f879";
  font-family: "Font Awesome 5 Free";
  font-weight: 900;
  position: absolute;
  margin-right: 205px;
  margin-top: 7px;
  z-index: 2;
}
</style>
