<script setup>
import Layout from "../../Layout/Layout.vue";
import {Link} from "@inertiajs/vue3";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";

import { useForm } from '@inertiajs/vue3'
const form = useForm({
    email: null,
    password: null
})
defineProps({
    errors:Object
})
const submitForm = () => {
    form.post(route('login.store'), {
        onFinish: () => {
            form.reset('password')
        }
    });
}
</script>

<template>
    <form @submit.prevent="submitForm" class="my-5 p-3 row w-50 shadow-lg rounded-4 flex-column g-3 mx-auto justify-content-center align-items-center">
        <InputError :message="errors.error"/>
        <div class="col">
            <InputLabel value="Email" for="email"/>
            <TextInput v-model="form.email" id="email" type="email" required />
            <InputError :message="form.errors.email"/>
        </div>
        <div class="col">
            <InputLabel value="Password" for="password"/>
            <TextInput v-model="form.password" id="password" type="password" required />
            <InputError :message="form.errors.password"/>
        </div>
        <div class="col">
            <button type="submit" class="w-100 btn btn-primary btn-dark" :disabled="form.processing">Login</button>
        </div>
        <p class="text-secondary">Don't have an account yet?  <Link class="text-decoration-none text-dark" :href="route('register.create')">Sign Up</Link></p>

    </form>
</template>

<style scoped>
</style>
