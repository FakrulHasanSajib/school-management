<template>
  <div class="dashboard-container min-h-screen flex flex-col bg-gray-100 font-sans">
    <header class="dashboard-header bg-white shadow-md p-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-gray-800">School Management Dashboard</h1>
      <div v-if="user" class="flex items-center space-x-4">
        <p class="text-gray-600 font-medium hidden md:block">👋 স্বাগতম, {{ user.name }}</p>
        <button
          @click="logout"
          class="bg-red-500 text-white font-bold py-2 px-4 rounded-md hover:bg-red-600 transition-colors"
        >
          লগআউট
        </button>
      </div>
    </header>

    <main class="dashboard-content flex-grow flex">
      <aside class="sidebar bg-gray-800 text-white p-6 w-64 space-y-2 hidden md:block">
        <h2 class="text-xl font-semibold mb-4 border-b border-gray-700 pb-2">মেনু</h2>
        <ul class="space-y-1">
          <li>
            <router-link to="/dashboard/classes" class="block py-2 px-4 rounded-md hover:bg-gray-700 transition-colors">
              ক্লাস
            </router-link>
          </li>
          <li>
            <router-link to="/dashboard/sections" class="block py-2 px-4 rounded-md hover:bg-gray-700 transition-colors">
              সেকশন
            </router-link>
          </li>
          <li>
            <router-link to="/dashboard/subjects" class="block py-2 px-4 rounded-md hover:bg-gray-700 transition-colors">
              বিষয়
            </router-link>
          </li>
        </ul>
      </aside>

      <section class="main-view flex-grow p-6">
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
    // এই লাইফেকল হুকটি কম্পোনেন্ট মাউন্ট হওয়ার পরে একবার চালানো হয়
    try {
      // লগইন করা ব্যবহারকারীর ডেটা আনা হচ্ছে
      const res = await api.get("/user");
      this.user = res.data;
      
      // ব্যবহারকারীর ডেটা লোকাল স্টোরেজে সংরক্ষণ করা হচ্ছে
      localStorage.setItem('user', JSON.stringify(this.user));

    } catch (err) {
      console.error("ইউজার ডেটা আনতে ব্যর্থ:", err);
      // যদি ব্যবহারকারী অনুমোদিত না হয়, তাহলে লগইন পেজে রিডাইরেক্ট করা হচ্ছে
      this.$router.push("/login");
    }
  },
  methods: {
    async logout() {
      try {
        // ব্যাকএন্ডে লগআউট রিকোয়েস্ট পাঠানো হচ্ছে
        await api.post("/logout");
        
        // লোকাল স্টোরেজ থেকে ব্যবহারকারী ডেটা এবং টোকেন মুছে ফেলা হচ্ছে
        localStorage.removeItem("sanctum_token");
        localStorage.removeItem("user");
        
        // লগইন পেজে রিডাইরেক্ট করা হচ্ছে
        this.$router.push("/login");
      } catch (error) {
        console.error("লগআউট ব্যর্থ:", error.response?.data || error);
      }
    }
  }
};
</script>

<style scoped>
/* Tailwind CSS ক্লাস ব্যবহার করা হয়েছে, তাই এখানে অতিরিক্ত স্টাইল প্রয়োজন নেই */
</style>