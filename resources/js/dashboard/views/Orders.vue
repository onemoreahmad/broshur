<template>
    <div class="max-w-7xl mx-auto p-3 sm:p-4 md:p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 mb-4 sm:mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">الطلبات</h1>
            <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-4 w-full sm:w-auto">
                <div class="text-sm text-gray-500 order-2 sm:order-1">
                    إجمالي الطلبات: {{ pagination.total }}
                </div>
                <button 
                    @click="showAddOrderModal = true"
                    class="btn btn-primary w-full sm:w-auto order-1 sm:order-2"
                >
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="hidden sm:inline">إضافة طلب جديد</span>
                    <span class="sm:hidden">إضافة</span>
                </button>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center items-center py-12">
            <span class="loading loading-spinner loading-lg"></span>
        </div>

        <!-- Orders Table - Desktop -->
        <div v-else-if="orders.length > 0" class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="text-right">رقم الطلب</th>
                            <th class="text-right">العميل</th>
                            <th class="text-right">المبلغ</th>
                            <th class="text-right">الحالة</th>
                            <th class="text-right">تاريخ الطلب</th>
                            <th class="text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="order in orders" :key="order.id" class="hover:bg-gray-50">
                            <td>
                                <router-link :to="`/orders/${order.id}`"     class="font-medium text-gray-900">
                                    #{{ order.number }}
                                </router-link>
                                <div class="text-sm text-gray-500">
                                    {{ order.hashed_number }}
                                </div>
                            </td>
                            <td>
                                <div v-if="order.meta?.client_name" class="font-medium text-gray-900">
                                    {{ order.meta?.client_name }} <br>
                                    <div class="text-xs text-gray-500">
                                        {{ order.meta?.client_phone }} <br>
                                        {{ order.meta?.client_email }}
                                    </div>
                                </div>
                                <div v-else class="text-gray-500 text-sm">
                                    عميل غير محدد
                                </div>
                            </td>
                            <td>
                                <div class="font-medium text-gray-900">
                                    ${{ order.total  || '0.00' }}
                                </div>
                                <div v-if="order.items && order.items.length > 0" class="text-sm text-gray-500">
                                    {{ order.items.length }} عنصر
                                </div>
                            </td>
                            <td>
                                <span :class="[
                                    'inline-flex px-2 py-1 text-xs font-medium rounded-full',
                                    getStatusColor(order.meta?.status)
                                ]">
                                    {{ getStatusLabel(order.meta?.status) }}
                                </span>
                            </td>
                            <td>
                                <div class="text-sm text-gray-900">
                                    {{ formatDate(order.created_at) }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ formatTime(order.created_at) }}
                                </div>
                            </td>
                            <td>
                                <div class="flex gap-2">
                                    <button 
                                        @click="viewOrder(order)"
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
                    v-for="order in orders" 
                    :key="order.id" 
                    class="p-4 hover:bg-gray-50 transition-colors"
                >
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <h3 class="font-semibold text-gray-900">
                                    #{{ order.number }}
                                </h3>
                                <span :class="[
                                    'inline-flex px-2 py-1 text-xs font-medium rounded-full',
                                    getStatusColor(order.meta?.status)
                                ]">
                                    {{ getStatusLabel(order.meta?.status) }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-500">{{ order.hashed_number }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">الحالة:</span>
                            <span :class="[
                                'inline-flex px-2 py-1 text-xs font-medium rounded-full',
                                getStatusColor(order.meta?.status)
                            ]">
                                {{ getStatusLabel(order.meta?.status) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">العميل:</span>
                            <span class="font-medium text-gray-900">
                                {{ order.client?.name || 'عميل غير محدد' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">المبلغ:</span>
                            <span class="font-semibold text-gray-900">
                                ${{ order.total || '0.00' }}
                            </span>
                        </div>
                        <div v-if="order.items && order.items.length > 0" class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">العناصر:</span>
                            <span class="text-gray-700">{{ order.items.length }} عنصر</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500">التاريخ:</span>
                            <div class="text-left">
                                <div class="text-gray-900">{{ formatDate(order.created_at) }}</div>
                                <div class="text-xs text-gray-500">{{ formatTime(order.created_at) }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 pt-2">
                        <button 
                            @click="viewOrder(order)"
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
                    من {{ pagination.total }} طلب
                </div>
                <div class="flex gap-2 w-full sm:w-auto order-1 sm:order-2">
                    <button 
                        @click="loadOrders(pagination.current_page - 1)"
                        :disabled="pagination.current_page <= 1"
                        class="btn btn-sm btn-outline flex-1 sm:flex-none"
                    >
                        السابق
                    </button>
                    <button 
                        @click="loadOrders(pagination.current_page + 1)"
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
            <div class="text-gray-400 text-5xl sm:text-6xl mb-3 sm:mb-4">📦</div>
            <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">لا توجد طلبات</h3>
            <p class="text-sm sm:text-base text-gray-500">لم يتم إنشاء أي طلبات بعد</p>
        </div>

        <!-- Add Order Modal -->
        <div v-if="showAddOrderModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-3 sm:p-4">
            <div class="bg-white rounded-xl p-4 sm:p-6 w-full max-w-2xl max-h-[95vh] sm:max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between mb-4 sm:mb-6">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-800">إضافة طلب جديد</h2>
                    <button 
                        @click="closeAddOrderModal"
                        class="text-gray-400 hover:text-gray-600 p-1 -mr-1"
                    >
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <form @submit.prevent="createOrder" class="space-y-3 sm:space-y-4">
                    <!-- Client Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                اسم العميل
                            </label>
                            <input 
                                v-model="newOrder.client_name"
                                type="text" 
                                class="input w-full"
                                placeholder="اسم العميل"
                                required
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                رقم الهاتف
                            </label>
                            <input 
                                v-model="newOrder.client_phone"
                                type="tel" 
                                class="input w-full"
                                placeholder="9665412345678"
                            />
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            البريد الإلكتروني
                        </label>
                        <input 
                            v-model="newOrder.client_email"
                            type="email" 
                            dir="ltr"
                            class="input w-full"
                            placeholder="client@email.com"
                        />
                    </div>

                    <!-- Order Items -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-4 border-b border-gray-200 pb-2 border-dashed">
                            عناصر الطلب
                        </label>
                        <div class="space-y-3 w-full">
                            <div v-for="(item, index) in newOrder.items" :key="index" class="flex flex-col sm:flex-row gap-2 sm:gap-3">
                                <div class="  flex-grow w-full">
                                    <label class="block text-sm font-medium text-gray-700 mb-2 hidden sm:block"> 
                                        اسم الخدمة أو المنتج
                                        </label>
                                    <input 
                                        v-model="item.name"
                                        type="text" 
                                        class="input w-full text-sm sm:text-base w-full"
                                        placeholder="اسم الخدمة أو المنتج، مثال: تصميم شعار"
                                        required
                                    />
                                </div>
                                <div class="flex gap-2 sm:gap-3 items-center w-full">
                                    <div class="">
                                        <label class="block text-sm font-medium text-gray-700 mb-2"> 
                                            الكمية
                                        </label>
                                        <input 
                                            v-model.number="item.quantity"
                                            type="number" 
                                            class="input w-full text-sm sm:text-base"
                                            placeholder="1"
                                            min="1"
                                            required
                                        />
                                    </div>
                                    <div class="flex-grow">
                                        <label class="block text-sm font-medium text-gray-700 mb-2"> 
                                            السعر
                                        </label>
                                        <input 
                                            v-model.number="item.price"
                                            type="number" 
                                            step="0.01"
                                            class="input w-full text-sm sm:text-base"
                                            placeholder="0.00"
                                            min="0"
                                            required
                                        />
                                    </div>
                                    <div class="flex-1 sm:w-32" v-if="index > 0">
                                        <label class="block text-sm font-medium text-gray-700 mb-2"> 
                                             <br />
                                        </label>
                                      
                                    <button 
                                        type="button"
                                        @click="removeOrderItem(index)"
                                        class="btn btn-md btn-outline text-red-600 hover:bg-red-50 px-3 sm:px-4"
                                    >
                                        <span class="hidden sm:inline">حذف</span>
                                        <svg class="w-4 h-4 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button 
                            type="button"
                            @click="addOrderItem"
                            class="btn btn-sm btn-outline mt-3 w-full sm:w-auto"
                        >
                            إضافة عنصر
                        </button>
                    </div>

                    <!-- Order Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                المبلغ الإجمالي
                            </label>
                            <input 
                                v-model.number="newOrder.total"
                                type="number" 
                                step="0.01"
                                class="input w-full"
                                placeholder="0.00"
                                readonly
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                حالة الطلب
                            </label>
                            <select v-model="newOrder.status" class="select w-full">
                                <option value="pending">في الانتظار</option>
                                <option value="processing">قيد المعالجة</option>
                                <option value="completed">مكتمل</option>
                                <option value="cancelled">ملغي</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            ملاحظات
                        </label>
                        <textarea 
                            v-model="newOrder.notes"
                            class="textarea w-full"
                            rows="3"
                            placeholder="ملاحظات إضافية..."
                        ></textarea>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex flex-col sm:flex-row gap-2 sm:gap-3 pt-3 sm:pt-4">
                        <button 
                            type="submit" 
                            :disabled="isCreatingOrder"
                            class="btn btn-primary p-3 flex-1 order-2 sm:order-1"
                        >
                            <span v-if="!isCreatingOrder">إنشاء الطلب</span>
                            <span v-if="isCreatingOrder" class="flex items-center justify-center gap-2">
                                <span class="loading loading-spinner loading-xs"></span>
                                جاري الإنشاء...
                            </span>
                        </button>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { useHead } from '@unhead/vue'
import axios from 'axios'

useHead({
  title: 'إدارة الطلبات',
  meta: [
    { name: 'description', content: 'عرض وإدارة طلبات العملاء' },
  ],
})

const orders = ref([])
const loading = ref(false)
const showAddOrderModal = ref(false)
const isCreatingOrder = ref(false)
const pagination = ref({
    current_page: 1,
    last_page: 1,
    per_page: 15,
    total: 0,
    has_more: false
})

const newOrder = ref({
    client_name: '',
    client_phone: '',
    client_email: '',
    items: [
        { name: '', quantity: 1, price: 0 }
    ],
    total: 0,
    status: 'pending',
    notes: ''
})

const loadOrders = async (page = 1) => {
    loading.value = true
    try {
        const response = await axios.get(`/api/orders?page=${page}`)
        orders.value = response.data.data
        pagination.value = response.data.pagination
    } catch (error) {
        console.error('Error loading orders:', error)
    } finally {
        loading.value = false
    }
}

import { useRouter } from 'vue-router'
const router = useRouter()

const viewOrder = (order) => {
    router.push({ name: 'orders.detail', params: { id: order.id } })
}

const updateOrderStatus = async (order, status) => {
    try {
        // API call to update order status
        console.log('Update order status:', order.id, status)
        // Reload orders after update
        await loadOrders(pagination.value.current_page)
    } catch (error) {
        console.error('Error updating order status:', error)
    }
}

const addOrderItem = () => {
    newOrder.value.items.push({ name: '', quantity: 1, price: 0 })
}

const removeOrderItem = (index) => {
    if (newOrder.value.items.length > 1) {
        newOrder.value.items.splice(index, 1)
    }
}

const calculateTotal = () => {
    newOrder.value.total = newOrder.value.items.reduce((total, item) => {
        return total + (item.quantity * item.price)
    }, 0)
}

const closeAddOrderModal = () => {
    showAddOrderModal.value = false
    resetNewOrderForm()
}

const resetNewOrderForm = () => {
    newOrder.value = {
        client_name: '',
        client_phone: '',
        client_email: '',
        items: [
            { name: '', quantity: 1, price: 0 }
        ],
        total: 0,
        status: 'pending',
        notes: ''
    }
}

const createOrder = async () => {
    isCreatingOrder.value = true
    try {
        calculateTotal()
        
        const response = await axios.post('/api/orders', {
            client_name: newOrder.value.client_name,
            client_phone: newOrder.value.client_phone,
            client_email: newOrder.value.client_email,
            items: newOrder.value.items,
            total: newOrder.value.total,
            status: newOrder.value.status,
            notes: newOrder.value.notes
        })
        
        // Close modal and reload orders
        closeAddOrderModal()
        await loadOrders(1) // Reload first page to show new order
        
        console.log('Order created successfully:', response.data)
        
    } catch (error) {
        console.error('Error creating order:', error)
    } finally {
        isCreatingOrder.value = false
    }
}

const getStatusColor = (status) => {
    const colors = {
        'pending': 'bg-yellow-100 text-yellow-800',
        'paid': 'bg-green-100 text-green-800',
        'failed': 'bg-red-100 text-red-800',
        'refunded': 'bg-red-100 text-red-800',
        'canceled': 'bg-red-100 text-red-800',
        'expired': 'bg-red-100 text-red-800',
        'processing': 'bg-blue-100 text-blue-800',
        'completed': 'bg-green-100 text-green-800',
        'progress': 'bg-yellow-100 text-yellow-800',
        'waiting': 'bg-purple-100 text-purple-800',
        'awaiting_payment': 'bg-pink-100 text-pink-800',
        'awaiting_fulfillment': 'bg-orange-100 text-orange-800',
        'awaiting_shipment': 'bg-orange-100 text-orange-800',
        'shipped': 'bg-green-100 text-green-800',
        'partially_shipped': 'bg-yellow-100 text-yellow-800',
        'awaiting_pickup': 'bg-purple-100 text-purple-800',
        'cancelled': 'bg-red-100 text-red-800'
    }
    return colors[status] || 'bg-gray-100 text-gray-800'
}

const getStatusLabel = (status) => {
    const labels = {
        'pending': 'في الانتظار',
        'paid': 'مدفوع',
        'failed': 'فشل',
        'refunded': 'مسترد',
        'canceled': 'ملغي',
        'expired': 'منتهي الصلاحية',
        'processing': 'قيد المعالجة',
        'completed': 'مكتمل',
        'progress': 'قيد التقدم',
        'waiting': 'في الانتظار',
        'awaiting_payment': 'في انتظار الدفع',
        'awaiting_fulfillment': 'في انتظار التنفيذ',
        'awaiting_shipment': 'في انتظار الشحن',
        'shipped': 'تم الشحن',
        'partially_shipped': 'شحن جزئي',
        'awaiting_pickup': 'في انتظار الاستلام',
        'cancelled': 'ملغي'
    }
    return labels[status] || status
}

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

// Watch for changes in order items to calculate total
watch(() => newOrder.value.items, () => {
    calculateTotal()
}, { deep: true })

onMounted(() => {
    loadOrders()
})
</script>