<template>
    <Container title="الحساب" subtitle="قم بتخصيص بياناتك الشخصية">
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6 flex flex-col gap-1">
           
            <UiField name="image" label="الصورة الشخصية">
                <UiUploadAvatar v-model="form.newImage" :preview="user?.image" name="newImage" />
            </UiField>
            <UiField name="name" label="الاسم">
                <input v-model="form.name" type="text" class="input w-full" placeholder="الاسم" />
            </UiField>
            <UiField name="email" label="البريد الإلكتروني">
                <input v-model="form.email" type="text" class="input w-full" placeholder="your@email.com" dir="ltr" />
            </UiField>

            <div class="flex justify-end w-full mt-4">   
                <button @click="save" class="btn btn-primary" :disabled="formLoading" > 
                    <span v-if="!formLoading"> حفظ </span>
                    <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
                </button>
            </div>

        </div>
             
    </Container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useAuthStore } from '../stores/auth'
import { storeToRefs } from 'pinia'
import UiUploadAvatar from '../components/Ui/UploadAvatar.vue'
import { useErrorsStore } from '../stores/errors'
const store = useAuthStore()
const formLoading = ref(false)
const errorsStore = useErrorsStore()
const { user } = storeToRefs(useAuthStore())
 
const form = ref({
    name: '',
    email: '',
    newImage: null,
})

onMounted(() => {
    form.value.name = user.value?.name || ''
    form.value.email = user.value?.email || ''
})
   
const save = () => {
    formLoading.value = true
    errorsStore.setErrors([])
    const formData = new FormData()
    formData.append('name', form.value.name)
    formData.append('email', form.value.email)
    
    if (form.value.newImage) {
        formData.append('image', form.value.newImage)
    }
    
    axios.post('/api/account', formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    }).then(response => {
        formLoading.value = false
        store.updateUser(response.data.user)
        // Reset the image file input after successful upload
        form.value.newImage = null
    }).catch(error => {
        if (error.response?.data?.errors) {
            errorsStore.setErrors(error.response.data.errors);
        } else {
            console.error(error)
        }

        formLoading.value = false
        console.error(error)
    })
}
</script>