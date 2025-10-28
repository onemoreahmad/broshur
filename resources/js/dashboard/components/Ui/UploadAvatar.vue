<template>
    <label class="block cursor-pointer" for="upload_avatar">
        <div class="shrink-0">
            <img id='preview_img' class="h-16 w-16 object-cover rounded-full" :src="preview" alt="Current profile photo" />
        </div>
        <span class="sr-only">اختر صورة</span>
        <input type="file" @change="handleFileChange" class="sr-only" id="upload_avatar" />
        <span v-if="errorsStore.errors && errorsStore.errors[props.name]" class="text-red-500 text-xs">  
             {{ errorsStore.errors[props.name][0] }} 
        </span>
    </label>
</template>

<script setup>
import { ref } from 'vue'
import { useErrorsStore } from '@/stores/errors'
const errorsStore = useErrorsStore()

const emit = defineEmits(['update:modelValue'])
const props = defineProps(['preview', 'name'])
const preview = ref(props.preview)

const handleFileChange = (event) => {
    preview.value = URL.createObjectURL(event.target.files[0])
    emit('update:modelValue', event.target.files[0])
}
</script>