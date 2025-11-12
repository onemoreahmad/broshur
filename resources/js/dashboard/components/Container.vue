<template>
    <div class="mx-auto py-6 md:py-10 max-w-7xl px-1 md:px-3X" v-bind="$attrs">

        <div v-if="title" class="border-b-2 border-gray-300 border-dotted pb-2 mb-6">
            <h1 class="text-xl font-bold ">{{ title }}</h1>
            <p v-if="subtitle" class="text-gray-400 font-light  text-sm">{{ subtitle }}</p>
        </div>

        <div class="px-2 md:px-0 mb-6"> 
            <slot />
        </div>
   
    </div>
</template>

<script setup>
const props = defineProps({
    title: {
        type: String,
        required: false
    },
    subtitle: {
        type: String,
        required: false
    }
})
</script>

 