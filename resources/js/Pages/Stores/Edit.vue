<script setup>

import InputLabel from "../../Components/InputLabel.vue";
import TextInput from "../../Components/TextInput.vue";
import InputError from "../../Components/InputError.vue";

import { useForm } from '@inertiajs/vue3'
import Message from "../../Components/Message.vue";
const {store} = defineProps({
    errors:Object,
    store:Object
})
const form = useForm({
    ar_name: store.data.ar_name,
    ar_description: store.data.ar_description,
    ar_address: store.data.ar_address,
    en_name: store.data.en_name,
    en_description: store.data.en_description,
    en_address: store.data.en_address,
    logo: null,
    slug: store.data.slug,
    phone: store.data.phone,
    email: store.data.email,
})


const submitForm = () => {
    form.post(route('stores.update', {"id":store.data.id}), {
        onSuccess: () => {
            form.reset();
        }
    });
}
</script>

<template>
    <form @submit.prevent="submitForm"  class="my-5 p-3 row shadow-lg w-75 rounded-4 g-3 mx-auto  align-items-center">
        <InputError :message="errors.error" />
        <Message :message="$page.props.messages" />
        <div class="col-12 col-md-6">
            <InputLabel value="Name in English" for="en_name"/>
            <TextInput v-model="form.en_name" id="en_name" type="text" required />
            <InputError :message="form.errors.en_name"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Name in Arabic" for="ar_name"/>
            <TextInput v-model="form.ar_name"  id="ar_name" type="text" required />
            <InputError :message="form.errors.ar_name"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Slug" for="slug"/>
            <TextInput v-model="form.slug" id="slug"  type="text" required />
            <InputError :message="form.errors.slug"/>
        </div>

        <div class="col-12 col-md-6">
            <InputLabel value="Phone" for="phone"/>
            <TextInput v-model="form.phone" id="phone"  type="text" required />
            <InputError :message="form.errors.phone"/>
        </div>

        <div class="col-12 col-md-6">
            <InputLabel value="Email" for="email"/>
            <TextInput v-model="form.email" id="email" type="text"  required />
            <InputError :message="form.errors.email"/>
        </div>

        <div class="col-12 col-md-6">
            <InputLabel value="Logo" for="logo"/>
            <p class="f-6 text-danger fst-italic">if you choose new image old one will be override</p>
            <template v-if="form.logo == null">
                <br>
                <img :src="`/images/${store.data.logo}`" class="img-fluid company-logo" />
            </template>
            <TextInput @input="form.logo = $event.target.files[0]" id="logo" type="file" />
            <InputError :message="form.errors.logo"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Description in English" for="en_description"/>
            <textarea class="form-control" v-model="form.en_description" id="en_description" type="text"  ></textarea>
            <InputError :message="form.errors.en_description"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Description in Arabic" for="ar_description"/>
            <textarea class="form-control" v-model="form.ar_description" id="ar_description" type="text"  ></textarea>
            <InputError :message="form.errors.ar_description"/>
        </div>

        <div class="col-12 col-md-6">
            <InputLabel value="Address in English" for="en_address"/>
            <textarea class="form-control" v-model="form.en_address" id="en_address" type="text"  ></textarea>
            <InputError :message="form.errors.en_address"/>
        </div>
        <div class="col-12 col-md-6">
            <InputLabel value="Address in Arabic" for="ar_address"/>
            <textarea class="form-control" v-model="form.ar_address" id="ar_address"  type="text"  ></textarea>
            <InputError :message="form.errors.ar_address"/>
        </div>
        <div class="col-12">
            <button type="submit" class="w-100 btn btn-primary btn-dark" :disabled="form.processing">Update</button>
        </div>

    </form>

</template>

<style scoped>
.company-logo{
    max-width: 100px;
    max-height: 100px;
    object-fit: contain;
    border-radius: 30px;
}
</style>
