<script setup>
import Layout from "../../Layout/Layout.vue";
import {Link} from "@inertiajs/vue3";
import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";

import { useForm } from '@inertiajs/vue3'
import Message from "../../Components/Message.vue";
const form = useForm({
    ar_name: null,
    ar_description: null,
    ar_address: null,
    en_name: null,
    en_description: null,
    en_address: null,
    logo: null,
    slug: null,
    phone: null,
    email: null,
})
defineProps({
    errors:Object
})
const submitForm = () => {
    form.post(route('stores.store'), {
        onSuccess: () => {
            form.reset();
        }
    });
}
</script>

<template>
    <form @submit.prevent="submitForm"  class="my-5 p-3 row shadow-lg w-75 rounded-4 g-3 mx-auto  align-items-center">
        <InputError :message="errors.error"/>
        <Message :message="$page.props.messages" />
        <div class="col-12 col-md-6">
            <InputLabel value="Name in English" for="en_name"/>
            <TextInput v-model="form.en_name" id="en_name" type="text" required />
            <InputError :message="form.errors.en_name"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Name in Arabic" for="ar_name"/>
            <TextInput v-model="form.ar_name" id="ar_name" type="text" required />
            <InputError :message="form.errors.ar_name"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Slug" for="slug"/>
            <TextInput v-model="form.slug" id="slug" type="text" required />
            <InputError :message="form.errors.slug"/>
        </div>

        <div class="col-12 col-md-6">
            <InputLabel value="Phone" for="phone"/>
            <TextInput v-model="form.phone" id="phone" type="text" required />
            <InputError :message="form.errors.phone"/>
        </div>

        <div class="col-12 col-md-6">
            <InputLabel value="Email" for="email"/>
            <TextInput v-model="form.email" id="email" type="text" required />
            <InputError :message="form.errors.email"/>
        </div>

        <div class="col-12 col-md-6">
            <InputLabel value="Logo" for="logo"/>
            <TextInput @input="form.logo = $event.target.files[0]" id="logo" type="file" required />
            <InputError :message="form.errors.logo"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Description in English" for="en_description"/>
            <textarea class="form-control" v-model="form.en_description" id="en_description" type="text"  />
            <InputError :message="form.errors.en_description"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Description in Arabic" for="ar_description"/>
            <textarea class="form-control" v-model="form.ar_description" id="ar_description" type="text"  />
            <InputError :message="form.errors.ar_description"/>
        </div>

        <div class="col-12 col-md-6">
            <InputLabel value="Address in English" for="en_address"/>
            <textarea class="form-control" v-model="form.en_address" id="en_address" type="text"  />
            <InputError :message="form.errors.en_address"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Address in Arabic" for="ar_address"/>
            <textarea class="form-control" v-model="form.ar_address" id="ar_address" type="text"  />
            <InputError :message="form.errors.ar_address"/>
        </div>
        <div class="col-12">
            <button type="submit" class="w-100 btn btn-primary btn-dark" :disabled="form.processing">Add Store</button>
        </div>

    </form>
</template>

<style scoped>
</style>
