<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import {cart, addToCart} from "./cartStore.js";

const {product} = defineProps({
    product: Object
});

const currentImageIndex = ref(0);

const changeImage = (index) => {
    if (index >= 0 && index < product.data.images.length) {
        currentImageIndex.value = index;
    }
};

</script>

<template>
    <div class="product-container">
        <div class="product-content">
            <!-- Product Images Slider -->
            <div class="product-image-wrapper">
                <img :src="`/images/${product.data.images[currentImageIndex]?.name}`" alt="Product Image" class="product-image" />
                <div class="image-thumbnails">
                    <img
                        v-for="(image, index) in product.data.images"
                        :key="image.id"
                        :src="`/images/${image.name}`"
                        alt="Product Thumbnail"
                        class="thumbnail-image"
                        @click="changeImage(index)"
                        :class="{ 'active-thumbnail': index === currentImageIndex }"
                    />
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="product-details">
                <h1 class="product-title">{{ product.data.name }}</h1>

                <!-- Product Brand and Categories -->
                <p class="product-brand">Brand: {{ product.data.brand }}</p>

                <!-- Categories -->
                <p class="product-categories">
                    Categories:
                    <span v-for="category in product.data.categories" :key="category.id">
            <Link :href="`?category=${category.slug}`">{{ category.name }}</Link>
            <span v-if="category !== product.data.categories[product.data.categories.length - 1]">, </span>
          </span>
                </p>

                <p class="product-price">Price: ${{ product.data.price }}</p>

                <p class="product-stock" v-if="product.data.stock > 0">
                    In Stock: {{ product.data.stock }} units
                </p>
                <p class="product-stock out-of-stock" v-else>
                    Out of Stock
                </p>

                <p class="product-dimensions">Dimensions: {{ product.data.dimensions }}</p>

                <button @click="addToCart(product.data)" class="btn btn-dark btn-lg">
                    Add to Cart
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.product-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.product-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

.product-image-wrapper {
    position: relative;
    max-width: 100%;
    text-align: center;
}

.product-image {
    max-width: 80%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.image-thumbnails {
    display: flex;
    justify-content: center;
    margin-top: 10px;
    gap: 10px;
}

.thumbnail-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
}

.thumbnail-image:hover {
    transform: scale(1.1);
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
}

.active-thumbnail {
    border: 2px solid #007bff;
}

.product-details {
    text-align: center;
}

.product-title {
    font-size: 2.5rem;
    margin-bottom: 10px;
    color: #333;
}

.product-brand,
.product-categories,
.product-price,
.product-stock,
.product-dimensions {
    font-size: 1.2rem;
    color: #555;
    margin: 5px 0;
}

.product-price {
    font-size: 1.5rem;
    color: #d9534f;
    font-weight: bold;
}

.product-stock {
    color: green;
    font-weight: bold;
}

.out-of-stock {
    color: red;
    font-weight: bold;
}

.add-to-cart-btn {
    margin-top: 20px;
    padding: 10px 20px;
    font-size: 1.2rem;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.add-to-cart-btn:hover {
    background-color: #0056b3;
}
</style>
