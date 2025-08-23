<template>
  <div class="login">
    <h2>Login</h2>
    <form @submit.prevent="login">
      <div>
        <label>Email:</label>
        <input v-model="email" type="email" placeholder="Enter email" required />
      </div>

      <div>
        <label>Password:</label>
        <input v-model="password" type="password" placeholder="Enter password" required />
      </div>

      <button type="submit">Login</button>
    </form>

    <p v-if="error" style="color:red">{{ error }}</p>
  </div>
</template>

<script>
import api from "@/api"; // তুমি যেটা বানিয়েছো src/api.js

export default {
  name: "Login",
  data() {
    return {
      email: "",
      password: "",
      error: ""
    };
  },
  methods: {
    async login() {
      try {
        // 🔹 Step 1: CSRF cookie আনতে হবে
        await api.get("/sanctum/csrf-cookie");

        // 🔹 Step 2: Laravel API তে Login request পাঠানো
        await api.post("/login", {
          email: this.email,
          password: this.password
        });

        // 🔹 Step 3: Login successful হলে Dashboard এ পাঠানো
        alert("✅ Login successful!");
        this.$router.push("/dashboard");

      } catch (err) {
        this.error = err.response?.data?.message || "❌ Login failed. Try again!";
        console.error("Login failed:", this.error);
      }
    }
  }
};
</script>

<style scoped>
.login {
  max-width: 400px;
  margin: auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 8px;
}
.login input {
  display: block;
  width: 100%;
  margin-bottom: 10px;
  padding: 8px;
}
</style>
