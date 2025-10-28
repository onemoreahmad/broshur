<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-3">
                
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

                <fieldset class="fieldset flex items-center gap-x-2">
                    <input 
                            id="about-active" 
                            type="checkbox" 
                            v-model="form.active" 
                            class="toggle toggle-primary" 
                        />
                        
                    <label for="about-active" class="text-sm text-gray-700">
                        {{ form.active ? 'نشط' : 'غير نشط' }}
                    </label>
                </fieldset>
 
                
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
 