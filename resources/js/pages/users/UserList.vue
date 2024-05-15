
<script setup>
import axios from 'axios';


// const users = [
//   {
//   id:1,
//   name:'John Doe',
//   email: 'doe@gmail.com'
// },
//   {
//   id:2,
//   name:'John poe',
//   email: 'poe@gmail.com'
// },
// ];


const getUsers = () => {
  axios.get('/api/users')
.then((response) => {
  users = response.data;
})
}
</script>

<template>
  <div class="container mt-4">
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
</template>



<style>
/* Add any custom styles if needed */
</style>
