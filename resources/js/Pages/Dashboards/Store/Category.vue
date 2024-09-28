<script setup>

import SearchInput from "../../../Components/SearchInput.vue";
import InputError from "../../../Components/InputError.vue";

defineProps({
    categories: Array
})

import {Link, useForm} from '@inertiajs/vue3'
import TextInput from "../../../Components/TextInput.vue";
import InputLabel from "../../../Components/InputLabel.vue";
import {route} from "../../../../../vendor/tightenco/ziggy/src/js/index.js";
import Message from "../../../Components/Message.vue";
const form = useForm({
    ar_name: null,
    en_name: null,
    slug:null,
})

const createCategorySubmit = () => {
    form.post(window.location.pathname, {
        onSuccess: () => {
            console.log('test');
            form.reset()
        }
    });
}

</script>

<template>
  <div class="container">
    <div class="row my-2">
      <div class="col-6">
          <form>
              <SearchInput name="category_filter" />
          </form>
      </div>
        <div class="col-6">
            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#categoryModal">
                Create Category
            </button>
        </div>
    </div>
    <div class="row">
      <table class="table">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Slug</th>
          <th scope="col">Control</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="category of categories.data">
            <th scope="row">{{ category['id'] }}</th>
            <td>{{ category['name'] }}</td>
            <td>{{ category['slug'] }}</td>
            <td>
                <button class="btn btn-outline-primary">Edit</button>
                <button class="btn ms-2 btn-outline-danger">Delete</button>
            </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>



    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content text-dark">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Create Category</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <Message  :message="$page.props.messages" />

                    <form id="createCategoryForm" @submit.prevent="createCategorySubmit" >
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark" form="createCategoryForm">Save Category</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
