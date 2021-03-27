<template>
  <div class="row">
    <Book
      v-for="book in books"
      :key="book.id"
      :book="book"
      :isHome="isHome"
      @onReserve="onReserve"
      @onDelete="onDelete"
      @onBookDetail="onBookDetail"
    />
  </div>
</template>

<script>
import Book from "./Book";
export default {
  name: "BookList",
  components: {
    Book,
  },
  props: {
    books: {
      type: Array,
    },
    isHome: Boolean,
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
  },
};
</script>

<style scoped></style>