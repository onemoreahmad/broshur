<template>
    <div class="">
        <label for="name" class="block text-sm font-bold leading-5 text-gray-500 p-2 sm:w-48"> {{label}} </label>
        <div class="w-full mt-1 flex items-center gap-2 flex-wrap">

            <label class="input radio-input w-fit cursor-pointer"
                v-for="(item,key) in options" 
                :key="key"
                :class="{'bg-blue-200 hover:bg-blue-200  border-blue-300': modelValue == item}"
            > 
                <input
                    type="radio"
                    :value="item"
                    :checked="modelValue == item"
                    @change="$emit('update:modelValue', $event.target.value)"
                    class="radio radio-neutral radio-sm">
                    <span class="capitalize">{{item}}  </span>
            </label>

            <div class="text-xs text-gray-400 leading-2 p-1" v-if="help">{{help}}</div>
        </div>            
    </div>
</template>

<script setup>
 
const props = defineProps(['modelValue',  'options', 'themeOptions', 'model', 'options',  'label', 'placeholder', 'validationErrors', 'help', 'ltr', 'female'])
  

</script>