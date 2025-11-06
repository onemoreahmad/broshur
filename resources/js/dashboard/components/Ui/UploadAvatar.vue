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
import { ref, watch } from 'vue'
import { useErrorsStore } from '@/stores/errors'
const errorsStore = useErrorsStore()

const emit = defineEmits(['update:modelValue'])
const props = defineProps(['preview', 'name'])
const preview = ref(props.preview)

// Watch for prop changes to update preview when user image is updated
// Only update if current preview is a blob URL (unsaved file) and new value is not (saved image)
watch(() => props.preview, (newValue) => {
    if (newValue) {
        const isCurrentBlob = preview.value?.startsWith('blob:')
        const isNewBlob = newValue.startsWith('blob:')
        
        // Update if new value is a saved image (not blob) and current is blob (unsaved file was just saved)
        // or if new value is a saved image and current is also a saved image (image was updated)
        if (!isNewBlob && (isCurrentBlob || !preview.value || preview.value === '')) {
            preview.value = newValue
        }
    } else if (!preview.value || preview.value.startsWith('blob:')) {
        // If prop becomes empty and we don't have a preview or have a blob, clear it
        preview.value = ''
    }
})

const handleFileChange = (event) => {
    if (event.target.files[0]) {
        preview.value = URL.createObjectURL(event.target.files[0])
        emit('update:modelValue', event.target.files[0])
    }
}
</script>