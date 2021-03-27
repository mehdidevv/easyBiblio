<template>
  <div class="row">
    <h1 class="my-4">My Books</h1>
    <div class="Container mt-5">
      <BookList
        :books="books"
        :isHome="false"
        @onDelete="onDelete"
        @onBookDetail="onBookDetail"
      />
    </div>
  </div>
</template>
<script>
import BookList from "./Components/BookList";

export default {
  name: "MyBooks",
  components: {
    BookList,
  },
  props: {
    books: {
      type: Array,
    },
  },
  methods: {
    onDelete(data) {
      this.$emit("onDelete", data);
    },
    onBookDetail(data) {
      this.$emit("onBookDetail", data);
    },
  },
  created() {
    this.$parent.bookByuser();
  },
};
</script>