<template>
    <div class="max-w-7xl mx-auto p-3 sm:p-4 md:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 mb-4 sm:mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">المشتركين</h1>
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 w-full sm:w-auto">
                <div class="text-sm text-gray-500 order-2 sm:order-1">
                    إجمالي المشتركين: {{ pagination.total }}
                </div>
                <button 
                    @click="showAddSubscriberModal = true"
                    class="btn btn-primary w-full sm:w-auto order-1 sm:order-2"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="hidden sm:inline">إضافة مشترك جديد</span>
                    <span class="sm:hidden">إضافة</span>
                </button>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center items-center py-12">
            <span class="loading loading-spinner loading-lg"></span>
        </div>

        <!-- Subscribers Table - Desktop -->
        <div v-else-if="subscribers.length > 0" class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="text-right">الاسم</th>
                            <th class="text-right">البريد الإلكتروني</th>
                            <th class="text-right">تاريخ التسجيل</th>
                            <th class="text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="subscriber in subscribers" :key="subscriber.id" class="hover:bg-gray-50">
                            <td>
                                <div class="font-medium text-gray-900">
                                    {{ subscriber.name }}
                                </div>
                            </td>
                            <td>
                                <div class="font-medium text-gray-900" dir="ltr">
                                    {{ subscriber.email }}
                                </div>
                            </td>
                            <td>
                                <div class="text-sm text-gray-900">
                                    {{ formatDate(subscriber.created_at) }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ formatTime(subscriber.created_at) }}
                                </div>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <button 
                                        @click="viewSubscriber(subscriber)"
                                        class="btn btn-sm btn-outline"
                                    >
                                        عرض
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden divide-y divide-gray-200">
                <div 
                    v-for="subscriber in subscribers" 
                    :key="subscriber.id" 
                    class="p-4 hover:bg-gray-50 transition-colors"
                >
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 mb-1">
                                {{ subscriber.name }}
                            </h3>
                            <p class="text-sm text-gray-600" dir="ltr">{{ subscriber.email }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">البريد الإلكتروني:</span>
                            <span class="font-medium text-gray-900" dir="ltr">
                                {{ subscriber.email }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">تاريخ التسجيل:</span>
                            <div class="text-left">
                                <div class="text-gray-900">{{ formatDate(subscriber.created_at) }}</div>
                                <div class="text-xs text-gray-500">{{ formatTime(subscriber.created_at) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 pt-2">
                        <button 
                            @click="viewSubscriber(subscriber)"
                            class="btn btn-sm btn-outline flex-1"
                        >
                            عرض
                        </button>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="pagination.last_page > 1" class="flex flex-col sm:flex-row items-center justify-between gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
                <div class="text-xs sm:text-sm text-gray-700 text-center sm:text-right order-2 sm:order-1">
                    عرض {{ (pagination.current_page - 1) * pagination.per_page + 1 }} إلى 
                    {{ Math.min(pagination.current_page * pagination.per_page, pagination.total) }} 
                    من {{ pagination.total }} مشترك
                </div>
                <div class="flex gap-2 w-full sm:w-auto order-1 sm:order-2">
                    <button 
                        @click="loadSubscribers(pagination.current_page - 1)"
                        :disabled="pagination.current_page <= 1"
                        class="btn btn-sm btn-outline flex-1 sm:flex-none"
                    >
                        السابق
                    </button>
                    <button 
                        @click="loadSubscribers(pagination.current_page + 1)"
                        :disabled="!pagination.has_more"
                        class="btn btn-sm btn-outline flex-1 sm:flex-none"
                    >
                        التالي
                    </button>
                </div>
            </div>
        </div>

        <!-- Empty State -->
        <div v-else class="text-center py-8 sm:py-12">
            <div class="text-gray-400 text-5xl sm:text-6xl mb-3 sm:mb-4">👥</div>
            <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">لا يوجد مشتركين</h3>
            <p class="text-sm sm:text-base text-gray-500">لم يتم إضافة أي مشتركين بعد</p>
        </div>

        <!-- Add Subscriber Modal -->
        <div v-if="showAddSubscriberModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-3 sm:p-4">
            <div class="bg-white rounded-xl p-4 sm:p-6 w-full max-w-2xl max-h-[95vh] sm:max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4 sm:mb-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">إضافة مشترك جديد</h2>
                    <button 
                        @click="closeAddSubscriberModal"
                        class="text-gray-400 hover:text-gray-600 p-1 -mr-1"
                    >
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="createSubscriber" class="space-y-3 sm:space-y-4">
                    <!-- Subscriber Information -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            الاسم
                        </label>
                        <input 
                            v-model="newSubscriber.name"
                            type="text" 
                            class="input w-full"
                            placeholder="اسم المشترك"
                            required
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            البريد الإلكتروني
                        </label>
                        <input 
                            v-model="newSubscriber.email"
                            type="email" 
                            dir="ltr"
                            class="input w-full"
                            placeholder="subscriber@email.com"
                            required
                        />
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 pt-3 sm:pt-4">
                        <button 
                            type="submit" 
                            :disabled="isCreatingSubscriber"
                            class="btn btn-primary p-3 flex-1 order-2 sm:order-1"
                        >
                            <span v-if="!isCreatingSubscriber">إضافة المشترك</span>
                            <span v-if="isCreatingSubscriber" class="flex items-center justify-center gap-2">
                                <span class="loading loading-spinner loading-xs"></span>
                                جاري الإضافة...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Subscriber Detail Modal -->
        <div v-if="showDetailModal && selectedSubscriber" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-3 sm:p-4">
            <div class="bg-white rounded-xl p-4 sm:p-6 w-full max-w-2xl max-h-[95vh] sm:max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4 sm:mb-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">تفاصيل المشترك</h2>
                    <button 
                        @click="closeDetailModal"
                        :disabled="isDeletingSubscriber"
                        class="text-gray-400 hover:text-gray-600 p-1 -mr-1"
                    >
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="space-y-4">
                    <!-- Subscriber Info -->
                    <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-12 h-12 rounded-full bg-purple-100 text-purple-600 text-lg font-semibold">
                                {{ selectedSubscriber.name.charAt(0).toUpperCase() }}
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ selectedSubscriber.name }}</h3>
                                <p class="text-sm text-gray-500" dir="ltr">{{ selectedSubscriber.email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Details Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <div class="text-xs text-gray-500 mb-1">الاسم الكامل</div>
                            <div class="text-sm font-medium text-gray-900">{{ selectedSubscriber.name }}</div>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <div class="text-xs text-gray-500 mb-1">البريد الإلكتروني</div>
                            <div class="text-sm font-medium text-gray-900" dir="ltr">{{ selectedSubscriber.email }}</div>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <div class="text-xs text-gray-500 mb-1">تاريخ التسجيل</div>
                            <div class="text-sm font-medium text-gray-900">{{ formatDate(selectedSubscriber.created_at) }}</div>
                            <div class="text-xs text-gray-500 mt-1">{{ formatTime(selectedSubscriber.created_at) }}</div>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <div class="text-xs text-gray-500 mb-1">معرف المشترك</div>
                            <div class="text-sm font-medium text-gray-900">#{{ selectedSubscriber.id }}</div>
                        </div>
                    </div>

                    <!-- Meta Information -->
                    <div v-if="selectedSubscriber.meta && Object.keys(selectedSubscriber.meta).length > 0" class="bg-white border border-gray-200 rounded-lg p-4">
                        <div class="text-xs text-gray-500 mb-2">معلومات إضافية</div>
                        <pre class="text-xs text-gray-700 whitespace-pre-wrap">{{ JSON.stringify(selectedSubscriber.meta, null, 2) }}</pre>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 mt-6 pt-4 border-t border-gray-200">
                    <button 
                        @click="deleteSubscriber"
                        :disabled="isDeletingSubscriber"
                        class="btn btn-outline text-red-600 hover:bg-red-50 hover:border-red-300 flex-1 order-2 sm:order-1"
                    >
                        <span v-if="!isDeletingSubscriber" class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            حذف المشترك
                        </span>
                        <span v-if="isDeletingSubscriber" class="flex items-center justify-center gap-2">
                            <span class="loading loading-spinner loading-xs"></span>
                            جاري الحذف...
                        </span>
                    </button>
                    <button 
                        @click="closeDetailModal"
                        :disabled="isDeletingSubscriber"
                        class="btn btn-primary flex-1 order-1 sm:order-2"
                    >
                        إغلاق
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useHead } from '@unhead/vue'
import { useRouter } from 'vue-router'
import axios from 'axios'

useHead({
  title: 'إدارة المشتركين',
  meta: [
    { name: 'description', content: 'عرض وإدارة المشتركين' },
  ],
})

const router = useRouter()

const subscribers = ref([])
const loading = ref(false)
const showAddSubscriberModal = ref(false)
const showDetailModal = ref(false)
const selectedSubscriber = ref(null)
const isCreatingSubscriber = ref(false)
const isDeletingSubscriber = ref(false)
const pagination = ref({
    current_page: 1,
    last_page: 1,
    per_page: 15,
    total: 0,
    has_more: false
})

const newSubscriber = ref({
    name: '',
    email: ''
})

const loadSubscribers = async (page = 1) => {
    loading.value = true
    try {
        const response = await axios.get(`/api/subscribers?page=${page}`)
        subscribers.value = response.data.data
        pagination.value = response.data.pagination
    } catch (error) {
        console.error('Error loading subscribers:', error)
    } finally {
        loading.value = false
    }
}

const viewSubscriber = (subscriber) => {
    selectedSubscriber.value = subscriber
    showDetailModal.value = true
}

const closeDetailModal = () => {
    showDetailModal.value = false
    selectedSubscriber.value = null
}

const deleteSubscriber = async () => {
    if (!selectedSubscriber.value) return
    
    if (!confirm('هل أنت متأكد من حذف هذا المشترك؟ لا يمكن التراجع عن هذا الإجراء.')) {
        return
    }
    
    isDeletingSubscriber.value = true
    try {
        await axios.delete(`/api/subscribers/${selectedSubscriber.value.id}`)
        
        // Close modal and reload subscribers
        closeDetailModal()
        await loadSubscribers(pagination.value.current_page)
        
        console.log('Subscriber deleted successfully')
        
    } catch (error) {
        console.error('Error deleting subscriber:', error)
        alert(error.response?.data?.message || 'حدث خطأ أثناء حذف المشترك')
    } finally {
        isDeletingSubscriber.value = false
    }
}

const closeAddSubscriberModal = () => {
    showAddSubscriberModal.value = false
    resetNewSubscriberForm()
}

const resetNewSubscriberForm = () => {
    newSubscriber.value = {
        name: '',
        email: ''
    }
}

const createSubscriber = async () => {
    isCreatingSubscriber.value = true
    try {
        const response = await axios.post('/api/subscribers', {
            name: newSubscriber.value.name,
            email: newSubscriber.value.email
        })
        
        // Close modal and reload subscribers
        closeAddSubscriberModal()
        await loadSubscribers(1) // Reload first page to show new subscriber
        
        console.log('Subscriber created successfully:', response.data)
        
    } catch (error) {
        console.error('Error creating subscriber:', error)
        if (error.response?.data?.errors) {
            alert(error.response.data.message || 'حدث خطأ أثناء إضافة المشترك')
        }
    } finally {
        isCreatingSubscriber.value = false
    }
}

const formatDate = (dateString) => {
    if (!dateString) return 'غير محدد'
    return new Date(dateString).toLocaleDateString('en-US')
}

const formatTime = (dateString) => {
    if (!dateString) return ''
    return new Date(dateString).toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit' 
    })
}

onMounted(() => {
    loadSubscribers()
})
</script>

