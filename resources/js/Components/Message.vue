<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p class="fs-3 text-success">
            {{ message }}
        </p>
    </div>
</template>
