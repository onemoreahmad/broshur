<template>
    <UiField :name="name" :label="label"> 
        <input v-model="model" 
            class="input w-full" 
            :class="{ 'input-error': errorsStore.errors && errorsStore.errors[name] }" 
            :placeholder="placeholder" 
            type="text" 
        />
    </UiField>
</template>

<script setup>
import { useErrorsStore } from '@/stores/errors'

const errorsStore = useErrorsStore()

const model = defineModel()

defineProps({
    name: String,
    label: String,
    placeholder: String,
});

</script>