<template>
  <div class="page_pos">
    <Profile v-if="userData?.id" />
  </div>
</template>

<script>
import { mapGetters } from "vuex";

import Profile from "../components/Profile";

export default {
  name: "Index",
  components: {
    Profile
  },
  computed: {
    ...mapGetters("user", ["userData"])
  }
};
</script>

<style lang="scss">
.page_pos {
  width: 100%;
}
</style>