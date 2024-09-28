<script setup>
import StoreCard from "../../Components/StoreCard.vue";
import SearchInput from "../../Components/SearchInput.vue";
import {Link} from "@inertiajs/vue3";
import Checkbox from "../../Components/Checkbox.vue";
import InputLabel from "../../Components/InputLabel.vue";

defineProps({
    stores:Array
})
</script>

<template>

    <div class="row row-gap-2 mx-0 align-items-center justify-content-center">
        <h2 class="m-3 col-4 col-md-2">Stores</h2>
        <SearchInput model-value="" class="col-6 col-md-4"/>
        <div class="col-6 col-md-2 justify-content-center align-items-center">
            <InputLabel value="My Stores Only" for="my-store" />
            <checkbox checked="false" class="mx-2" id="my-store"/>
        </div>
        <div class="col-6 col-md-2 mb-2">
            <Link href="stores/create" class="btn btn-dark"> Create Store</Link>
        </div>
    </div>

    <div class="row flex-wrap justify-content-center gap-2 m-0 p-0">
        <div class="col-9 col-md-4 col-lg-3" v-for="store in stores.data">
            <StoreCard :store="store" />
        </div>
    </div>
</template>

<style scoped>

</style>
