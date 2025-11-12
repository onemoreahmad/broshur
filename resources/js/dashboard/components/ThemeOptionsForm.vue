<template>
    <div>
     
        <h4 class="text-base font-semibold text-gray-800 mb-3 border-b-2 border-gray-200 pb-3 border-dashed"> خيارات القالب </h4>
        <div class="space-y-3 flex flex-col gap-3 w-full">
            <div v-for="(option, name) in themeOptions" :key="name" >
                <UiRadioField  class="bg-white my-1" 
                    v-if="option.type == 'radio'" 
                    :options="option.options" 
                    v-model="modelValue[name]" 
                    :model="name" 
                    :label="option.label" 
                    placeholder="" 
                    help="" />

                <UiPickColor   
                    v-if="option.type == 'picker-color'" 
                    :options="option.options" 
                    v-model="modelValue[name]" 
                    :name="name" 
                    :label="option.label" 
                    placeholder="" 
                    help="" />

               
                <UiUploadImage
                    v-if="option.type == 'upload-single-image'" 
                    v-model="modelValue[name]" 
                    :name="name"
                    :preview="modelValue[name] != null ? storageUrl +  modelValue[name] : ''"
                    :model="name" 
                    :label="option.label" 
                    :placeholder="option.placeholder" 
                    help="option.info" 
                    :modelId="props.modelId"
                    modelType="tenant"
                    mediaCollection="theme-media"
                    collection="theme-media"
                />
            </div>            
        </div>
                
        <!-- {{ modelValue }} -->

        <div class="flex justify-end mt-10">
            <button @click="save" class="btn btn-primary w-full" :disabled="formLoading" > 
                <span v-if="!formLoading"> حفظ خيارات القالب </span>
                <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
            </button>
        </div>
    </div>
</template> 
 
<script setup>

import { ref, computed } from 'vue'
import axios from 'axios'
import { useNotification } from '@kyvg/vue3-notification'

const formLoading = ref(false)
const { notify } = useNotification()

const props = defineProps(['modelValue', 'options', 'themeOptions', 'themeId'])
import { useAuthStore } from '@/stores/auth'
import { storeToRefs } from 'pinia'

const { user } = storeToRefs(useAuthStore())

const storageUrl = computed(() => user.value?.storageUrl ?? '') 

const save = () => {
    formLoading.value = true
        axios.post('/api/theme-options', {  options: props.modelValue, theme_id: props.themeId }).then(response => {
        formLoading.value = false
        console.log(response.data)

        notify({ type: "success", text: "تم حفظ خيارات القالب بنجاح" })
        
        document.getElementById('preview-iframe').contentWindow.location.reload();

    }).catch(error => {
        formLoading.value = false
        console.error(error)
        notify({ type: "error", text: "فشل حفظ خيارات القالب" })
    })
}
</script>