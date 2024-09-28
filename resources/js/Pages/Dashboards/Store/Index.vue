<script setup>
const url = window.location.pathname;
</script>

<template>
    <div class="container my-5 py-5">
        <h2 class="text-center mb-4 text-white">Dashboard</h2>

        <div class="row justify-content-center">
            <div class="col-md-3 mb-3">
                <a :href="`${url}/categories`" class="btn btn-dark btn-lg btn-block text-white shadow rounded-pill w-100">Categories</a>
            </div>
            <div class="col-md-3 mb-3">
                <a :href="`${url}/orders`" class="btn btn-dark btn-lg btn-block text-white shadow rounded-pill w-100">Orders</a>
            </div>
            <div class="col-md-3 mb-3">
                <a :href="`${url}/products`" class="btn btn-dark btn-lg btn-block text-white shadow rounded-pill w-100">Products</a>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    background-color: #343a40;
    border-radius: 15px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.btn:hover {
    background-color: #212529;
    transform: translateY(-2px);
    transition: all 0.3s ease-in-out;
}

.row .col-md-3 {
    padding: 0 10px;
}
</style>
