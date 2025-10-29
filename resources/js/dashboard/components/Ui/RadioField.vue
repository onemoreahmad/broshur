<template>
    <div class="bg-gray-50 p-2 py-1 rounded sm:max-w-3xl mb-1 last:mb-0 sm:flex sm:items-center">
        <label for="name" class="block text-sm font-bold leading-5 text-gray-500 p-2 sm:w-48"> {{label}} </label>
        <div class="bg-gray-100 p-1 w-full rounded mt-1">

            <label class="ms-2 text-xs mb-1 font-bold text-cool-gray-600 cursor-pointer border-2 border-transparent hover:bg-blue-100 bg-gray-200 px-2 py-2 rounded inline-block"
                v-for="(item,key) in options" 
                :key="key"
                :class="{'bg-blue-200 hover:bg-blue-200  border-blue-300': modelValue == item}"
            > 
                <input
                    type="radio"
                    :value="item"
                    :checked="modelValue == item"
                    @change="$emit('update:modelValue', $event.target.value)"
                    class="me-1 p-1">
                    <span class="capitalize">{{item}}  </span>
            </label>

            <div class="text-xs text-gray-400 leading-2 p-1" v-if="help">{{help}}</div>
        </div>            
    </div>
</template>

<script setup>
 
const props = defineProps(['modelValue',  'options', 'themeOptions', 'model', 'options',  'label', 'placeholder', 'validationErrors', 'help', 'ltr', 'female'])
  

</script>