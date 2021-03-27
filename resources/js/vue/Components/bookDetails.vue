<template>
  <div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ book.title }}</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- book details-->
          <div class="col-lg-9">
            <div class="card mt-4">
              <img
                class="card-img-top img-fluid"
                src="http://placehold.it/900x400"
                alt=""
              />
              <div class="card-body">
                <h3 class="card-title">{{ book.title }}</h3>
                <h6>
                  {{ book.author.first_name }} {{ book.author.last_name }}
                </h6>
                <h4>{{ book.nb_pages }} pages</h4>
                <p class="card-text">{{ book.description }}</p>
                <span class="text-warning"
                  >&#9733; &#9733; &#9733; &#9733; &#9734;</span
                >
                4.0 stars
              </div>
            </div>
          </div>
        </div>
        <div v-if="this.$parent.token !== null" class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            Close
          </button>
          <button
            v-if="book.availability != 0"
            type="button"
            class="btn btn-outline-primary"
            @click="onReserve"
          >
            Reserve Book
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BookDetails",
  props: {
    book: {
      type: Object,
    },
  },
  methods: {
    onReserve(id) {
      this.$emit("onReserve", this.book.id);
    },
  },
};
</script>
<style scoped></style>