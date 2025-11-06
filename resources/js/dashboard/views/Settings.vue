<template>
    <div class="max-w-7xl mx-auto p-6">
         
        <!-- Handle URL Settings -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
            <h2 class="text-base-content font-semibold mb-2">رابط الموقع</h2>
            <p class="text-gray-400 font-light mb-6 text-sm">قم بتخصيص رابط موقعك الشخصي</p>
            
            <form @submit.prevent="updateHandle" class="space-y-4">
                <div class="flex items-end gap-4">
                    <div class="flex-1">
                        
                        <UiField name="handle" label="رابط الموقع" >
                            <label class="input w-full" dir="ltr">
                                <span class="label">https://{{ domain }}/</span>
                                <input v-model="form.handle" type="text" placeholder="URL"  />
                            </label>
                        </UiField>
                         
                        <p class="text-gray-500 text-xs mt-1">
                            رابط موقعك: <span class="font-mono text-blue-600">{{ previewUrl }}</span>
                        </p>
                    </div>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button 
                        type="submit" 
                        :disabled="isLoading || !form.handle"
                        class="btn btn-primary"
                    >
                        <span v-if="!isLoading">حفظ رابط الموقع</span>
                        <span v-if="isLoading" class="flex items-center gap-2">
                            <span class="loading loading-spinner loading-xs"></span>
                        </span>
                    </button>
                    
                </div>
            </form>
        </div>

        <!-- Contact Information Settings -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
            <h2 class="text-base-content font-semibold mb-2">معلومات الاتصال</h2>
            <p class="text-gray-400 font-light mb-6 text-sm">قم بتحديث معلومات الاتصال الخاصة بك</p>
                
            <form @submit.prevent="updateContact" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <UiField name="email" label="البريد الإلكتروني" >
                         
                        <input 
                            v-model="form.email" 
                             
                            :class="[
                                'input input-bordered w-full',
                                errorsStore.errors?.email ? 'border-red-500' : ''
                            ]"
                            placeholder="example@email.com"
                            :disabled="isLoadingContact"
                            dir="ltr"
                        />
                        
                    </UiField>
                    
                    <UiField name="phone" label="رقم الهاتف" >
                        <input 
                            v-model="form.phone" 
                            type="text" 
                            dir="ltr"
                            :class="[
                                'input input-bordered w-full',
                                errorsStore.errors?.phone ? 'border-red-500' : ''
                            ]"
                            placeholder="+966xxxxxxxxx"
                            :disabled="isLoadingContact"
                        />
                        
                    </UiField>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button 
                        type="submit" 
                        :disabled="isLoadingContact"
                        class="btn btn-primary"
                    >
                        <span v-if="!isLoadingContact">حفظ معلومات الاتصال</span>
                        <span v-if="isLoadingContact" class="flex items-center gap-2">
                            <span class="loading loading-spinner loading-xs"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Location Settings -->
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
            <h2 class="text-base-content font-semibold mb-2">الموقع الجغرافي</h2>
            <p class="text-gray-400 font-light mb-6 text-sm">قم بتحديد موقعك الجغرافي</p>
            
            <form @submit.prevent="updateLocation" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <UiField name="country" label="الدولة" >
                        <select 
                            v-model="form.country" 
                            :disabled="!countries"
                            class="select select-bordered w-full"
                        >
                            <option value="">اختر الدولة</option>
                            <option 
                                v-for="(name, code) in countries" 
                                :key="code" 
                                :value="code"
                            >
                                {{ name }}
                            </option>
                        </select>
                        
                    </UiField>
                    
                    <UiField name="city" label="المدينة" >
                        <input 
                            v-model="form.city" 
                            type="text" 
                            :class="[
                                'input input-bordered w-full',
                                errorsStore.errors?.city ? 'border-red-500' : ''
                            ]"
                            placeholder="اسم المدينة"
                        />
                        
                    </UiField>
                </div>
                
                <div class="flex justify-end gap-3">
                    <button 
                        type="submit" 
                        :disabled="isLoadingLocation"
                        class="btn btn-primary"
                    >
                        <span v-if="!isLoadingLocation">حفظ الموقع الجغرافي</span>
                        <span v-if="isLoadingLocation" class="flex items-center gap-2">
                            <span class="loading loading-spinner loading-xs"></span>
                        </span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Current Settings Info -->
        <div class="bg-gray-400/10 rounded-xl p-6">
            <h3 class="text-base-content font-semibold mb-4">معلومات الحساب الحالي</h3>
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
                <div v-if="tenant?.country">
                    <label class="block text-sm font-medium text-gray-700">الدولة</label>
                    <p class="text-gray-900">{{ getCountryName(tenant.country) }}</p>
                </div>
                <div v-if="tenant?.city">
                    <label class="block text-sm font-medium text-gray-700">المدينة</label>
                    <p class="text-gray-900">{{ tenant.city }}</p>
                </div>
                <div v-if="tenant?.email">
                    <label class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                    <p class="text-gray-900">{{ tenant.email }}</p>
                </div>
                <div v-if="tenant?.phone">
                    <label class="block text-sm font-medium text-gray-700">رقم الهاتف</label>
                    <p class="text-gray-900">{{ tenant.phone }}</p>
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
import { useErrorsStore } from '@/stores/errors'

const { tenant } = storeToRefs(useAuthStore())
const errorsStore = useErrorsStore()
 
useHead({
  title: 'الإعدادات',
  meta: [
    { name: 'description', content: 'إعدادات الحساب والموقع' },
  ],
})

const authStore = useAuthStore()
const isLoading = ref(false)
const isLoadingLocation = ref(false)
const isLoadingContact = ref(false)
const countries = ref(null)
const domain = 'broshur.com' // You can get this from config
 
const form = computed(() => {
    return {
        handle: tenant.value?.handle,
        country: tenant.value?.country || '',
        city: tenant.value?.city || '',
        email: tenant.value?.email || '',
        phone: tenant.value?.phone || '',
    }
})

// const originalHandle = ref('')

// Computed properties
const previewUrl = computed(() => {
    if (!form.value?.handle) return ''
    return `https://${domain}/${form.value?.handle}`
})

// Load countries list on mount
onMounted(async () => {
    try {
        const response = await axios.get('/api/countries')
        countries.value = response.data.data
    } catch (error) {
        console.error('Error loading countries:', error)
    }
})

const updateHandle = async () => {
    if (!form.value.handle) return
    
    isLoading.value = true
    errorsStore.setErrors([])
    try {
        const response = await axios.post('/api/tenant/handle', {
            handle: form.value.handle
        })
        
        // Update the tenant in the auth store
        // authStore.updateTenant({ handle: form.value.handle })
        
        // Update original handle
        // originalHandle.value = form.value.handle
        authStore.updateTenant(response.data.tenant)

        
        // Show success message
        console.log('Handle updated successfully:', response.data)
        
    } catch (error) {
        if (error.response?.data?.errors) {
            // errors.value = error.response.data.errors
            errorsStore.setErrors(error.response.data.errors);

        } else {
            console.error('Error updating handle:', error)
        }
    } finally {
        isLoading.value = false
    }
}

const resetForm = () => {
    // form.value.handle = originalHandle.value
    errorsStore.setErrors([])
}

const updateLocation = async () => {
    isLoadingLocation.value = true
    errorsStore.setErrors([])
    try {
        const response = await axios.post('/api/tenant/location', {
            country: form.value.country || null,
            city: form.value.city || null,
        })
        
        authStore.updateTenant(response.data.tenant)
        
        console.log('Location updated successfully:', response.data)
        
    } catch (error) {
        if (error.response?.data?.errors) {
            errorsStore.setErrors(error.response.data.errors);
        } else {
            console.error('Error updating location:', error)
        }
    } finally {
        isLoadingLocation.value = false
    }
}

const updateContact = async () => {
    isLoadingContact.value = true
    errorsStore.setErrors([])
    try {
        const response = await axios.post('/api/tenant/contact', {
            email: form.value.email || null,
            phone: form.value.phone || null,
        })
        
        authStore.updateTenant(response.data.tenant)
        
        console.log('Contact information updated successfully:', response.data)
        
    } catch (error) {
        if (error.response?.data?.errors) {
            errorsStore.setErrors(error.response.data.errors);
        } else {
            console.error('Error updating contact information:', error)
        }
    } finally {
        isLoadingContact.value = false
    }
}

const getCountryName = (code) => {
    if (!code || !countries.value) return code
    return countries.value[code] || code
}

const formatDate = (dateString) => {
    if (!dateString) return 'غير محدد'
    return new Date(dateString).toLocaleDateString('ar-SA')
}
</script>