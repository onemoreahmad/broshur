<template>
    <div>
        <Header />
        <Navbar />
        <RouterView :key="$route.path" />
    </div>
</template>

<script setup>
import { RouterView } from 'vue-router';

defineProps({
    title: {
        type: String,
        required: false,
        default: 'Dashboard',
    },
});
</script>