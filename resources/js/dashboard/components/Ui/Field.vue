<template>
    <div class="w-full bg-base-200/40 rounded-lg p-2">
        <label class="flex items-center gap-x-2 w-full">
            <span v-if="label" class="label text-sm w-36 truncate">{{ label }}</span>
            <div class="w-full">
                <slot />
            </div>
        </label>
        <span v-if="errorsStore.errors && errorsStore.errors[name]" class="text-red-500 text-xs ms-32 mt-2 inline-block">
            {{ errorsStore.errors[name][0] }}
        </span>
    </div>
</template>

<script setup>
import { useErrorsStore } from '@/stores/errors'

const errorsStore = useErrorsStore()

defineProps({
    name: String,
    label: String,
});
</script>