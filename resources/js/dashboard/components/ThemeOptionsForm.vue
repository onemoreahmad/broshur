<template>
    <div>
   
        <h4 class="text-base font-semibold text-gray-800 mb-3">الخيارات:</h4>
        <ul class="space-y-2">
            <li v-for="(option, name) in themeOptions" :key="name" class="text-gray-600 pr-6 relative">
                <UiRadioField  class="bg-white my-1" 
                    v-if="option.type == 'radio' || option.type == 'picker-color'" 
                    :options="option.options" 
                    v-model="modelValue[name]" 
                    :model="name" 
                    :label="option.label" 
                    placeholder="" 
                    help="" />
            </li>            
        </ul>
                
        <!-- {{ modelValue }} -->

        <button @click="save" class="btn btn-primary" :disabled="formLoading" > 
            <span v-if="!formLoading"> حفظ </span>
            <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
        </button>

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
    }).catch(error => {
        formLoading.value = false
        console.error(error)
    })
}
</script>