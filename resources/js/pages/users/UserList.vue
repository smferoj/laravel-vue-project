
<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';


const users = ref([]);



const getUsers = () => {
  axios.get('/api/users')
.then((response) => {
  users.value = response.data;
})
}


onMounted(()=>{
  getUsers();
})
</script>

<template>
  <div class="container mt-4">

    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


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
        <tr v-for= "(user, index) in users" :key="user.id">
          <th scope="row">{{ index + 1 }}</th>
          <td>{{user.name}}</td>
          <td>{{ user.email }}</td>
        </tr>
      </tbody>
    </table>

  </div>
    </div>
  </div>
</template>



<style>
/* Add any custom styles if needed */
</style>
