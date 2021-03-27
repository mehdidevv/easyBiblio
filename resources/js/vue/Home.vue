<template>
  <div class="row">
    <CategoryList :categories="categories" @onCategory="onCategory" />
    <div class="col-lg-9">
      <Carousel />
      <BookList
        :books="books"
        :isHome="true"
        @onReserve="onReserve"
        @onDelete="onDelete"
        @onBookDetail="onBookDetail"
      />
    </div>
  </div>
</template>
<script>
import CategoryList from "./Components/CategoryList";
import Carousel from "./Components/Carousel";
import BookList from "./Components/BookList";

export default {
  name: "Home",
  components: {
    Carousel,
    CategoryList,
    BookList,
  },
  props: {
    books: {
      type: Array,
    },
    categories: {
      type: Array,
    },
  },
  methods: {
    onReserve(id) {
      this.$emit("onReserve", id);
    },
    onDelete(data) {
      this.$emit("onDelete", data);
    },
    onBookDetail(data) {
      this.$emit("onBookDetail", data);
    },
    onCategory(id) {
      this.$emit("onCategory", id);
    },
  },
  created() {
    this.$parent.getbooks();
  },
};
</script>