<template>
  <div class="page_pos">
    <Search />
  </div>
</template>

<script>
import Search from "../components/Search";
export default {
  name: "SearchPage",
  components: {
    Search,
  },
};
</script>

<style lang="scss">
.page_pos {
  width: 100%;
}
</style>