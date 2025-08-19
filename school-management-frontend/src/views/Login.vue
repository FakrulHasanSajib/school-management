// src/views/Login.vue
<script>
import axios from 'axios';

export default {
  // ... data and other methods

  methods: {
    async login() {
      try {
        const response = await axios.post('http://127.0.0.1:8000/api/login', {
          email: this.email,
          password: this.password
        });
        
        // Login successful, handle response
        console.log(response.data);
        
      } catch (error) {
        // Handle login failure
        console.error("Login failed:", error.response.data);
      }
    }
  }
};
</script>