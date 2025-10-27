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
const store = useAuthStore()

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
    axios.post('/api/blocks/header', block.value).then(response => {
        console.log(response.data)
        formLoading.value = false
 
        store.updateTenant({
            name: response.data.data.name,
            slogan: response.data.data.slogan,
            logo: response.data.data.logo,
        })
    })
    .catch(error => {
        console.error(error)
        formLoading.value = false
    })
}
</script>