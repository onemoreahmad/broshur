<template>
    <Container title="التذاكر والدعم">
        <template #actions>
            <div class="flex items-center gap-3 sm:gap-4  ">
                <div class="text-sm text-gray-500 ">
                    إجمالي التذاكر: {{ pagination.total }}
                </div>
                <button 
                    @click="showCreateTicketModal = true"
                    class="btn btn-primary   "
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="">فتح تذكرة جديدة</span>
                </button>
            </div>
        </template>

        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center items-center py-12">
            <span class="loading loading-spinner loading-lg"></span>
        </div>

        <!-- Tickets List - Desktop -->
        <div v-else-if="tickets.length > 0" class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="text-right">الموضوع</th>
                            <th class="text-right">الحالة</th>
                            <th class="text-right">عدد الردود</th>
                            <th class="text-right">تاريخ الإنشاء</th>
                            <th class="text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="ticket in tickets" :key="ticket.id" class="hover:bg-gray-50">
                            <td>
                                <router-link :to="`/tickets/${ticket.id}`" class="font-medium text-gray-900 hover:text-blue-600">
                                    {{ ticket.subject }}
                                </router-link>
                                <div class="text-sm text-gray-500 line-clamp-1 mt-1">
                                    {{ ticket.message }}
                                </div>
                            </td>
                            <td>
                                <span :class="[
                                    'inline-flex px-2 py-1 text-xs font-medium rounded-full',
                                    getStatusColor(ticket.status)
                                ]">
                                    {{ getStatusLabel(ticket.status) }}
                                </span>
                            </td>
                            <td>
                                <div class="text-sm text-gray-900">
                                    {{ ticket.replies?.length || 0 }}
                                </div>
                            </td>
                            <td>
                                <div class="text-sm text-gray-900">
                                    {{ formatDate(ticket.created_at) }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ formatTime(ticket.created_at) }}
                                </div>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <router-link 
                                        :to="`/tickets/${ticket.id}`"
                                        class="btn btn-sm btn-outline"
                                    >
                                        عرض
                                    </router-link>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden divide-y divide-gray-200">
                <div 
                    v-for="ticket in tickets" 
                    :key="ticket.id" 
                    class="p-4 hover:bg-gray-50 transition-colors"
                >
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <router-link :to="`/tickets/${ticket.id}`" class="block">
                                <h3 class="font-semibold text-gray-900 mb-1">
                                    {{ ticket.subject }}
                                </h3>
                            </router-link>
                            <p class="text-sm text-gray-600 line-clamp-2 mb-2">
                                {{ ticket.message }}
                            </p>
                            <div class="flex items-center gap-2 flex-wrap">
                                <span :class="[
                                    'inline-flex px-2 py-1 text-xs font-medium rounded-full',
                                    getStatusColor(ticket.status)
                                ]">
                                    {{ getStatusLabel(ticket.status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">عدد الردود:</span>
                            <span class="font-medium text-gray-900">
                                {{ ticket.replies?.length || 0 }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">التاريخ:</span>
                            <div class="text-left">
                                <div class="text-gray-900">{{ formatDate(ticket.created_at) }}</div>
                                <div class="text-xs text-gray-500">{{ formatTime(ticket.created_at) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 pt-2">
                        <router-link 
                            :to="`/tickets/${ticket.id}`"
                            class="btn btn-sm btn-outline flex-1"
                        >
                            عرض
                        </router-link>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div v-if="pagination.last_page > 1" class="flex flex-col sm:flex-row items-center justify-between gap-3 px-4 sm:px-6 py-4 border-t border-gray-200">
                <div class="text-xs sm:text-sm text-gray-700 text-center sm:text-right order-2 sm:order-1">
                    عرض {{ (pagination.current_page - 1) * pagination.per_page + 1 }} إلى 
                    {{ Math.min(pagination.current_page * pagination.per_page, pagination.total) }} 
                    من {{ pagination.total }} تذكرة
                </div>
                <div class="flex gap-2 w-full sm:w-auto order-1 sm:order-2">
                    <button 
                        @click="loadTickets(pagination.current_page - 1)"
                        :disabled="pagination.current_page <= 1"
                        class="btn btn-sm btn-outline flex-1 sm:flex-none"
                    >
                        السابق
                    </button>
                    <button 
                        @click="loadTickets(pagination.current_page + 1)"
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
            <div class="text-gray-400 text-5xl sm:text-6xl mb-3 sm:mb-4">
                <svg viewBox="0 0 24 24" class="size-16 mx-auto" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <circle cx="12" cy="12" r="10" stroke="#1C274C" stroke-width="1.5"></circle> <circle cx="12" cy="12" r="4" stroke="#1C274C" stroke-width="1.5"></circle> <path opacity="0.5" d="M15 9L19 5" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M5 19L9 15" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M9 9L5 5" stroke="#1C274C" stroke-width="1.5"></path> <path opacity="0.5" d="M19 19L15 15" stroke="#1C274C" stroke-width="1.5"></path> </g></svg>

            </div>
            <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">لا توجد تذاكر</h3>
            <p class="text-sm sm:text-base text-gray-500 mb-4">لم يتم إنشاء أي تذاكر دعم بعد</p>
            <button 
                @click="showCreateTicketModal = true"
                class="btn btn-primary"
            >
                فتح تذكرة جديدة
            </button>
        </div>

        <!-- Create Ticket Modal -->
        <div v-if="showCreateTicketModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-3 sm:p-4">
            <div class="bg-white rounded-xl p-4 sm:p-6 w-full max-w-2xl max-h-[95vh] sm:max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4 sm:mb-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">فتح تذكرة دعم جديدة</h2>
                    <button 
                        @click="closeCreateTicketModal"
                        class="text-gray-400 hover:text-gray-600 p-1 -mr-1"
                    >
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="createTicket" class="space-y-3 sm:space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            الموضوع <span class="text-red-500">*</span>
                        </label>
                        <input 
                            v-model="newTicket.subject"
                            type="text" 
                            class="input w-full"
                            placeholder="مثال: مشكلة في التصميم"
                            required
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            الرسالة <span class="text-red-500">*</span>
                        </label>
                        <textarea 
                            v-model="newTicket.message"
                            class="textarea w-full"
                            rows="5"
                            placeholder="اشرح مشكلتك بالتفصيل..."
                            required
                        ></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            المرفقات (اختياري)
                        </label>
                        <input 
                            type="file"
                            ref="fileInput"
                            @change="handleFileSelect"
                            multiple
                            accept="image/*"
                            class="file-input file-input-bordered w-full"
                        />
                        <div v-if="newTicket.attachments.length > 0" class="mt-2 space-y-2">
                            <div v-for="(file, index) in newTicket.attachments" :key="index" class="flex items-center gap-2 text-sm">
                                <span class="text-gray-600">{{ file.name }}</span>
                                <button 
                                    type="button"
                                    @click="removeAttachment(index)"
                                    class="text-red-600 hover:text-red-800"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 pt-3 sm:pt-4">
                        <button 
                            type="submit" 
                            :disabled="isCreatingTicket"
                            class="btn btn-primary p-3 flex-1 order-2 sm:order-1"
                        >
                            <span v-if="!isCreatingTicket">إرسال التذكرة</span>
                            <span v-if="isCreatingTicket" class="flex items-center justify-center gap-2">
                                <span class="loading loading-spinner loading-xs"></span>
                                جاري الإرسال...
                            </span>
                        </button>
                        <button 
                            type="button"
                            @click="closeCreateTicketModal"
                            class="btn btn-outline p-3 order-1 sm:order-2"
                        >
                            إلغاء
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

useHead({
  title: 'التذاكر والدعم',
  meta: [
    { name: 'description', content: 'إدارة تذاكر الدعم الفني' },
  ],
})

const tickets = ref([])
const loading = ref(false)
const showCreateTicketModal = ref(false)
const isCreatingTicket = ref(false)
const fileInput = ref(null)
const pagination = ref({
    current_page: 1,
    last_page: 1,
    per_page: 15,
    total: 0,
    has_more: false
})

const newTicket = ref({
    subject: '',
    message: '',
    priority: 1,
    attachments: []
})

const loadTickets = async (page = 1) => {
    loading.value = true
    try {
        const response = await axios.get(`/api/tickets?page=${page}`)
        tickets.value = response.data.data
        pagination.value = response.data.pagination
    } catch (error) {
        console.error('Error loading tickets:', error)
    } finally {
        loading.value = false
    }
}

const handleFileSelect = (event) => {
    const files = Array.from(event.target.files)
    newTicket.value.attachments = [...newTicket.value.attachments, ...files]
}

const removeAttachment = (index) => {
    newTicket.value.attachments.splice(index, 1)
    if (fileInput.value) {
        fileInput.value.value = ''
    }
}

const closeCreateTicketModal = () => {
    showCreateTicketModal.value = false
    resetNewTicketForm()
}

const resetNewTicketForm = () => {
    newTicket.value = {
        subject: '',
        message: '',
        priority: 1,
        attachments: []
    }
    if (fileInput.value) {
        fileInput.value.value = ''
    }
}

const createTicket = async () => {
    isCreatingTicket.value = true
    try {
        const formData = new FormData()
        formData.append('subject', newTicket.value.subject)
        formData.append('message', newTicket.value.message)
        formData.append('priority', newTicket.value.priority)
        
        newTicket.value.attachments.forEach((file) => {
            formData.append('attachments[]', file)
        })
        
        const response = await axios.post('/api/tickets', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        
        closeCreateTicketModal()
        await loadTickets(1)
        
        console.log('Ticket created successfully:', response.data)
        
    } catch (error) {
        console.error('Error creating ticket:', error)
        alert('حدث خطأ أثناء إنشاء التذكرة. يرجى المحاولة مرة أخرى.')
    } finally {
        isCreatingTicket.value = false
    }
}

const getStatusColor = (status) => {
    const colors = {
        'open': 'bg-green-100 text-green-800',
        'pending': 'bg-yellow-100 text-yellow-800',
        'closed': 'bg-gray-100 text-gray-800',
    }
    return colors[status] || 'bg-gray-100 text-gray-800'
}

const getStatusLabel = (status) => {
    const labels = {
        'open': 'مفتوحة',
        'pending': 'قيد الانتظار',
        'closed': 'مغلقة',
    }
    return labels[status] || status
}

const getPriorityColor = (priority) => {
    const colors = {
        1: 'bg-gray-100 text-gray-800',
        2: 'bg-yellow-100 text-yellow-800',
        3: 'bg-red-100 text-red-800',
    }
    return colors[priority] || 'bg-gray-100 text-gray-800'
}

const getPriorityLabel = (priority) => {
    const labels = {
        1: 'منخفض',
        2: 'متوسط',
        3: 'عالي',
    }
    return labels[priority] || 'منخفض'
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
    loadTickets()
})
</script>

