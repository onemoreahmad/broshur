<template>
    <Container title="الحساب">
        <fieldset class="fieldset mt-4">
            <legend class="fieldset-legend">الاسم </legend>
            <input v-model="form.name" type="text" class="input" placeholder="الاسم" />
        </fieldset>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">البريد الإلكتروني</legend>
            <input v-model="form.email" type="text" class="input" placeholder="your@email.com" dir="ltr" />
        </fieldset>
        <button @click="update" class="btn btn-primary">تحديث</button>
    </Container>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import { useAuthStore } from '../stores/auth'
import { storeToRefs } from 'pinia'
const store = useAuthStore()

const { user } = storeToRefs(useAuthStore())
 
const form = computed(() => {
    return {
        name: user.value?.name,
        email: user.value?.email,
    }
})
   
const update = () => {
    axios.post('/api/account', form.value).then(response => {
      
        console.log(response.data.message)
        store.updateUser(response.data.user)
    }).catch(error => {
        console.error(error)
    })
}
</script>