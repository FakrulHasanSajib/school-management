<template>
  <div class="login min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
      <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">লগইন</h2>
      <form @submit.prevent="login">
        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-medium mb-2">ইমেইল</label>
          <input
            v-model="email"
            type="email"
            id="email"
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="ইমেইল লিখুন"
            required
          />
        </div>

        <div class="mb-6">
          <label for="password" class="block text-gray-700 font-medium mb-2">পাসওয়ার্ড</label>
          <input
            v-model="password"
            type="password"
            id="password"
            class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-500"
            placeholder="পাসওয়ার্ড লিখুন"
            required
          />
        </div>

        <button
          type="submit"
          class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-md hover:bg-blue-600 transition-colors"
        >
          লগইন
        </button>
      </form>

      <p v-if="error" class="mt-4 text-red-500 text-center">{{ error }}</p>
    </div>
  </div>
</template>

<script>
import api from "@/api"; // তুমি যে src/api.js ফাইলটি বানিয়েছো সেটি

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
        // CSRF টোকেনের জন্য আলাদা রিকোয়েস্ট পাঠানোর প্রয়োজন নেই। 
        // Axios এর withCredentials: true এর কারণে Sanctum এটি স্বয়ংক্রিয়ভাবে করে।
        
        // Laravel API তে POST request পাঠানো হচ্ছে
        const response = await api.post("/login", {
          email: this.email,
          password: this.password,
        });

        // যদি লগইন সফল হয়
        const token = response.data.access_token;
        localStorage.setItem('sanctum_token', token); // টোকেন সংরক্ষণ
        
        console.log("সফলভাবে লগইন হয়েছে!", response.data);

        // সফল হলে ড্যাশবোর্ড বা অন্য কোনো সুরক্ষিত পেজে রিডাইরেক্ট করো
        // Vue Router ব্যবহার করে নেভিগেট
        this.$router.push("/dashboard");

      } catch (err) {
        // লগইন ব্যর্থ হলে ত্রুটির বার্তা দেখানো হচ্ছে
        this.error = err.response?.data?.message || "লগইন ব্যর্থ হয়েছে। আবার চেষ্টা করুন!";
        console.error("লগইন ব্যর্থ:", err.response);
      }
    }
  }
};
</script>

<style scoped>
.login {
  font-family: Arial, sans-serif;
}
</style>