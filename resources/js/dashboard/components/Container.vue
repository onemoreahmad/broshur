<template>
    <div class="mx-auto py-6 md:py-10 max-w-7xl px-1 md:px-3X" v-bind="$attrs">
        <h1>{{ title }}</h1>
        <slot />
    </div>
</template>

<script setup>
const props = defineProps({
    title: {
        type: String,
        required: false
    }
})
</script>

 