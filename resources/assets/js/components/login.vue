 <template>
     <div>
        <button class="element-center mt-4 mb-4 p-2 bg-orange text-white" @click.prevent="open">Login</button>
          <form v-if="loggingIn" action="#" method="post">
          <input class="w-1/4 element-center mt-2 mb-2 p-2 border-solid border border-grey text-grey-darkest" v-model="email" type="text" placeholder="Email">
          <div class="text-center text-red font-semibold" v-if="invalidEmailText.length > 0 && email.length > 0">
              {{ invalidEmailText }}
          </div>
          <input class="w-1/4 element-center mt-2 mb-2 p-2 border-solid border border-grey text-grey-darkest" v-model="password" type="text" placeholder="Password">
           <div class="text-center text-red font-semibold" v-if="invalidPasswordText.length > 0 && password.length > 0">
              {{ invalidPasswordText }}
          </div>
            <button :disabled="disablesave" class="w-1/6 element-center mt-2 mb-2 pt-2 pb-2 bg-orange text-white" @click.prevent="login">
              Login
            </button>
        </form>
     </div>
 </template> 
 <script>
export default {
  name: "login",
  props: [],
  data() {
    return {
      loggingIn: false,
      //loggedIn: false,
      errors: [],
      email: "",
      password: ""
    };
  },
  computed: {
    disablesave() {
      if (
        this.invalidEmailText.length > 0 |
        this.invalidPasswordText.length > 0
      )
        return true;

      return false;
    },

    invalidEmailText() {
      if (!this.validEmail(this.email)) return "Invalid email format";
      return "";
    },
    invalidPasswordText() {
      if (this.password.length < 6)
        return "Password must be at least 6 characters";
      if (this.password.length > 50)
        return "Password must be at less than 50 characters";

      return "";
    }
  },
  methods: {
    open() {
      this.loggingIn = true;
    },
    validEmail: function(email) {
      var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return regex.test(email);
    },
    login() {
      let data = {
        email: this.email,
        password: this.password
      };
      this.$emit("login");
      loginUser(data);
    },
    loginUser(data) {
      console.log(data);
      var self = this;
      axios
        .post("/login-user", data)
        .then(function(response) {
          console.log(response.data);
        })
        .catch(function(error) {
          alert("something went wrong");
        });
    }
  }
};
</script>
