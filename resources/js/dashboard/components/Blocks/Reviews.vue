<template>
    <div class="space-y-6">
        <!-- Header with Active Toggle -->
        <div class="flex items-center justify-between border-b border-dotted border-gray-300 pb-4">
            <div class="flex items-center justify-between w-full">
                <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-x-2">
                    <svg viewBox="0 0 24 24" fill="none" class="size-6" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M9.99088 16.5L9.01504 16.9741C7.0341 17.5217 6.04363 17.7955 5.50972 17.2192C4.97582 16.6429 5.25206 15.5982 5.80455 13.5087L5.94749 12.9682C6.10449 12.3744 6.18299 12.0775 6.14352 11.7831C6.10404 11.4887 5.95106 11.2301 5.6451 10.713L5.36655 10.2421C4.28985 8.4221 3.75151 7.51211 4.11106 6.78804C4.4706 6.06397 5.48992 6.00535 7.52857 5.88812L8.05599 5.85779C8.63531 5.82448 8.92497 5.80782 9.17756 5.67305C9.43014 5.53828 9.61705 5.30066 9.99088 4.82542L10.3312 4.39274C11.6467 2.72034 12.3045 1.88413 13.0606 2.01293C13.8167 2.14173 14.1705 3.15023 14.8779 5.16723L15.0609 5.68905C15.262 6.26222 15.3625 6.5488 15.5581 6.75991C15.7537 6.97102 16.0222 7.08275 16.5592 7.30622L17.048 7.50967C18.9378 8.29605 19.8826 8.68925 19.9904 9.49292C20.0823 10.1786 19.513 10.7756 18.3493 11.7831" stroke="#1C274C" stroke-width="1.5"></path> <path d="M15.2516 10.689C14.265 9.50847 13.7716 8.91821 13.2045 9.00913C12.6375 9.10004 12.3722 9.81193 11.8416 11.2357L11.7043 11.604C11.5535 12.0086 11.4781 12.2109 11.3314 12.3599C11.1848 12.509 10.9834 12.5878 10.5806 12.7456L10.214 12.8892C8.79667 13.4443 8.08803 13.7218 8.00721 14.2891C7.92639 14.8564 8.52692 15.3378 9.72797 16.3004L10.0387 16.5495C10.38 16.8231 10.5507 16.9599 10.6494 17.1471C10.7482 17.3343 10.7639 17.5508 10.7954 17.9837L10.824 18.3779C10.9347 19.9015 10.9901 20.6633 11.5072 20.923C12.0244 21.1827 12.6608 20.7683 13.9337 19.9395L14.263 19.7251C14.6247 19.4896 14.8056 19.3718 15.0133 19.3385C15.2211 19.3052 15.4322 19.3601 15.8543 19.47L16.2387 19.57C17.7244 19.9565 18.4673 20.1498 18.8677 19.743C19.2681 19.3362 19.061 18.5987 18.6466 17.1238L18.5394 16.7422C18.4216 16.3231 18.3628 16.1135 18.3924 15.9057C18.422 15.6979 18.5367 15.5154 18.7662 15.1503L18.9751 14.818C19.7826 13.5332 20.1864 12.8909 19.9167 12.3798C19.647 11.8687 18.8826 11.8273 17.3536 11.7446L16.958 11.7231C16.5235 11.6996 16.3063 11.6879 16.1168 11.5927C15.9274 11.4976 15.7872 11.3299 15.5068 10.9944L15.2516 10.689Z" stroke="#1C274C" stroke-width="1.5"></path> </g></svg>
                    التقييمات
                </h3>
                <label class="toggle toggle-lg" :class="{ 'toggle-primary': form.active, 'toggle-secondary': !form.active }">
                    <input type="checkbox" v-model="form.active" />
                    <svg aria-label="enabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                    <svg aria-label="disabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" stroke="currentColor">
                            <path d="M20 6 9 17l-5-5"></path>
                        </g>
                    </svg>
                </label>
            </div>
        </div>

        <!-- Empty State -->
        <div v-if="form.reviews.length === 0" class="text-center py-8 text-gray-500">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
            <p class="text-lg font-medium mb-2">لا توجد تقييمات بعد</p>
            <p class="text-sm text-gray-400">أضف تقييمات العملاء لإظهارها في موقعك</p>
        </div>

        <!-- Reviews List -->
        <div v-else class="space-y-4">
            <div 
                v-for="(review, index) in form.reviews" 
                :key="review.id || index"
                class="bg-white border border-gray-200 rounded-lg p-4"
                draggable="true"
                @dragstart="dragStart(index, $event)"
                @dragover.prevent
                @drop="drop(index, $event)"
            >
                <!-- Review Header -->
                <div class="flex items-center justify-between mb-3">
                    <span class="text-sm font-medium text-gray-600">تقييم #{{ index + 1 }}</span>
                    <div class="flex items-center gap-2">
                        <label class="toggle toggle-lg" :class="{ 'toggle-primary': review.active, 'toggle-secondary': !review.active }">
                            <input type="checkbox" v-model="review.active" />
                            <svg aria-label="enabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                            <svg aria-label="disabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <g stroke-linejoin="round" stroke-linecap="round" stroke-width="4" fill="none" stroke="currentColor">
                                    <path d="M20 6 9 17l-5-5"></path>
                                </g>
                            </svg>
                        </label>
                        <button 
                            @click="removeReview(index)"
                            class="btn btn-sm btn-ghost text-red-600 hover:bg-red-50"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Review Form -->
                <div class="space-y-3 grid grid-cols-1 gap-1">
                    <!-- Client Name -->
                    <label class="input w-full focus-within:ring-offset-0">
                        <span class="label">اسم العميل</span>
                        <input 
                            v-model="review.client_name"
                            type="text"
                            class="w-full"
                            placeholder="اسم العميل"
                            :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`reviews.${index}.client_name`] }"
                        />
                        <span v-if="errorsStore.errors && errorsStore.errors[`reviews.${index}.client_name`]" class="text-red-500 text-xs">
                            {{ errorsStore.errors[`reviews.${index}.client_name`][0] }}
                        </span>
                    </label>

                    <!-- Client Email -->
                    <label class="input w-full focus-within:ring-offset-0">
                        <span class="label">البريد الإلكتروني (اختياري)</span>
                        <input 
                            v-model="review.client_email"
                            type="email"
                            class="w-full"
                            placeholder="البريد الإلكتروني"
                            :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`reviews.${index}.client_email`] }"
                        />
                        <span v-if="errorsStore.errors && errorsStore.errors[`reviews.${index}.client_email`]" class="text-red-500 text-xs">
                            {{ errorsStore.errors[`reviews.${index}.client_email`][0] }}
                        </span>
                    </label>

                    <!-- Client Phone -->
                    <label class="input w-full focus-within:ring-offset-0">
                        <span class="label">رقم الهاتف (اختياري)</span>
                        <input 
                            v-model="review.client_phone"
                            type="tel"
                            class="w-full"
                            placeholder="رقم الهاتف"
                            :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`reviews.${index}.client_phone`] }"
                        />
                        <span v-if="errorsStore.errors && errorsStore.errors[`reviews.${index}.client_phone`]" class="text-red-500 text-xs">
                            {{ errorsStore.errors[`reviews.${index}.client_phone`][0] }}
                        </span>
                    </label>

                    <!-- Score -->
                    <label class="fieldsetx input w-full focus-within:ring-offset-0">
                        <span class="fieldset-legend">التقييم</span>
                        <div class="flex items-center gap-2">
                            <button 
                                v-for="star in 5" 
                                :key="star"
                                @click="review.score = star"
                                class="text-2xl transition-colors"
                                :class="star <= review.score ? 'text-yellow-400' : 'text-gray-300'"
                            >
                                ★
                            </button>
                            <span class="text-sm text-gray-600 mr-2">{{ review.score }}/5</span>
                        </div>
                        <span v-if="errorsStore.errors && errorsStore.errors[`reviews.${index}.score`]" class="text-red-500 text-xs">
                            {{ errorsStore.errors[`reviews.${index}.score`][0] }}
                        </span>
                    </label>

                    <!-- Review Text -->
                    <label class="fieldset w-full focus-within:ring-offset-0">
                        <span class="fieldset-legend">نص التقييم</span>
                        <textarea 
                            v-model="review.review_text"
                            class="w-full input resize-none"
                            placeholder="نص التقييم"
                            :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`reviews.${index}.review_text`] }"
                        ></textarea>
                        <span v-if="errorsStore.errors && errorsStore.errors[`reviews.${index}.review_text`]" class="text-red-500 text-xs">
                            {{ errorsStore.errors[`reviews.${index}.review_text`][0] }}
                        </span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Add Review Button -->
        <div class="flex items-center justify-between">
            <button 
                @click="addReview"
                class="btn btn-primary btn-outline"
            >
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                إضافة تقييم
            </button>
            <button 
                @click="save" 
                class="btn btn-primary" 
                :disabled="formLoading"
            > 
                <span v-if="!formLoading">حفظ التقييمات</span>
                <span v-else class="loading loading-spinner loading-sm"></span>
            </button>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useErrorsStore } from '@/stores/errors'
import axios from 'axios'

const errorsStore = useErrorsStore()
const formLoading = ref(false)
const loading = ref(false)
const draggedIndex = ref(null)

const form = ref({
    id: null,
    active: false,
    reviews: []
})

onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/reviews').then(response => {
        form.value = response.data.data
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const addReview = () => {
    form.value.reviews.push({
        id: null, // Will be set by server when created
        client_name: '',
        client_email: '',
        client_phone: '',
        score: 5,
        review_text: '',
        active: true,
        sort: form.value.reviews.length
    })
}

const removeReview = (index) => {
    form.value.reviews.splice(index, 1)
}

// Drag and Drop Functions
const dragStart = (index, event) => {
    draggedIndex.value = index
    event.dataTransfer.effectAllowed = 'move'
    event.dataTransfer.setData('text/html', event.target.outerHTML)
}

const drop = (dropIndex, event) => {
    event.preventDefault()
    
    if (draggedIndex.value === null || draggedIndex.value === dropIndex) {
        draggedIndex.value = null
        return
    }
    
    const draggedItem = form.value.reviews[draggedIndex.value]
    form.value.reviews.splice(draggedIndex.value, 1)
    form.value.reviews.splice(dropIndex, 0, draggedItem)
    
    // Update sort order
    form.value.reviews.forEach((review, index) => {
        review.sort = index
    })
    
    draggedIndex.value = null
}

const save = () => {
    formLoading.value = true;
    
    axios.post('/api/blocks/reviews', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        
        // Update form with response data to get proper IDs
        form.value = response.data.data
        
        // Reload preview iframe
        const previewIframe = document.getElementById('preview-iframe')
        if (previewIframe) {
            previewIframe.contentWindow.location.reload();
        }
        
    })
    .catch(error => {
        console.error('Error saving reviews:', error.response?.data?.errors || error.message)
        formLoading.value = false;
        if (error.response) {
            errorsStore.setErrors(error.response.data.errors);
        }
    })
}
</script>