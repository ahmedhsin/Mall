<script setup>

import SearchInput from "./SearchInput.vue";
import DropDownMenu from "./DropDownMenu.vue";
import DateFilter from "./DateFilter.vue";
</script>

<template>
    <div class="row mx-0 align-items-center">
        <h2 class="m-3 col-2">Stores</h2>
        <SearchInput model-value="" class="col-2"/>
        <div class="col-2">
            <DropDownMenu model-value="" :columns="[
                {text:'created date', value: 'createdAt'},
                {text:'Name', value: 'name'}
            ]"/>
        </div>
        <div class="col-1">
        </div>
        <div class="col-2 d-flex align-items-center gap-1">
            <DateFilter model-value="" id="from" name="startdate"/>
            <i  class="mx-2 fa-solid fa-arrow-right"></i>
            <DateFilter model-value="" id="to" name="enddate"/>
        </div>
    </div>
</template>

<style scoped>

</style>
