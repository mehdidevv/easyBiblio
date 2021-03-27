<template>
  <div>
    <a
      href="javascript:void(0)"
      role="button"
      @click="onCategory"
      class="list-group-item list-group-item-action"
      :class="{
        active: this.$parent.$parent.$parent.selectedCategory === category.id,
      }"
    >
      {{ category.category_name }}</a
    >
  </div>
</template>

<script>
export default {
  name: "Category",
  props: {
    category: {
      type: Object,
    },
  },
  methods: {
    onCategory() {
      this.$emit("onCategory", this.category.id);
    },
  },
};
</script>
<style scoped>
</style>