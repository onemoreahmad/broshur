<template>
    <div class="max-w-7xl mx-auto p-6">
         
        <!-- Handle URL Settings -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">رابط الموقع</h2>
            <p class="text-gray-600 mb-6">قم بتخصيص رابط موقعك الشخصي</p>
            
            <form @submit.prevent="updateHandle" class="space-y-4">
                <div class="flex items-end gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            اسم المستخدم
                        </label>
                        <div class="relative">
                            <label class="input" dir="ltr">
                                <span class="label">https://{{ domain }}/</span>
                                <input v-model="form.handle" type="text" placeholder="URL" :disabled="isLoading" />
                            </label>

                            <!---<input 
                                v-model="form.handle" 
                                type="text" 
                                :class="[
                                    'input w-full',
                                    errors.handle ? 'border-red-500' : 'border-gray-300'
                                ]"
                                placeholder="اسم المستخدم"
                                :disabled="isLoading"
                            />-->
                           
                        </div>
                        <p v-if="errors.handle" class="text-red-500 text-xs mt-1">
                            {{ errors.handle[0] }}
                        </p>
                        <p class="text-gray-500 text-xs mt-1">
                            سيصبح رابط موقعك: <span class="font-mono text-blue-600">{{ previewUrl }}</span>
                        </p>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <button 
                        type="submit" 
                        :disabled="isLoading || !form.handle"
                        class="btn btn-primary"
                    >
                        <span v-if="!isLoading">حفظ التغييرات</span>
                        <span v-if="isLoading" class="flex items-center gap-2">
                            <span class="loading loading-spinner loading-xs"></span>
                        </span>
                    </button>
                    
                </div>
            </form>
        </div>

        <!-- Current Settings Info -->
        <div class="bg-gray-50 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">معلومات الحساب الحالي</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">اسم الموقع</label>
                    <p class="text-gray-900 font-medium">{{ tenant?.name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">الرابط الحالي</label>
                    <a :href="tenant?.url" target="_blank" class="text-blue-600 hover:text-blue-800 font-mono text-sm">
                        {{ tenant?.handle }}
                    </a>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">تاريخ الإنشاء</label>
                    <p class="text-gray-900">{{  tenant?.created_at  }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">الحالة</label>
                    <span :class="[
                        'inline-flex px-2 py-1 text-xs font-medium rounded-full',
                        tenant?.active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                    ]">
                        {{ tenant?.active ? 'نشط' : 'غير نشط' }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useHead } from '@unhead/vue'
import axios from 'axios'
import { useAuthStore } from '@/stores/auth'
import { storeToRefs } from 'pinia'

const { tenant } = storeToRefs(useAuthStore())
 
useHead({
  title: 'الإعدادات',
  meta: [
    { name: 'description', content: 'إعدادات الحساب والموقع' },
  ],
})

const authStore = useAuthStore()
const isLoading = ref(false)
const errors = ref({})
const domain = 'broshur.com' // You can get this from config
 
const form = computed(() => {
    return {
        handle: tenant.value?.handle,
    }
})
 
// Computed properties
const previewUrl = computed(() => {
    if (!form.value?.handle) return ''
    return `https://${domain}/${form.value?.handle}`
})
 

const updateHandle = async () => {
    if (!form.value.handle) return
    
    isLoading.value = true
    errors.value = {}
    
    try {
        const response = await axios.post('/api/tenant/handle', {
            handle: form.value.handle
        })
         
        // Update original handle
        originalHandle.value = form.value.handle
        authStore.updateTenant(response.data.tenant)
 
        // Show success message
        console.log('Handle updated successfully:', response.data)
        
    } catch (error) {
        if (error.response?.data?.errors) {
            errors.value = error.response.data.errors
        } else {
            console.error('Error updating handle:', error)
        }
    } finally {
        isLoading.value = false
    }
}

const resetForm = () => {
    form.value.handle = originalHandle.value
    errors.value = {}
}

const formatDate = (dateString) => {
    if (!dateString) return 'غير محدد'
    return new Date(dateString).toLocaleDateString('ar-SA')
}
</script>