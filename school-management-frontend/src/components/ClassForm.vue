<template>
  <div class="form-container">
    <form @submit.prevent="saveClass">
      <h2>{{ isEditing ? 'Edit Class' : 'Add New Class' }}</h2>
      <div class="form-group">
        <label for="className">Class Name:</label>
        <input type="text" v-model="className" required />
      </div>
      <button type="submit">Save</button>
      <button v-if="isEditing" @click="cancelEdit">Cancel</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['classToEdit'],
  data() {
    return {
      className: '',
      isEditing: false,
    };
  },
  watch: {
    classToEdit(newVal) {
      if (newVal) {
        this.className = newVal.name;
        this.isEditing = true;
      } else {
        this.className = '';
        this.isEditing = false;
      }
    }
  },
  methods: {
    async saveClass() {
      const data = { name: this.className };
      const config = {
        headers: { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
      };

      try {
        if (this.isEditing) {
          await axios.put(`http://127.0.0.1:8000/api/classes/${this.classToEdit.id}`, data, config);
        } else {
          await axios.post('http://127.0.0.1:8000/api/classes', data, config);
        }
        this.$emit('class-saved');
        this.className = '';
      } catch (error) {
        console.error("Error saving class:", error.response.data);
      }
    },
    cancelEdit() {
      this.$emit('cancel-edit');
    }
  }
};
</script>