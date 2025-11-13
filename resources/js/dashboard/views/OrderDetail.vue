<template>
    <div class="max-w-7xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800">تفاصيل الطلب #{{ order?.number || order?.id }}</h1>
            <div class="flex gap-2">
                <RouterLink :to="{ name: 'orders' }" class="btn btn-outline">العودة للطلبات</RouterLink>
            </div>
        </div>

        <div v-if="loading" class="flex justify-center items-center py-12">
            <span class="loading loading-spinner loading-lg"></span>
        </div>

        <div v-else-if="order" class="space-y-6">
            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl border border-gray-200 p-4">
                    <div class="text-sm text-gray-500 mb-1">الحالة</div>
                    <div class="text-lg font-semibold">
                        <span :class="['inline-flex px-2 py-1 text-xs font-medium rounded-full', statusColor]">
                            {{ statusLabel }}
                        </span>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4">
                    <div class="text-sm text-gray-500 mb-1">المبلغ الإجمالي</div>
                    <div class="text-lg font-semibold">{{ order.total || '0.00' }} ر.س</div>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-4">
                    <div class="text-sm text-gray-500 mb-1">تاريخ الإنشاء</div>
                    <div class="text-lg font-semibold">{{ formatDate(order.created_at) }} - {{ formatTime(order.created_at) }}</div>
                </div>
            </div>

            <!-- Client Info -->
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">بيانات العميل</h2>
                <div v-if="order.client" class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                    <div>
                        <div class="text-gray-500">الاسم</div>
                        <div class="font-medium">{{ order.client.name || '-' }}</div>
                    </div>
                    <div>
                        <div class="text-gray-500">الهاتف</div>
                        <div class="font-medium">{{ order.client.phone || '-' }}</div>
                    </div>
                    <div>
                        <div class="text-gray-500">البريد الإلكتروني</div>
                        <div class="font-medium">{{ order.client.email || '-' }}</div>
                    </div>
                </div>
                <div v-else class="text-gray-500 text-sm">
                    لا توجد بيانات عميل متاحة
                </div>
            </div>

            <!-- Items Table -->
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="text-right">العنصر</th>
                                <th class="text-right">الكمية</th>
                                <th class="text-right">السعر</th>
                                <th class="text-right">الإجمالي</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in order.items" :key="item.id">
                                <td class="font-medium text-gray-800">{{ item.data?.name || '-' }}</td>
                                <td>{{ item.quantity }}</td>
                                <td>{{ item.amount?.toFixed ? item.amount.toFixed(2) : item.amount }} ر.س</td>
                                <td>{{ item.total_pre_tax?.toFixed ? item.total_pre_tax.toFixed(2) : item.total_pre_tax }} ر.س</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Notes -->
            <div v-if="order.meta?.notes" class="bg-white rounded-xl border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">ملاحظات</h2>
                <p class="text-gray-700 whitespace-pre-wrap">{{ order.meta.notes }}</p>
            </div>
        </div>
    </div>
    
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, RouterLink } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const loading = ref(false)
const order = ref(null)

const loadOrder = async () => {
    loading.value = true
    try {
        const response = await axios.get(`/api/orders/${route.params.id}`)
        order.value = response.data.data
    } catch (e) {
        console.error('Failed to load order', e)
    } finally {
        loading.value = false
    }
}

const statusLabel = computed(() => {
    const s = order.value?.meta?.status
    const labels = {
        'pending': 'في الانتظار',
        'paid': 'مدفوع',
        'failed': 'فشل',
        'refunded': 'مسترد',
        'canceled': 'ملغي',
        'expired': 'منتهي الصلاحية',
        'processing': 'قيد المعالجة',
        'completed': 'مكتمل',
        'cancelled': 'ملغي'
    }
    return labels[s] || s || '-'
})

const statusColor = computed(() => {
    const s = order.value?.meta?.status
    const colors = {
        'pending': 'bg-yellow-100 text-yellow-800',
        'paid': 'bg-green-100 text-green-800',
        'failed': 'bg-red-100 text-red-800',
        'refunded': 'bg-red-100 text-red-800',
        'canceled': 'bg-red-100 text-red-800',
        'expired': 'bg-red-100 text-red-800',
        'processing': 'bg-blue-100 text-blue-800',
        'completed': 'bg-green-100 text-green-800',
        'cancelled': 'bg-red-100 text-red-800'
    }
    return colors[s] || 'bg-gray-100 text-gray-800'
})

const formatDate = (dateString) => {
    if (!dateString) return 'غير محدد'
    // return new Date(dateString).toLocaleDateString('ar-SA')
    return new Date(dateString).toLocaleDateString('en-US')
}

const formatTime = (dateString) => {
    if (!dateString) return ''
    // return new Date(dateString).toLocaleTimeString('ar-SA', { 
    return new Date(dateString).toLocaleTimeString('en-US', { 
        hour: '2-digit', 
        minute: '2-digit' 
    })
}

onMounted(() => {
    loadOrder()
})
</script>


