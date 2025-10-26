import { defineStore } from 'pinia'
import { ref, onMounted } from 'vue'
import axios from 'axios'

export const useAuthStore = defineStore('useAuthStore', () => {
    const user = ref(null)
    const tenant = ref(null)

    const setAuth = async () => {
        const response = await axios.get('/api/auth')
        user.value = response.data.user
        tenant.value = response.data.tenant
    }

    onMounted(() => {
        setAuth()
    })

    return { user, tenant  }
  })