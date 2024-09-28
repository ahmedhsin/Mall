<script setup>
import Layout from "../../Layout/Layout.vue";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";

import {Link, useForm} from '@inertiajs/vue3'
const form = useForm({
    name: null,
    email: null,
    phone:null,
    password: null
})
const submitForm = () => {
    form.post(route('register.store'), {
        onFinish: () => {
            form.reset('password')
        }
    });
}
</script>

<template>
    <form @submit.prevent="submitForm" class="my-5 p-3 row w-50 shadow-lg rounded-4 flex-column g-3 mx-auto justify-content-center align-items-center">
        <div class="col">
            <InputLabel value="Name" for="name"/>
            <TextInput v-model="form.name" id="name" required />
            <InputError :message="form.errors.name"/>
        </div>
        <div class="col">
            <InputLabel value="Email" for="email"/>
            <TextInput v-model="form.email" id="email" type="email" required />
            <InputError :message="form.errors.email"/>
        </div>
        <div class="col">
            <InputLabel value="Phone" for="phone"/>
            <TextInput v-model="form.phone" id="phone" type="text" required />
            <InputError :message="form.errors.phone"/>
        </div>
        <div class="col">
            <InputLabel value="Password" for="password"/>
            <TextInput v-model="form.password" id="password" type="password" required />
            <InputError :message="form.errors.password"/>
        </div>
        <div class="col">
            <button type="submit" class="w-100 btn btn-primary btn-dark" :disabled="form.processing">Register</button>
        </div>
        <p class="text-secondary">Already have an account? <Link class="text-decoration-none text-dark" :href="route('login.create')">Sign in</Link></p>

    </form>
</template>

<style scoped>
</style>
