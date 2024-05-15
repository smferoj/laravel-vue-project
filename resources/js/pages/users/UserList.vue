<script setup>
import axios from "axios";
import { onMounted, reactive, ref } from "vue";

const users = ref([]);

const form = reactive({
  name: "",
  email: "",
  password: ""
});

const getUsers = () => {
  axios.get("/api/users").then((response) => {
    users.value = response.data;
  });
};

const createUser = () => {
  axios.post('/api/users', form).then((response) => {
    
    users.value.unshift(response.data);
    // Clear the form

    form.name = "";
    form.email = "";
    form.password = "";

    $('#createUserModal').modal('hide');
    // Close the modal manually
    // const modal = document.getElementById('createUserModal');
    // const bootstrapModal = bootstrap.Modal.getInstance(modal);
    // bootstrapModal.hide();
    // Refresh the user list
    // getUsers();
  });
};

onMounted(() => {
  getUsers();
});
</script>

<template>
  <div class="container mt-4">
    <!-- Button trigger modal -->
    <button
      type="button"
      class="btn btn-primary mb-3"
      data-bs-toggle="modal"
      data-bs-target="#createUserModal"
    >
      Create User
    </button>

    <!-- Modal -->
    <div class="card">
      <div class="card-body">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col">Sr</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(user, index) in users" :key="user.id">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div
      class="modal fade"
      id="createUserModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">User Information</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
            ></button>
          </div>
          <form @submit.prevent="createUser" autocomplete="off">
            <div class="modal-body">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input v-model="form.name" type="text" class="form-control" id="name" />
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input v-model="form.email" type="email" class="form-control" id="email" />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input v-model="form.password" type="password" class="form-control" id="password" />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
/* Add any custom styles if needed */
</style>
