<template>
  <div class="container mt-5">
    <Header :count="count" />
    <router-view
      :books="books"
      @onReserve="onReserve"
      @onDelete="onDelete"
      @onBookDetail="onBookDetail"
      :categories="categories"
      @onCategory="onCategory"
      @retrieveToken="retrieveToken"
      @register="register"
      @logout="logout"
    ></router-view>
    <div class="col-lg-9">
      <BookDetails @onReserve="onReserve" :book="detailedBook" />
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Header from "./header";
import BookDetails from "./Components/bookDetails";

export default {
  name: "App",
  components: {
    Header,
    BookDetails,
  },
  data() {
    return {
      r: "fff",
      token: localStorage.getItem("access_token") || null,
      url: "http://localhost:8000/api/",
      books: [],
      categories: [],
      selectedCategory: -1,
      detailedBook: null,
      count: 0,
      config: {
        headers: { Authorization: "Bearer " + this.token },
      },
    };
  },
  methods: {
    getbooks() {
      axios.get(this.url + "book").then((data) => {
        this.books = data.data;
      });
    },
    getcategories() {
      axios.get(this.url + "category").then((data) => {
        this.categories = data.data;
      });
    },
    bookReserve(id) {
      const config = {
        headers: { Authorization: "Bearer " + this.token },
      };
      axios
        .post(
          this.url + "reservation/",
          {
            book_id: id,
          },
          config
        )
        .then(() => {
          this.getbooks();
          this.countBooks();
          if (this.detailedBook != null) this.detailedBook.availability = 0;
        })
        .catch((e) => {
          alert(e);
        });
    },
    bookByCategory(id) {
      axios.get(this.url + "category/" + id).then((data) => {
        console;
        this.books = data.data["books"];
        this.selectedCategory = id;
      });
    },
    bookByuser() {
      const config = {
        headers: { Authorization: "Bearer " + this.token },
      };
      axios.get(this.url + "userbooks", config).then((data) => {
        console.log(data);
        this.books = data.data;
      });
    },
    onBookDetail(data) {
      this.bookdetailsselected = true;
      this.detailedBook = data;
      $("#exampleModal").modal();
      console.log(this.token);
    },
    onReserve(id) {
      console.log("haaaaw");
      this.bookReserve(id);
    },
    onDelete(id) {
      const config = {
        headers: { Authorization: "Bearer " + this.token },
      };
      axios
        .delete(this.url + "reservation/" + id, config)
        .then(() => {
          this.bookByuser();
          this.countBooks();
        })
        .catch((e) => {
          alert(e);
        });
    },
    retrieveToken(credentials) {
      axios
        .post(this.url + "login", {
          email: credentials.username,
          password: credentials.password,
        })
        .then((response) => {
          if (response.data.success) {
            this.token = response.data.JWT_Token;
            localStorage.setItem("access_token", this.token);
            this.countBooks();
            this.selectedCategory = -1;
            this.$router.push({ name: "Home" });
          } else {
            confirm("Incorrect Email or password");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    logout() {
      const config = {
        headers: { Authorization: "Bearer " + this.token },
      };
      axios.get(this.url + "logout", config).then((response) => {
        console.log(response);
        localStorage.removeItem("access_token");
        this.token = null;
        this.selectedCategory = -1;
        this.$router.push({ name: "Login" });
      });
    },
    countBooks() {
      const config = {
        headers: { Authorization: "Bearer " + this.token },
      };
      axios.get(this.url + "countbooks", config).then((data) => {
        this.count = data.data;
      });
    },
    onCategory(id) {
      this.bookByCategory(id);
      this.getcategories();
    },
    register(credentials) {
      axios
        .post(this.url + "register", {
          email: credentials.email,
          name: credentials.name,
          password: credentials.password,
          password_confirmation: credentials.password_confirmation,
        })
        .then((response) => {
          console.log(response);
          this.$router.push({ name: "Login" });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    countBooks() {
      const config = {
        headers: { Authorization: "Bearer " + this.token },
      };
      axios.get(this.url + "countbooks", config).then((data) => {
        this.count = data.data;
      });
    },
  },
  created() {
    if (this.token !== null) this.countBooks();
    this.getbooks();
    this.getcategories();
  },
};
</script>
<style scoped>
</style>