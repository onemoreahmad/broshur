<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
        <div >
            <fieldset v-if="block" class="fieldset mt-4">
                <legend class="fieldset-legend"> اسم البروشور </legend>
                <input v-model="block.name" type="text" class="input" placeholder="الاسم" />
                <span v-if="errorsStore.errors && errorsStore.errors['name']" class="text-red-500">   {{ errorsStore.errors['name'][0] }} </span>
            </fieldset>
            <fieldset v-if="block" class="fieldset mt-4">
                <legend class="fieldset-legend"> اسم البروشور </legend>
                <input v-model="block.slogan" type="text" class="input" placeholder="الاسم" />
            </fieldset>

            <button @click="save" class="btn btn-primary" :disabled="formLoading" > 
                <span v-if="!formLoading"> حفظ </span>
                <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
            </button>

            <!--<pre>{{ block }}</pre>-->
        </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted } from 'vue'
import { useAuthStore } from '@/stores/auth'
import { useErrorsStore } from '@/stores/errors'
const store = useAuthStore()
const errorsStore = useErrorsStore()

const block = ref(null)
const loading = ref(false)
const formLoading = ref(false)
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/header').then(response => {
        block.value = response.data.data
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const save = () => {
    formLoading.value = true
    axios.patch('/api/blocks/header', {
        name: block.value.name,
        slogan: block.value.slogan,
        logo: block.value.logo ? block.value.logo : null,
        cover: block.value.cover ? block.value.cover : null,
    }).then(response => {
        console.log(response.data)
        formLoading.value = false
        errorsStore.setErrors([]);

        store.updateTenant({
            name: response.data.data.name,
            slogan: response.data.data.slogan,
            logo: response.data.data.logo,
        })
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