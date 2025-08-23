import axios from "axios";

const api = axios.create({
  baseURL: "http://localhost:8000/api", // আপনার Laravel API URL
  withCredentials: true,               // Sanctum এর জন্য
  headers: {
    Accept: "application/json"
  }
});

export default api;
