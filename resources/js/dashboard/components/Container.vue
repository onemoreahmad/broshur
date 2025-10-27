<template>
    <div class="mx-auto py-6 md:py-10 max-w-7xl px-1 md:px-3X" v-bind="$attrs">
        <h1 class="text-xl font-bold border-b-2 border-gray-300 border-dotted pb-2">{{ title }}</h1>
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

 