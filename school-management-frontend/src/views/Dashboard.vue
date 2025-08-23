<template>
  <div class="dashboard-container">
    <header class="dashboard-header">
      <h1>School Management Dashboard</h1>
      <p v-if="user">👋 Welcome, {{ user.name }}</p>
      <button @click="logout">Logout</button>
    </header>
    
    <main class="dashboard-content">
      <aside class="sidebar">
        <ul>
          <li><router-link to="/dashboard/classes">Classes</router-link></li>
          <li><router-link to="/dashboard/sections">Sections</router-link></li>
          <li><router-link to="/dashboard/subjects">Subjects</router-link></li>
        </ul>
      </aside>

      <section class="main-view">
        <router-view></router-view>
      </section>
    </main>
  </div>
</template>

<script>
import api from "@/api";

export default {
  data() {
    return {
      user: null
    };
  },
  async mounted() {
    try {
      // Login করা user এর data আনো
      const res = await api.get("/user");
      this.user = res.data;
    } catch (err) {
      console.error("User fetch failed:", err);
      this.$router.push("/login");
    }
  },
  methods: {
    async logout() {
      try {
        await api.post("/logout");
        localStorage.removeItem("user");
        this.$router.push("/login");
      } catch (error) {
        console.error("Logout failed:", error.response?.data || error);
      }
    }
  }
};
</script>
