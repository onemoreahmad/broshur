<template>
    <Container title="الصفحات" subtitle="يمكنك إنشاء وإدارة صفحات متعددة تحت حسابك.">
        <template #actions>
            <button @click="openCreateModal" class="btn btn-primary btn-sm flex items-center gap-2">
                <svg viewBox="0 0 24 24" class="size-4" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 4V20" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> <path d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"></path> </g></svg>
                <span>إضافة صفحة</span>
            </button>
        </template>

        <div v-if="loading" class="flex justify-center items-center py-12">
            <span class="loading loading-spinner loading-lg"></span>
        </div>

        <div v-else>
            <div v-if="tenants.length" class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <div
                    v-for="tenant in tenants"
                    :key="tenant.id"
                    class="bg-white border border-gray-200 rounded-xl p-4 md:p-5 flex flex-col gap-4 shadow-sm"
                >
                    <div class="flex gap-4">
                        <img :src="tenant.logo" alt="" class="w-14 h-14 rounded-md object-cover border border-gray-100" />
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ tenant.name }}
                                </h3>
                                <span
                                    v-if="isCurrent(tenant)"
                                    class="text-xs bg-blue-100 text-blue-800 px-2 py-0.5 rounded-full"
                                >
                                    الحالية
                                </span>
                            </div>
                            <span class="text-sm text-gray-600" dir="ltr">
                                {{ tenant.handle }}
                            </span>
                            <!--<div class="text-xs text-gray-400 mt-1">
                                تم الإنشاء: {{ formatDate(tenant.created_at) }}
                            </div>-->
                            <div v-if="tenant.plan?.label" class="text-xs text-gray-500 mt-1">
                                الخطة: {{ tenant.plan.label }}
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <a
                            v-if="tenant.storefront_url"
                            :href="tenant.storefront_url"
                            target="_blank"
                            class="btn btn-sm btn-outline"
                        >
                        معاينة
                        <svg viewBox="0 0 24 24" class="size-4 rotate-30" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M15 6L9 12L15 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        </a>
                     
                        <button
                            v-if="!isCurrent(tenant)"
                            @click="switchTenant(tenant.id)"
                            class="btn btn-sm btn-primary"
                        >
                            إدارة الصفحة
                        </button>
                    </div>
                </div>
            </div>

            <div v-else class="text-center py-12">
                <div class="text-gray-400 mb-3">
                    <svg viewBox="0 0 24 24" class="size-16 mx-auto" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16.79 2H7.21C4.91 2 2 3.85 2 7.77V16.23C2 20.15 4.91 22 7.21 22H16.79C19.09 22 22 20.15 22 16.23V7.77C22 3.85 19.09 2 16.79 2ZM11.56 16.25H8.44C7.96 16.25 7.57 15.86 7.57 15.38C7.57 14.9 7.96 14.51 8.44 14.51H11.56C12.04 14.51 12.43 14.9 12.43 15.38C12.43 15.86 12.04 16.25 11.56 16.25ZM15.56 12.51H8.44C7.96 12.51 7.57 12.12 7.57 11.64C7.57 11.16 7.96 10.77 8.44 10.77H15.56C16.04 10.77 16.43 11.16 16.43 11.64C16.43 12.12 16.04 12.51 15.56 12.51ZM15.56 8.76H8.44C7.96 8.76 7.57 8.37 7.57 7.89C7.57 7.41 7.96 7.02 8.44 7.02H15.56C16.04 7.02 16.43 7.41 16.43 7.89C16.43 8.37 16.04 8.76 15.56 8.76Z" fill="#1C274C"></path> </g></svg>
                </div>
                <p class="text-sm text-gray-600 mb-4">لا توجد صفحات بعد</p>
                <button @click="openCreateModal" class="btn btn-primary">
                    إنشاء أول صفحة
                </button>
            </div>
        </div>

        <div v-if="showCreateModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-xl p-6 relative">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">إضافة صفحة جديدة</h3>
                        <p class="text-sm text-gray-500 mt-1">سيتم ربط الصفحة بحسابك الحالي.</p>
                    </div>
                    <button @click="closeCreateModal" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="createTenant" class="space-y-4">
                    <UiField name="tenant_name" label="اسم الصفحة">
                        <input
                            v-model="form.tenant_name"
                            type="text"
                            class="input w-full"
                            placeholder="اسم الصفحة"
                            required
                        />
                        
                    </UiField>

                    <UiField name="tenant_handle" label="المعرف الفرعي" hint="يستخدم في رابط الصفحة">
                        <label class="input w-full" dir="ltr">
                            <span class="label">https://broshur.com/</span>
                            <input v-model="form.tenant_handle" type="text" placeholder="URL"  />
                        </label>
                    </UiField>
                        
                    

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="closeCreateModal" class="btn btn-ghost">
                            إلغاء
                        </button>
                        <button type="submit" class="btn btn-primary" :disabled="formLoading">
                            <span v-if="!formLoading">إنشاء</span>
                            <span v-else class="flex items-center gap-2">
                                <span class="loading loading-spinner loading-xs"></span>
                                جاري الإنشاء...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Container>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useHead } from '@unhead/vue'
import axios from 'axios'
import { useNotification } from '@kyvg/vue3-notification'
import { useErrorsStore } from '../stores/errors'
import { storeToRefs } from 'pinia'

useHead({
    title: 'الصفحات',
})

const tenants = ref([])
const loading = ref(false)
const formLoading = ref(false)
const showCreateModal = ref(false)
const currentTenantId = ref(null)

const form = ref({
    tenant_name: '',
    tenant_handle: '',
})

const errorsStore = useErrorsStore()
const { errors } = storeToRefs(errorsStore)
const { notify } = useNotification()

const generateHandle = () => `tenant-${Math.random().toString(36).slice(2, 8)}`

const resetForm = () => {
    form.value = {
        tenant_name: '',
        tenant_handle: generateHandle(),
    }
    errorsStore.setErrors(null)
}

const fetchTenants = async () => {
    loading.value = true
    try {
        const { data } = await axios.get('/api/tenants')
        tenants.value = data.data || []
        currentTenantId.value = data.current_tenant_id
    } catch (error) {
        notify({ type: 'error', text: 'تعذر تحميل الصفحات حالياً' })
    } finally {
        loading.value = false
    }
}

const openCreateModal = () => {
    showCreateModal.value = true
}

const closeCreateModal = () => {
    showCreateModal.value = false
    resetForm()
}

const createTenant = async () => {
    formLoading.value = true
    errorsStore.setErrors(null)
    try {
        const { data } = await axios.post('/api/tenants', form.value)
        tenants.value = [data.tenant, ...tenants.value]
        closeCreateModal()
        notify({ type: 'success', text: 'تم إنشاء الصفحة بنجاح' })

        // بعد الإنشاء نعيد التوجيه للوحة الرئيسية لتحديث السياق
        window.location.href = '/dashboard/content'
    } catch (error) {
        if (error.response?.data?.errors) {
            errorsStore.setErrors(error.response.data.errors)
        }
        notify({ type: 'error', text: 'تعذر إنشاء الصفحة، حاول مرة أخرى' })
    } finally {
        formLoading.value = false
    }
}

const formatDate = (dateString) => {
    if (!dateString) {
        return ''
    }
    return new Date(dateString).toLocaleDateString('en-GB')
}

const isCurrent = (tenant) => currentTenantId.value === tenant.id

const switchTenant = async (tenantId) => {
    try {
        await axios.post(`/api/tenants/${tenantId}/switch`)
        currentTenantId.value = tenantId
        notify({ type: 'success', text: 'تم تعيين الصفحة الحالية' })
        window.location.href = '/dashboard'
    } catch (error) {
        notify({ type: 'error', text: 'تعذر تغيير الصفحة الحالية' })
    }
}

onMounted(() => {
    resetForm()
    fetchTenants()
})
</script>


