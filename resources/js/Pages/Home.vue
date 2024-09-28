<script setup>
import { Head } from '@inertiajs/vue3'
</script>

<template>
    <Head title="Welcome" />
    <div class="container my-5">
        <h2 class="text-center text-primary mb-4">Welcome to Our Store Platform!</h2>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card shadow border-light">
                    <div class="card-body">
                        <h5 class="card-title">Create Your Store</h5>
                        <p class="card-text">
                            With our platform, you can easily create your own store and showcase your products to the world. It's user-friendly and quick to set up!
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow border-light">
                    <div class="card-body">
                        <h5 class="card-title">Manage Products</h5>
                        <p class="card-text">
                            Add and manage your products effortlessly. From pricing to stock levels, everything is at your fingertips.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card shadow border-light">
                    <div class="card-body text-center">
                        <h5 class="card-title">Make Purchases</h5>
                        <p class="card-text">
                            Explore a variety of stores and products. Your next favorite item is just a click away!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.card {
    transition: transform 0.2s;
}
.card:hover {
    transform: scale(1.05);
}
</style>
