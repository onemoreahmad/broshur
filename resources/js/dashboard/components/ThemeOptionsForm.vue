<template>
    <div>
   
        <h4 class="text-base font-semibold text-gray-800 mb-3 border-b-2 border-gray-200 pb-3 border-dashed"> خيارات القالب </h4>
        <div class="space-y-3 flex flex-col gap-3 w-full">
            <div v-for="(option, name) in themeOptions" :key="name" class="relative">
                <UiRadioField  class="bg-white my-1" 
                    v-if="option.type == 'radio'" 
                    :options="option.options" 
                    v-model="modelValue[name]" 
                    :model="name" 
                    :label="option.label" 
                    placeholder="" 
                    help="" />

                <UiPickColor  class="bg-white my-1" 
                    v-if="option.type == 'picker-color'" 
                    :options="option.options" 
                    v-model="modelValue[name]" 
                    :model="name" 
                    :label="option.label" 
                    placeholder="" 
                    help="" />
            </div>            
        </div>
                
        <!-- {{ modelValue }} -->

        <div class="flex justify-end mt-4">
            <button @click="save" class="btn btn-primary" :disabled="formLoading" > 
                <span v-if="!formLoading"> حفظ </span>
                <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
            </button>
        </div>
    </div>
</template> 
 
<script setup>

import { ref } from 'vue'
import axios from 'axios'
 
const formLoading = ref(false)

const props = defineProps(['modelValue', 'options', 'themeOptions', 'themeId'])


const save = () => {
    formLoading.value = true
        axios.post('/api/theme-options', {  options: props.modelValue, theme_id: props.themeId }).then(response => {
        formLoading.value = false
        console.log(response.data)

        document.getElementById('preview-iframe').contentWindow.location.reload();

    }).catch(error => {
        formLoading.value = false
        console.error(error)
    })
}
</script>