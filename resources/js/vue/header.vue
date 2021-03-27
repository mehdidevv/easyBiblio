<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <router-link class="navbar-brand" to="/">easyBook</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarResponsive"
        aria-controls="navbarResponsive"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <router-link class="nav-link" to="/"> Home </router-link>
          </li>
          <li class="nav-item">
            <router-link class="nav-link" to="/about"> About </router-link>
          </li>
          <li class="nav-item">
            <router-link
              v-if="this.$parent.token !== null"
              class="nav-link"
              to="/mybooks"
            >
              My Books
              <span
                class="badge bg-success"
                v-if="this.$parent.token !== null"
                >{{ this.count }}</span
              >
            </router-link>
          </li>
          <li class="nav-item">
            <router-link
              v-if="this.$parent.token !== null"
              class="nav-link"
              to="/logout"
              >Log Out</router-link
            >
          </li>
          <li class="nav-item">
            <router-link
              v-if="this.$parent.token === null"
              class="nav-link"
              to="/login"
              >Log In
            </router-link>
          </li>
          <li v-if="this.$parent.token === null" class="nav-item">
            <router-link class="nav-link" to="/register">Register</router-link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>
<script>
export default {
  name: "Header",
  props: {
    count: {
      type: Number,
    },
  },
};
</script>