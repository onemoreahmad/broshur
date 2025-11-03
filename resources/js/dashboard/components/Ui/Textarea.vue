<template>
    <UiField :name="name" :label="label"> 
        <textarea v-model="model" 
            class="textarea w-full" 
            :class="{ 'input-error': errorsStore.errors && errorsStore.errors[name] }" 
            :placeholder="placeholder" 
            rows="3" 
            cols="30"
        ></textarea>
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