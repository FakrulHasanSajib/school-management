<template>
  <div class="home-container">
    <div v-if="!isLoggedIn" class="guest-view">
      <h1>Welcome to School Management System</h1>
      <p>Please <router-link to="/login">login</router-link> to continue.</p>
    </div>

    <div v-else class="authenticated-view">
      <div v-if="userRole === 'admin'" class="admin-dashboard">
        <h2>Welcome, Admin!</h2>
        <p>You have full access to manage the school system.</p>
        <router-link to="/dashboard/classes">Go to Dashboard</router-link>
      </div>

      <div v-else-if="userRole === 'teacher'" class="teacher-dashboard">
        <h2>Welcome, Teacher!</h2>
        <p>View your assigned classes and subjects.</p>
        </div>

      <div v-else-if="userRole === 'student'" class="student-dashboard">
        <h2>Welcome, Student!</h2>
        <p>Check your routine and results.</p>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isLoggedIn: false,
      userRole: null,
    };
  },
  created() {
    this.checkAuthentication();
  },
  methods: {
    checkAuthentication() {
      const token = localStorage.getItem('token');
      const user = localStorage.getItem('user');

      if (token && user) {
        this.isLoggedIn = true;
        this.userRole = JSON.parse(user).role;
      } else {
        this.isLoggedIn = false;
        this.userRole = null;
      }
    },
  },
};
</script>

<style scoped>
.home-container {
  text-align: center;
  margin-top: 50px;
}
</style>