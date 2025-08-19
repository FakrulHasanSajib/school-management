<template>
  <div class="dashboard-container">
    <header class="dashboard-header">
      <h1>School Management Dashboard</h1>
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
import axios from 'axios';

export default {
  methods: {
    async logout() {
      try {
        await axios.post('http://127.0.0.1:8000/api/logout', null, {
          headers: {
            'Authorization': `Bearer ${localStorage.getItem('token')}`
          }
        });
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        this.$router.push('/');
      } catch (error) {
        console.error("Logout failed:", error.response.data);
      }
    }
  }
};
</script>

<style scoped>
/* Add some basic styles here */
.dashboard-container {
  display: flex;
  flex-direction: column;
  height: 100vh;
}
/* .dashboard-header styles removed to avoid empty ruleset error */
.dashboard-content {
  display: flex;
  flex: 1;
}
.sidebar {
  width: 200px;
  background: #f5f5f5;
  padding: 20px;
}
.main-view {
  flex: 1;
  padding: 20px;
}
</style>