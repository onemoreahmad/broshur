<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-3">
                <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                    <h2 class="text-lg font-semibold text-gray-800">من نحن</h2>
                    <label class="toggle toggle-lg" :class="{ 'toggle-primary': form.active, 'toggle-secondary': !form.active }">
                        <input type="checkbox" v-model="form.active" />
                        <svg aria-label="enabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 6 6 18" />
                            <path d="m6 6 12 12" />
                        </svg>
                        <svg aria-label="disabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" stroke="currentColor">
                                <path d="M20 6 9 17l-5-5"></path>
                            </g>
                        </svg>
                    </label>
                </div> 
                
                <label class="input w-full focus-within:ring-offset-0">
                    <span class="label">العنوان</span>
                    <input 
                        v-model="form.title" 
                        type="text" 
                        placeholder="مثال : من نحن ؟" 
                        class="" 
                    />
                    <span v-if="errorsStore.errors && errorsStore.errors['title']" class="text-red-500 text-xs">
                        {{ errorsStore.errors['title'][0] }}
                    </span>
                </label>

                <label class=" w-full h-full">
                    <textarea 
                        v-model="form.text" 
                        placeholder="اكتب النص هنا..." 
                        rows="6"
                        class="textarea w-full input resize-auto"
                    ></textarea>
                    <span v-if="errorsStore.errors && errorsStore.errors['text']" class="text-red-500 text-xs">
                        {{ errorsStore.errors['text'][0] }}
                    </span>
                </label>
 
                
                <div class="flex justify-end w-full">
                    <button 
                        @click="save" 
                        class="btn btn-primary" 
                        :disabled="formLoading"
                    > 
                        <span v-if="!formLoading">حفظ</span>
                        <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'
import { useErrorsStore } from '@/stores/errors'

const errorsStore = useErrorsStore()

const form = ref({
    title: '',
    text: '',
    active: true,
})

const loading = ref(false)
const formLoading = ref(false)
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/about').then(response => {
        form.value = response.data.data
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const save = () => {
    formLoading.value = true;
 
    axios.post('/api/blocks/about', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        
        // Reload preview iframe
        const previewIframe = document.getElementById('preview-iframe')
        if (previewIframe) {
            previewIframe.contentWindow.location.reload();
        }
        
    }) 
    .catch(error => {
        console.error(error.response.data.errors)
        formLoading.value = false;
        if (error.response) {
            errorsStore.setErrors(error.response.data.errors);
        }
    })
}
</script>
 