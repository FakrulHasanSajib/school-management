<template>
  <div>
    <ClassForm 
      :classToEdit="classToEdit" 
      @class-saved="fetchClasses"
      @cancel-edit="cancelEdit"
    />

    <h2>Classes List</h2>
    <ul>
      <li v-for="classItem in classes" :key="classItem.id">
        {{ classItem.name }}
        <button @click="editClass(classItem)">Edit</button>
        <button @click="deleteClass(classItem.id)">Delete</button>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';
import ClassForm from './ClassForm.vue'; // Import the new component

export default {
  components: {
    ClassForm
  },
  data() {
    return {
      classes: [],
      classToEdit: null,
    };
  },
  async created() {
    this.fetchClasses();
  },
  methods: {
    async fetchClasses() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/classes', {
          headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
        });
        this.classes = response.data;
      } catch (error) {
        console.error("Error fetching classes:", error.response.data);
      }
    },
    editClass(classItem) {
      this.classToEdit = classItem;
    },
    cancelEdit() {
      this.classToEdit = null;
    },
    async deleteClass(classId) {
      if (confirm('Are you sure you want to delete this class?')) {
        try {
          await axios.delete(`http://127.0.0.1:8000/api/classes/${classId}`, {
            headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
          });
          this.fetchClasses();
        } catch (error) {
          console.error("Error deleting class:", error.response.data);
        }
      }
    }
  }
};
</script>