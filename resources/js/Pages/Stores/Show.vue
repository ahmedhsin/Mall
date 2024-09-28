<script setup>
import StoreCard from "../../Components/StoreCard.vue";
import SearchInput from "../../Components/SearchInput.vue";
import DateFilter from "../../Components/DateFilter.vue";

import DropDownMenu from "../../Components/DropDownMenu.vue";
import Checkbox from "../../Components/Checkbox.vue";
import InputLabel from "../../Components/InputLabel.vue";
import {Link} from "@inertiajs/vue3";
import SecondaryButton from "../../Components/SecondaryButton.vue";

defineProps({
    store:Object,
    canEdit: Boolean
})
</script>

<template>

    <div class="container m-3 p-3">
        <div class="row justify-content-center">

            <div class="col-8 col-md-4">
                <img :src="`/images/${store.data.logo}`" class="mx-auto company-logo" alt="company-logo">
                <h2 class="m-3 col-2">{{ store.data.name }}</h2>
                <p class="card-text"><span class="me-2"><i class="fa-solid fa-phone"></i></span>{{store.data.phone}}</p>
                <p class="card-text"><span class="me-2"><i class="fa-regular fa-envelope"></i></span>{{store.data.email}}</p>
                <Link class="text-decoration-none" :href="`/stores/${store.data.id}/products`"><p><span class="me-2"><i class="fa-solid fa-link"></i></span>{{store.data.slug}}/products</p></Link>
            </div>
            <div class="col-8 col-md-4">
                <p class="card-text">{{store.data.description}}</p>
                <p class="card-text">{{store.data.address}}</p>
            </div>
            <div v-if="canEdit" class="col-12 col-md-3 order-first order-md-last ">
                <div class="d-flex gap-2 justify-content-end my-2">
                    <Link :href="`/stores/${store.data.id}/edit`" class=" mx-2 btn btn-outline-primary ">Edit</Link>
                    <Link :href="`/dashboard/stores/${store.data.id}`" class="btn btn-dark ">Manage</Link>
                </div>
            </div>
        </div>
    </div>
    <div class="row flex-column justify-content-center gap-2 m-0 p-0">

    </div>
</template>

<style scoped>
.company-logo{
    max-width: 300px;
    max-height: 300px;
    object-fit: contain;
    border-radius: 30px;
}
</style>
