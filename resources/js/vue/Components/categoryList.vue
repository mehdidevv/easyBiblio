<template>
  <div class="col-lg-3">
    <h1 class="my-4">Categories</h1>
    <Category
      v-for="category in categories"
      :key="category.id"
      :category="category"
      @onCategory="onCategory"
    />
  </div>
</template>
<script>
import Category from "./Category";

export default {
  name: "CategoryList",
  components: {
    Category,
  },
  props: {
    categories: {
      type: Array,
    },
  },
  methods: {
    onCategory(id) {
      this.$emit("onCategory", id);
    },
  },
};
</script>
<style scoped>
</style>