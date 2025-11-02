<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
        <div class="flex flex-col gap-6">
            <div class="flex items-center justify-between border-b-2 border-gray-200 pb-3 border-dotted">
                <h2 class="text-sm font-semibold text-gray-800 flex items-center gap-x-2">
                    <svg viewBox="0 0 24 24" fill="none" class="size-6" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21 16.0909V11.0975C21 6.80891 21 4.6646 19.682 3.3323C18.364 2 16.2426 2 12 2C7.75736 2 5.63604 2 4.31802 3.3323C3 4.6646 3 6.80891 3 11.0975V16.0909C3 19.1875 3 20.7358 3.73411 21.4123C4.08421 21.735 4.52615 21.9377 4.99692 21.9915C5.98402 22.1045 7.13673 21.0849 9.44216 19.0458C10.4612 18.1445 10.9708 17.6938 11.5603 17.5751C11.8506 17.5166 12.1494 17.5166 12.4397 17.5751C13.0292 17.6938 13.5388 18.1445 14.5578 19.0458C16.8633 21.0849 18.016 22.1045 19.0031 21.9915C19.4739 21.9377 19.9158 21.735 20.2659 21.4123C21 20.7358 21 19.1875 21 16.0909Z" stroke="#1C274D" stroke-width="1.5"></path> <path opacity="0.5" d="M15 6H9" stroke="#1C274D" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                    المعومات الأساسية 
                </h2>
            </div>
            <UiUploadAvatar v-model="form.newLogo" :preview="form.logo" name="newLogo" />
            
 
            <label class="input w-full focus-within:ring-offset-0 ">
                <span class="label">اسم البروشور</span>
                <input v-model="form.name" type="text" placeholder="الاسم" class="" />
                <span v-if="errorsStore.errors && errorsStore.errors['name']" class="text-red-500 text-xs">   {{ errorsStore.errors['name'][0] }} </span>
            </label>

            <label class="input w-full">
                <span class="label">الشعار النصي</span>
                <input v-model="form.slogan" type="text" placeholder="الشعار النصي" />
                <span v-if="errorsStore.errors && errorsStore.errors['slogan']" class="text-red-500 text-xs">   {{ errorsStore.errors['slogan'][0] }} </span>
            </label>
  
            <!-- <UiUploadImage 
                v-model="form.newCover"
                name="cover'"
                mediaCollection="cover"
                :preview="form.cover || ''"
                @update:removed="form.coverRemoved = true"
            />-->

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

import { useNotification } from "@kyvg/vue3-notification";

const { notify }  = useNotification()


const store = useAuthStore()
const errorsStore = useErrorsStore()

const form = ref({
    name: '',
    slogan: '',
    logo: null,
    newLogo: null,
    cover: null,
    newCover: null,
    coverRemoved: false,
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

const handleLogoUpload = (event) => {
    form.value.newLogo = event.target.files[0]
    const reader = new FileReader()
    reader.onload = (e) => {
        document.getElementById('preview_img').src = e.target.result
    }
    reader.readAsDataURL(form.value.newLogo)
}

const save = () => {
    formLoading.value = true;
 
    axios.post('/api/blocks/header', form.value, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    }).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);

        store.updateTenant({
            name: response.data.data.name,
            slogan: response.data.data.slogan,
            logo: response.data.data.logo,
            // cover: response.data.data.cover,
        })
 
        notify({ type: "success", text: "تم حفظ التعديلات بنجاح" });

        document.getElementById('preview-iframe').contentWindow.location.reload();
    })
    .catch(error => {
        formLoading.value = false;
        if (error.response) {
            console.error(error.response.data.errors)

            errorsStore.setErrors(error.response.data.errors);
            notify({ type: "error", text: "حدث خطأ ما، الرجاء تصحيح المعلومات و حاول مرة أخرى" });
        }
    })
}
</script>