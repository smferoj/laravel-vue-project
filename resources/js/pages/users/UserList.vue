<script setup>
import axios from "axios";
import { onMounted,  ref } from "vue";
import { Field} from 'vee-validate';
import { Form} from 'vee-validate';
import * as yup from 'yup';

const users = ref([]);

const getUsers = () => {
    axios.get("/api/users").then((response) => {
        users.value = response.data;
    });
};

const schema = yup.object({
name : yup.string().required(),
email : yup.string().email().required(),
password : yup.string().required().min(8),
});

const createUser = (values, {resetForm}) => {
  axios.post("/api/users", values)
    .then((response) => {
      users.value.unshift(response.data);
      $("#createUserModal").modal("hide"); 
      resetForm();
    });
}

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
                        <h5 class="modal-title" id="exampleModalLabel">
                            User Information
                        </h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <!-- form start -->
                    <Form @submit="createUser" :validation-schema="schema" v-slot="{errors}">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-control" :class="{'is-invalid' : errors.name}"
                                    >Name</label
                                >
                                <Field
                                    name="name"
                                    type="text"
                                    class="form-control"
                                    id="name"
                                />
                                <span class="invalid-feedback">{{ errors.name}}</span>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-control" :class="{'is-invalid' : errors.email}"
                                    >Email</label
                                >
                                <Field
                                    name="email"
                                    type="email"
                                    class="form-control"
                                    id="email"
                                />
                                <span class="invalid-feedback">{{ errors.email}}</span>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-control" :class="{'is-invalid' : errors.password}"
                                    >Password</label
                                >
                                <Field
                                    name="password"
                                    type="password"
                                    class="form-control"
                                    id="password"
                                />
                                <span class="invalid-feedback">{{ errors.password}}</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Save changes
                            </button>
                        </div>
                    </Form>
                    <!-- End form  -->
                </div>
            </div>
        </div>
    </div>
</template>

<style>
/* Add any custom styles if needed */
</style>
