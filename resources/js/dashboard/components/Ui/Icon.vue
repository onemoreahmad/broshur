<template>
    <UiField :name="name" :label="label"  class="w-full z-50"> 
        <Vue3IconPicker valueType="name"  v-model="model" :placeholder="placeholder" searchPlaceholder="home, user, magic ..etc" iconLibrary="tabler" />
    </UiField>
</template>

<script setup>
 import { Vue3IconPicker } from 'vue3-icon-picker'
 import 'vue3-icon-picker/dist/style.css'

import { useErrorsStore } from '@/stores/errors'

const errorsStore = useErrorsStore()

const model = defineModel()

defineProps({
    name: String,
    label: String,
    placeholder: {
        type: String,
        default: 'اختر الأيقونة',
    },
});

</script>

<style>
.v3ip__search input, .v3ip__search input:focus-visible{
     
    background-color: #fff;
}
.v3ip__custom-select .v3ip__selected[data-v-85d01cbe]{
    padding-right: 2rem !important;
    padding-left: 2rem !important;
}
</style>