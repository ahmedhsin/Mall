<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    stores: Object
});
</script>

<template>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Your Stores</h2>

        <div v-if="stores.data.length > 0">
            <div class="row g-3">
                <div v-for="store in stores.data" :key="store.id" class="col-12 col-md-6">
                    <div class="card shadow-sm">
                        <img :src="`images/${store.logo}`" class="card-img-top" alt="Store Logo" style="height: 200px; object-fit: contain;">

                        <div class="card-body">
                            <h5 class="card-title">{{ store.name }}</h5>
                            <p class="card-text">{{ store.description || 'No description available' }}</p>

                            <ul class="list-group list-group-flush mb-3">
                                <li class="list-group-item"><strong>Email:</strong> {{ store.email }}</li>
                                <li class="list-group-item"><strong>Phone:</strong> {{ store.phone }}</li>
                                <li class="list-group-item"><strong>Status:</strong> {{ store.status }}</li>
                            </ul>

                            <Link :href="`/dashboard/stores/${store.id}`" class="btn btn-dark w-100">Go to Dashboard</Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else>
            <p class="text-center">No stores available.</p>
        </div>
    </div>
</template>

<style scoped>
.card {
    margin-bottom: 20px;
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}
</style>
