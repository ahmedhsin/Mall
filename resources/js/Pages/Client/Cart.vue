<script setup>
import { cart, removeFromCart } from "./cartStore.js"; // Import cart and removeFromCart
</script>

<template>
    <div class="container my-4">
        <h2 class="mb-4">Your Cart</h2>

        <div v-if="cart.items.length === 0" class="empty-cart text-center">
            <p class="lead">Your cart is empty.</p>
        </div>

        <div v-else>
            <div class="cart-items row">
                <div v-for="item in cart.items" :key="item.id" class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img :src="`/images/${item.image}`" alt="Product Image" class="card-img-top cart-item-image" />
                        <div class="card-body">
                            <h5 class="card-title">{{ item.name }}</h5>
                            <p class="card-text">Price: ${{ item.price }}</p>
                            <p class="card-text">Quantity: {{ item.quantity }}</p>
                            <button @click="removeFromCart(item.id)" class="btn btn-danger">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cart-summary text-end mt-4">
                <h3>Total: ${{ cart.items.reduce((total, item) => total + item.price * item.quantity, 0).toFixed(2) }}</h3>
                <a href="/checkout/create" class="btn btn-dark">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</template>

<style scoped>
.empty-cart {
    padding: 20px;
}

.cart-item-image {
    height: 200px;
    object-fit: cover;
}
</style>
