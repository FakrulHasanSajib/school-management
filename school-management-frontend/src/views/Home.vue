<template>
  <div class="home-container p-6 bg-gray-50 min-h-screen flex flex-col items-center justify-center">
    <!-- যদি লগইন না করা থাকে -->
    <div v-if="!isLoggedIn" class="guest-view text-center">
      <h1 class="text-4xl font-bold text-gray-800 mb-4">স্বাগতম!</h1>
      <p class="text-lg text-gray-600">
        স্কুল ম্যানেজমেন্ট সিস্টেমে আপনাকে স্বাগতম। দয়া করে
        <router-link to="/login" class="text-blue-500 hover:underline font-bold">লগইন</router-link>
        করুন।
      </p>
    </div>

    <!-- যদি লগইন করা থাকে -->
    <div v-else class="authenticated-view w-full max-w-2xl bg-white p-8 rounded-lg shadow-lg">
      <div v-if="userRole === 'admin'" class="admin-dashboard text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">এডমিন ড্যাশবোর্ড</h2>
        <p class="text-lg text-gray-600 mb-4">
          আপনার কাছে স্কুল সিস্টেম পরিচালনার সম্পূর্ণ অধিকার আছে।
        </p>
        <router-link
          to="/dashboard/classes"
          class="bg-green-500 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:bg-green-600 transition-colors"
        >
          ড্যাশবোর্ডে যান
        </router-link>
      </div>

      <div v-else-if="userRole === 'teacher'" class="teacher-dashboard text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">শিক্ষক ড্যাশবোর্ড</h2>
        <p class="text-lg text-gray-600">আপনার নির্ধারিত ক্লাস এবং বিষয় দেখুন।</p>
      </div>

      <div v-else-if="userRole === 'student'" class="student-dashboard text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">শিক্ষার্থী ড্যাশবোর্ড</h2>
        <p class="text-lg text-gray-600">আপনার রুটিন এবং ফলাফল দেখুন।</p>
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
      // টোকেনটি 'sanctum_token' নামে খোঁজা হচ্ছে, যা Login.vue-তে সেট করা হয়েছে।
      const token = localStorage.getItem('sanctum_token'); 
      const user = localStorage.getItem('user'); // ব্যবহারকারীর ডেটা চেক করা হচ্ছে

      if (token && user) {
        this.isLoggedIn = true;
        try {
          this.userRole = JSON.parse(user).role;
        } catch (e) {
          console.error("Failed to parse user data from localStorage:", e);
          this.userRole = null;
        }
      } else {
        this.isLoggedIn = false;
        this.userRole = null;
      }
    },
  },
};
</script>

<style scoped>
/* Tailwind CSS ক্লাস ব্যবহার করা হয়েছে, তাই এখানে অতিরিক্ত স্টাইল প্রয়োজন নেই */
</style>
