<template>
    <div>
        <h1>Account</h1>
 
        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">الاسم </legend>
            <input v-model="form.name" type="text" class="input" placeholder="الاسم" />
        </fieldset>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">البريد الإلكتروني</legend>
            <input v-model="form.email" type="text" class="input" placeholder="your@email.com" dir="ltr" />
        </fieldset>
        <button @click="update" class="btn btn-primary">تحديث</button>
    </div>
</template>

<script setup>
import { useAuthStore } from '../stores/auth'
import { ref, onMounted } from 'vue'
import axios from 'axios'

const store = useAuthStore()
let form = ref({
    name: '',
    email: '',
})
 
onMounted(() => {
    form.value.name = store.user?.name
    form.value.email = store.user?.email || ''
})
 
const update = async () => {
    const response = await axios.post('/api/account', form.value)
    store.user = response.data
}
</script>