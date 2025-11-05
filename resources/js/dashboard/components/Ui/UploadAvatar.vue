<template>
    <UiField class="block cursor-pointer" for="upload_avatar" :name="name" >
        <label for="upload_avatar" class="shrink-0 cursor-pointer ">
            <img id='preview_img' class="size-20 object-cover rounded-xl" :src="preview" alt="Current profile photo" />
            <span v-if="preview" class="btn btn-xs mt-2"> تعديل الشعار </span>
        </label> 
        <input type="file" @change="handleFileChange" class="sr-only" id="upload_avatar" />
    </UiField>
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