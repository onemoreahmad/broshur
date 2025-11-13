<template>
    <div class="max-w-7xl mx-auto p-3 sm:p-4 md:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 mb-4 sm:mb-6">
            <h1 class="text-xl sm:text-2xl font-bold text-gray-800">التذكرة #{{ ticket?.id }}</h1>
            <div class="flex gap-2">
                <RouterLink :to="{ name: 'tickets' }" class="btn btn-outline btn-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    العودة للتذاكر
                </RouterLink>
            </div>
        </div>

        <div v-if="loading" class="flex justify-center items-center py-12">
            <span class="loading loading-spinner loading-lg"></span>
        </div>

        <div v-else-if="ticket" class="space-y-4 sm:space-y-6">
            <!-- Ticket Info Card -->
            <div class="bg-white rounded-xl border border-gray-200 p-4 sm:p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                    <div>
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-900 mb-2">{{ ticket.subject }}</h2>
                        <div class="flex flex-wrap items-center gap-2">
                            <span :class="[
                                'inline-flex px-2 py-1 text-xs font-medium rounded-full',
                                getStatusColor(ticket.status)
                            ]">
                                {{ getStatusLabel(ticket.status) }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ formatDate(ticket.created_at) }} - {{ formatTime(ticket.created_at) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="prose max-w-none">
                    <p class="text-gray-700 whitespace-pre-wrap">{{ ticket.message }}</p>
                </div>

                <!-- Attachments -->
                <div v-if="ticket.attachments && ticket.attachments.length > 0" class="mt-4 pt-4 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">المرفقات:</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                        <a 
                            v-for="(attachment, index) in ticket.attachments" 
                            :key="index"
                            :href="attachment.url" 
                            target="_blank"
                            class="relative group"
                        >
                            <img 
                                :src="attachment.url" 
                                :alt="attachment.name"
                                class="w-full h-24 object-cover rounded-lg border border-gray-200 hover:border-blue-500 transition"
                            />
                            <div class="absolute inset-0 bg-black/0 hover:bg-black/30 group-hover:bg-opacity-50 transition rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-white opacity-0 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Replies Section -->
            <div class="bg-white rounded-xl border border-gray-200 p-4 sm:p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">الردود ({{ ticket.replies?.length || 0 }})</h2>

                <div v-if="ticket.replies && ticket.replies.length > 0" class="space-y-4 mb-6">
                    <div 
                        v-for="reply in ticket.replies" 
                        :key="reply.id"
                        :class="[
                            'p-4 rounded-lg border',
                            reply.is_admin_reply ? 'bg-blue-50 border-blue-200' : 'bg-gray-50 border-gray-200'
                        ]"
                    >
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center">
                                    <span class="text-xs font-medium text-gray-700">
                                        {{ reply.user?.name?.charAt(0) || 'U' }}
                                    </span>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">
                                        {{ reply.user?.name || 'مستخدم' }}
                                        <span v-if="reply.is_admin_reply" class="text-xs text-blue-600 mr-1">(إدارة)</span>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ formatDate(reply.created_at) }} - {{ formatTime(reply.created_at) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-gray-700 whitespace-pre-wrap mb-3">{{ reply.message }}</p>
                        
                        <!-- Reply Attachments -->
                        <div v-if="reply.attachments && reply.attachments.length > 0" class="mt-3 pt-3 border-t border-gray-300">
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                                <a 
                                    v-for="(attachment, index) in reply.attachments" 
                                    :key="index"
                                    :href="attachment.url" 
                                    target="_blank"
                                    class="relative group"
                                >
                                    <img 
                                        :src="attachment.url" 
                                        :alt="attachment.name"
                                        class="w-full h-20 object-cover rounded-lg border border-gray-200 hover:border-blue-500 transition"
                                    />
                                    <div class="absolute inset-0 bg-black/0 hover:bg-black/30 group-hover:bg-opacity-50 transition rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white opacity-0 group-hover:opacity-100 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reply Form -->
                <div v-if="ticket.status !== 'closed'" class="border-t border-gray-200 pt-4 mt-4">
                    <h3 class="text-base font-semibold text-gray-900 mb-3">إضافة رد</h3>
                    <form @submit.prevent="submitReply" class="space-y-3">
                        <div>
                            <textarea 
                                v-model="replyForm.message"
                                class="textarea w-full"
                                rows="4"
                                placeholder="اكتب ردك هنا..."
                                required
                            ></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                المرفقات (اختياري)
                            </label>
                            <input 
                                type="file"
                                ref="replyFileInput"
                                @change="handleReplyFileSelect"
                                multiple
                                accept="image/*"
                                class="file-input file-input-bordered w-full"
                            />
                            <div v-if="replyForm.attachments.length > 0" class="mt-2 space-y-2">
                                <div v-for="(file, index) in replyForm.attachments" :key="index" class="flex items-center gap-2 text-sm">
                                    <span class="text-gray-600">{{ file.name }}</span>
                                    <button 
                                        type="button"
                                        @click="removeReplyAttachment(index)"
                                        class="text-red-600 hover:text-red-800"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <button 
                                type="submit" 
                                :disabled="isSubmittingReply"
                                class="btn btn-primary"
                            >
                                <span v-if="!isSubmittingReply">إرسال الرد</span>
                                <span v-if="isSubmittingReply" class="flex items-center gap-2">
                                    <span class="loading loading-spinner loading-xs"></span>
                                    جاري الإرسال...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <div v-else class="border-t border-gray-200 pt-4 mt-4">
                    <p class="text-sm text-gray-500 text-center py-4">هذه التذكرة مغلقة ولا يمكن إضافة ردود جديدة</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRoute, RouterLink } from 'vue-router'
import axios from 'axios'
import { useHead } from '@unhead/vue'

const route = useRoute()
const loading = ref(false)
const ticket = ref(null)
const isSubmittingReply = ref(false)
const replyFileInput = ref(null)

const replyForm = ref({
    message: '',
    attachments: []
})

useHead({
  title: 'تفاصيل التذكرة',
  meta: [
    { name: 'description', content: 'عرض تفاصيل تذكرة الدعم' },
  ],
})

const loadTicket = async () => {
    loading.value = true
    try {
        const response = await axios.get(`/api/tickets/${route.params.id}`)
        ticket.value = response.data.data
    } catch (error) {
        console.error('Failed to load ticket', error)
    } finally {
        loading.value = false
    }
}

const handleReplyFileSelect = (event) => {
    const files = Array.from(event.target.files)
    replyForm.value.attachments = [...replyForm.value.attachments, ...files]
}

const removeReplyAttachment = (index) => {
    replyForm.value.attachments.splice(index, 1)
    if (replyFileInput.value) {
        replyFileInput.value.value = ''
    }
}

const submitReply = async () => {
    isSubmittingReply.value = true
    try {
        const formData = new FormData()
        formData.append('message', replyForm.value.message)
        
        replyForm.value.attachments.forEach((file) => {
            formData.append('attachments[]', file)
        })
        
        const response = await axios.post(`/api/tickets/${route.params.id}/reply`, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
        
        // Reset form
        replyForm.value = {
            message: '',
            attachments: []
        }
        if (replyFileInput.value) {
            replyFileInput.value.value = ''
        }
        
        // Reload ticket to show new reply
        await loadTicket()
        
        console.log('Reply sent successfully:', response.data)
        
    } catch (error) {
        console.error('Error submitting reply:', error)
        alert('حدث خطأ أثناء إرسال الرد. يرجى المحاولة مرة أخرى.')
    } finally {
        isSubmittingReply.value = false
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
    loadTicket()
})
</script>

