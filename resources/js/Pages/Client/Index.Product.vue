<script setup>
import SearchInput from "../../Components/SearchInput.vue";
import { Link } from "@inertiajs/vue3";
import InputLabel from "../../Components/InputLabel.vue";
import getWindow from "@popperjs/core/lib/dom-utils/getWindow.js";

// Define props to accept products data
defineProps({
    products: Array
});
</script>

<template>
    <div class="container">
        <div class="row row-gap-2 mx-0 align-items-center justify-content-center">
            <h2 class="m-3 col-4 col-md-2">Products</h2>
            <SearchInput model-value="" class="col-6 col-md-4" />
        </div>

        <div class="row flex-wrap justify-content-center gap-2 m-0 p-0 my-2">
            <!-- Featured Products -->
            <div
                class="col-9 col-md-4 col-lg-3"
                v-for="product in products.data.filter(product => product.featured)"
                :key="product.id"
            >
                <Link :href="`products/${product.id}`" class="product-card">
                    <img :src="`/images/${product.images[0]?.name}`" alt="Product Image" class="product-image" />
                    <h3 class="product-name">{{ product.name }}</h3>
                    <p class="product-price">Price: ${{ product.price }}</p>
                    <span class="featured-label">Featured</span>
                </Link>
            </div>

            <!-- Other Products -->
            <div
                class="col-9 col-md-4 col-lg-3"
                v-for="product in products.data.filter(product => !product.featured)"
                :key="product.id"
            >
                <Link :href="`products/${product.id}`" class="product-card">
                    <img :src="`/images/${product.images[0]?.name}`" alt="Product Image" class="product-image" />
                    <h3 class="product-name">{{ product.name }}</h3>
                    <p class="product-price">Price: ${{ product.price }}</p>
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
a{
    text-decoration: none;
    color: #1a202c;
}
.container {
    padding: 20px;
}

.product-card {
    border: 1px solid #ccc;
    border-radius: 8px;
    text-align: center;
    padding: 16px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s;
    position: relative; /* For positioning the featured label */
    display: block; /* Ensures the link takes up the full card area */
}

.product-card:hover {
    transform: scale(1.02);
}

.product-image {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
}

.product-name {
    font-size: 1.5em;
    margin: 10px 0;
}

.product-price {
    margin: 5px 0;
}

.featured-label {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #ffcc00; /* Highlight color for featured label */
    color: white;
    padding: 5px 10px;
    border-radius: 4px;
    font-weight: bold;
}

.row {
    margin-bottom: 20px; /* Spacing between rows */
}
</style>
