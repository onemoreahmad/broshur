import { defineStore } from 'pinia'
import { ref, onMounted } from 'vue'

export const useErrorsStore = defineStore('useErrorsStore', () => {
    const errors = ref(null)
 
    const setErrors = (errorsData) => {
        errors.value = errorsData
    }
    
    return { errors, setErrors  }
  })