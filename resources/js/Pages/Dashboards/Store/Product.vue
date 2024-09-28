<script setup>

import SearchInput from "../../../Components/SearchInput.vue";
import InputError from "../../../Components/InputError.vue";

defineProps({
    products: Array
})

const url = window.location.pathname;
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
                <a  :href="`${url}/create`" class="btn btn-dark" >
                    Create Product
                </a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">description</th>
                    <th scope="col">price</th>
                    <th scope="col">stock</th>
                    <th scope="col">status</th>
                    <th scope="col">brand</th>
                    <th scope="col">Categories</th>
                    <th scope="col">featured</th>
                    <th scope="col">created_at</th>
                    <th scope="col">control</th>

                </tr>
                </thead>
                <tbody>
                <tr v-for="product of products.data">
                    <th scope="row">{{ product['id'] }}</th>
                    <td>{{ product['name'] }}</td>
                    <td>{{ product['description'] }}</td>
                    <td>{{ product['price'] }}</td>
                    <td>{{ product['stock'] }}</td>
                    <td>{{ product['status'] }}</td>
                    <td>{{ product['brand'] }}</td>
                    <td><span class="fs-10 ms-1" v-for="category of product['categories']">
                        {{category['name']}}
                    </span></td>
                    <td>{{ product['featured'] }}</td>
                    <td>{{ product['created_at'] }}</td>
                    <td>
                        <a :href="`${url}/${product['id']}/update`" class="btn btn-outline-primary">Edit</a>
                        <button class="btn ms-2 btn-outline-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>
.fs-10{
    font-size: 12px;
}
</style>
