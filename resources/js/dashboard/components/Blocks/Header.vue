<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
        <div class="flex flex-col gap-3">
            <label class="input w-full focus-within:ring-offset-0 ">
                <span class="label">اسم البروشور</span>
                <input v-model="form.name" type="text" placeholder="الاسم" class="" />
                <span v-if="errorsStore.errors && errorsStore.errors['name']" class="text-red-500">   {{ errorsStore.errors['name'][0] }} </span>
            </label>

            <label class="input w-full">
                <span class="label">الشعار النصي</span>
                <input v-model="form.slogan" type="text" placeholder="الشعار النصي" />
                <span v-if="errorsStore.errors && errorsStore.errors['slogan']" class="text-red-500">   {{ errorsStore.errors['slogan'][0] }} </span>
            </label>
  
            <div class="flex justify-end w-full">
                <button @click="save" class="btn btn-primary" :disabled="formLoading" > 
                    <span v-if="!formLoading"> حفظ </span>
                    <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
                </button>
            </div>



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

const form = ref({
    name: '',
    slogan: '',
    logo: null,
    newLogo: null,
    cover: null,
    newCover: null,
})
const loading = ref(false)
const formLoading = ref(false)
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/header').then(response => {
        form.value = response.data.data
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
        name: form.value.name,
        slogan: form.value.slogan,
        logo: form.value.logo ? form.value.logo : null,
        newCover: form.value.newCover ? form.value.newCover : null,
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