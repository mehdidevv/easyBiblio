<template>
  <div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
      <a href="#"
        ><img
          class="card-img-top"
          src="https://cdn.thespaces.com/wp-content/uploads/2018/05/Island-caruso-st-john-marcus-taylor-cover-2-1024x663.jpg"
          alt=""
      /></a>
      <div class="card-body">
        <h4 class="card-title">
          <div role="button">
            <button
              @click="onBookDetail"
              type="button"
              class="btn btn-primary"
              data-toggle="modal"
              data-target="#exampleModal"
            >
              {{ book.title }}
            </button>
          </div>
        </h4>
        <h5>{{ book.title }} pages</h5>
        <p class="card-text">{{ book.description }}</p>
      </div>
      <div v-if="this.$parent.$parent.$parent.token !== null">
        <div class="card-footer" v-if="isHome">
          <button
            v-if="book.availability != 0"
            type="button"
            class="btn btn-outline-primary"
            @click="onReserve"
          >
            Reserve Book
          </button>
          <div v-else class="alert alert-warning" role="alert">
            The book is reserved
          </div>
        </div>
        <div class="card-footer" v-else>
          <button
            type="button"
            class="btn btn-outline-danger"
            @click="onDelete"
          >
            Delete Book
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Book",
  props: {
    isHome: Boolean,
    book: {
      type: Object,
    },
  },
  methods: {
    onReserve() {
      this.$emit("onReserve", this.book.id);
    },
    onDelete() {
      this.$emit("onDelete", this.book.reservation.id);
    },
    onBookDetail() {
      this.$emit("onBookDetail", this.book);
    },
  },
};
</script>

<style scoped></style>