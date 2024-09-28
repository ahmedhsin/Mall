<script setup>

import {Link} from "@inertiajs/vue3";

defineProps({
    store: Object
})
</script>

<template>
    <div class="card">
        <img :src="`images/${store.logo}`" class="card-img-top mx-auto company-logo" alt="company-logo">
        <div class="card-body">
            <h5 class="card-title">{{ store.name }}</h5>
            <p class="card-text"><span class="me-2"><i class="fa-solid fa-phone"></i></span>{{store.phone}}</p>
            <p class="card-text"><span class="me-2"><i class="fa-regular fa-envelope"></i></span>{{store.email}}</p>
            <Link class="text-decoration-none" :href="`/stores/${store.id}`"><p><span class="me-2"><i class="fa-solid fa-link"></i></span>{{store.slug}}</p></Link>
        </div>
    </div>
</template>

<style scoped>
.company-logo{
    width: 150px;
    height: 150px;
    object-fit: contain;
}
</style>
