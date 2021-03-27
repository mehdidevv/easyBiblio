<template>
  <div class="login-form pt-5">
    <form action="#" @submit.prevent="login">
      <h2 class="text-center">Log in</h2>
      <div class="form-group">
        <input
          type="email"
          class="form-control"
          placeholder="Email"
          required="required"
          v-model="username"
        />
      </div>
      <div class="form-group">
        <input
          type="password"
          class="form-control"
          placeholder="Password"
          required="required"
          v-model="password"
        />
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Log in</button>
      </div>
      <div class="clearfix">
        <label class="float-left form-check-label"
          ><input type="checkbox" /> Remember me</label
        >
      </div>
    </form>
    <p class="text-center">
      <router-link to="/register">Create an Account </router-link>
    </p>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      username: "",
      password: "",
    };
  },
  methods: {
    login() {
      this.$emit("retrieveToken", {
        username: this.username,
        password: this.password,
      });
    },
  },
};
</script>
<style scoped>
.login-form {
  width: 340px;
  margin: 50px auto;
  font-size: 15px;
}
.login-form form {
  margin-bottom: 15px;
  background: #f7f7f7;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  padding: 30px;
}
.login-form h2 {
  margin: 0 0 15px;
}
.form-control,
.btn {
  min-height: 38px;
  border-radius: 2px;
}
.btn {
  font-size: 15px;
  font-weight: bold;
}
</style>

