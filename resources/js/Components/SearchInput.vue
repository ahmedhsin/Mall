<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div>
        <input
            class="form-control"
            v-model="model"
            ref="input"
            placeholder="Search"
        />
        <i class="fa-solid fa-magnifying-glass"></i>
    </div>
</template>

<style scoped>
i{
    position: absolute;
    top: 12px;
    right: 25px;
}
div{
    position: relative;
}
</style>
