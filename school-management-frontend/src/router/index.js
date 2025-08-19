import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue'; // Import the Home component
import Login from '../views/Login.vue';
import Dashboard from '../views/Dashboard.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard,
    meta: {
      requiresAuth: true
    },
    children: [
      // ... (your child routes for classes, sections, etc.)
    ]
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

// Navigation guard to check for authentication
router.beforeEach((to, from, next) => {
  const token = localStorage.getItem('token');
  if (to.meta.requiresAuth && !token) {
    next({ name: 'Login' });
  } else {
    next();
  }
});

export default router;