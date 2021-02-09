<template>
  <div class="select">
    <div class="search_input">
      <Multiselect
        v-model="value"
        placeholder="Введіть ПІБ користувача"
        :filterResults="true"
        :minChars="1"
        :resolveOnLoad="false"
        :delay="0"
        :searchable="true"
        :options="options"
        :valueProp="'id'"
        :trackBy="'id'"
        :label="'fullName'"
        @select="selectedUser"
      />
    </div>
  </div>
</template>

<script>
import Multiselect from "@vueform/multiselect";

export default {
  components: {
    Multiselect,
  },
  data() {
    return {
      value: null,
      options: [],
    };
  },
  methods: {
    getUsers() {
      this.$axios.get("/users").then((response) => {
        if (response.data.data) {
          this.options = response.data.data;
        }
      });
    },
    selectedUser(event) {
      this.$router.push({ name: "Users", params: { id: event } });
    },
  },
  mounted() {
    this.getUsers();
  },
};
</script>

<style lang="scss">
.select {
  display: flex;
  justify-content: center;
  margin-top: 18%;
}
.search_input {
  width: 70%;
  background-color: #ffffff;
}
</style>