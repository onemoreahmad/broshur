<template>
    <div class="space-y-2">
        
        <!-- Current Image Preview -->
        <div v-if="preview" class="relative">
            <img :src="preview" alt="Current image" class="w-full h-32 object-cover rounded-lg border border-gray-200" />
            <button 
                @click="removeImage"
                class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        
        <!-- Upload Area -->
        <div v-else class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="mt-2">
                <label for="upload_image" class="cursor-pointer">
                    <span class="text-sm text-gray-600">اضغط لرفع صورة</span>
                    <input 
                        id="upload_image" 
                        type="file" 
                        @change="handleFileChange" 
                        class="sr-only" 
                        accept="image/*"
                    />
                </label>
                <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF حتى 5MB</p>
            </div>
        </div>
        
        <!-- Error Message -->
        <span v-if="errorsStore.errors && errorsStore.errors[props.name]" class="text-red-500 text-xs">
            {{ errorsStore.errors[props.name][0] }}
        </span>
        
        <!-- Upload Progress -->
        <div v-if="uploading" class="flex items-center gap-2 text-sm text-gray-600">
            <span class="loading loading-spinner loading-sm"></span>
            <span>جاري رفع الصورة...</span>
        </div>
    </div>
</template>

<script setup>
import { ref, watch } from 'vue'
import { useErrorsStore } from '@/stores/errors'
import axios from 'axios'

const errorsStore = useErrorsStore()

const emit = defineEmits(['update:modelValue', 'uploaded'])
const props = defineProps({
    preview: {
        type: String,
        default: ''
    },
    name: {
        type: String,
        required: true
    },
    modelId: {
        type: [String, Number, null],
        required: false
    }
})

const uploading = ref(false)
const preview = ref(props.preview)

const handleFileChange = async (event) => {
    const file = event.target.files[0]
    if (!file) return
    
    // Validate file size (5MB max)
    if (file.size > 5 * 1024 * 1024) {
        errorsStore.setErrors({ [props.name]: ['حجم الملف يجب أن يكون أقل من 5 ميجابايت'] })
        return
    }
    
    // Validate file type
    if (!file.type.startsWith('image/')) {
        errorsStore.setErrors({ [props.name]: ['يجب أن يكون الملف صورة'] })
        return
    }
    
    uploading.value = true
    
    try {
        // Create FormData for file upload
        const formData = new FormData()
        formData.append('file', file)
        formData.append('modelType', 'block')
        formData.append('mediaCollection', 'portfolio')
        formData.append('modelId', props.modelId)
        
        // Upload file
        const response = await axios.post('/admin/upload-image', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })
        
        if (response.data.success) {
            // Update preview with uploaded image URL
            emit('update:modelValue', response.data.url)
            preview.value = URL.createObjectURL(file)

        }
        
    } catch (error) {
        console.error('Upload error:', error)
        errorsStore.setErrors({ [props.name]: ['حدث خطأ أثناء رفع الصورة'] })
    } finally {
        uploading.value = false
    }
}

const removeImage = () => {
    preview.value = null
    emit('update:modelValue', null)
}

// Watch for external preview changes
watch(() => props.preview, (newPreview) => {
    if (!newPreview) {
        // Reset file input
        const fileInput = document.getElementById('upload_image')
        if (fileInput) {
            fileInput.value = ''
        }
    }
})
</script>
