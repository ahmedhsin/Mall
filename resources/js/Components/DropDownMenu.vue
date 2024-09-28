<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});
defineProps({
    columns:Array
})
const input = ref(null);
</script>

<template>
    <!--
    <input
        class="form-control"
        v-model="model"
        ref="input"
    />
    -->
    <select class="form-select" v-model="selectedColumn"  aria-label="Default select example">
        <option selected disabled>Order By</option>
        <option v-for="col in columns" v-text="col.text" :key="col.name" :value="col.name"></option>
    </select>
</template>
