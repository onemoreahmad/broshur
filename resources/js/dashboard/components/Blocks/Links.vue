<template>
    <div class="">
        <div v-if="loading" class="text-center flex justify-center items-center w-full h-full absolute top-0 left-0">
            <span class="loading loading-spinner loading-lg opacity-75"></span>
        </div>
        <div v-else>
            <div class="flex flex-col gap-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-800">الروابط الاجتماعية</h2>
                   
                </div>

                <div v-if="form.links.length === 0" class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                    </svg>
                    <p>لا توجد روابط مضافة بعد</p>
                    <p class="text-sm">اضغط على "إضافة رابط" لبدء إضافة الروابط</p>
                </div>

                <div v-else class="space-y-3">
                    <div 
                        v-for="(link, index) in form.links" 
                        :key="index"
                        class="bg-gray-50 rounded-lg p-4 border border-gray-200"
                    >
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <button 
                                    class="btn btn-xs btn-ghost"
                                    @click="toggleCollapse(index)"
                                    :aria-expanded="!collapsed[index]"
                                    :aria-controls="`link-panel-${index}`"
                                >
                                    <svg v-if="collapsed[index]" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.24 4.5a.75.75 0 01-1.08 0l-4.24-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" /></svg>
                                    <svg v-else class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.77 12.79a.75.75 0 01-1.06-.02L10 8.832l-3.71 3.938a.75.75 0 11-1.08-1.04l4.24-4.5a.75.75 0 011.08 0l4.24 4.5c.28.297.27.765-.02 1.06z" clip-rule="evenodd" /></svg>
                                </button>
                                <span class="text-sm font-medium text-gray-600"> {{ link.network }} {{ index + 1 }}</span>
                                <div class="flex items-center gap-2">

                                <label class="toggle toggle-lg" :class="{ 'toggle-primary': link.active, 'toggle-secondary': !link.active }">
                                    <input type="checkbox" v-model="link.active" />

                                    <svg
                                        aria-label="enabled"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="4"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path d="M18 6 6 18" />
                                        <path d="m6 6 12 12" />
                                    </svg>
                                    <svg aria-label="disabled" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <g
                                        stroke-linejoin="round"
                                        stroke-linecap="round"
                                        stroke-width="4"
                                        fill="none"
                                        stroke="currentColor"
                                        >
                                        <path d="M20 6 9 17l-5-5"></path>
                                        </g>
                                    </svg>
                                    </label>

                                    <!-- <input type="checkbox" v-model="link.active" class="toggle toggle-primary toggle-sm" /> -->
                                    <!-- <span class="text-xs text-gray-600">{{ link.active ? 'ظاهر' : 'مخفي' }}</span> -->
                                </div>
                            </div>
                            <button 
                                @click="removeLink(index)"
                                class="btn btn-sm btn-outline text-red-600 hover:bg-red-50"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>

                        <div :id="`link-panel-${index}`" v-show="!collapsed[index]" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <select 
                                    v-model="link.network" 
                                    class="select w-full"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`links.${index}.network`] }"
                                >
                                    <option value="">اختر الشبكة</option>
                                    <option value="facebook">فيسبوك</option>
                                    <option value="twitter">تويتر</option>
                                    <option value="instagram">إنستغرام</option>
                                    <option value="linkedin">لينكد إن</option>
                                    <option value="youtube">يوتيوب</option>
                                    <option value="tiktok">تيك توك</option>
                                    <option value="snapchat">سناب شات</option>
                                    <option value="whatsapp">واتساب</option>
                                    <option value="telegram">تيليجرام</option>
                                    <option value="discord">ديسكورد</option>
                                    <option value="github">جيت هاب</option>
                                    <option value="website">موقع إلكتروني</option>
                                    <option value="other">أخرى</option>
                                </select>
                                <span v-if="errorsStore.errors && errorsStore.errors[`links.${index}.network`]" class="text-red-500 text-xs">
                                    {{ errorsStore.errors[`links.${index}.network`][0] }}
                                </span>
                            </div>

                            <div>
                                <input 
                                    v-model="link.label" 
                                    type="text" 
                                    class="input w-full"
                                    :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`links.${index}.label`] }"
                                    placeholder="مسمى الرابط (اختياري)"
                                />
                                <span v-if="errorsStore.errors && errorsStore.errors[`links.${index}.label`]" class="text-red-500 text-xs">
                                    {{ errorsStore.errors[`links.${index}.label`][0] }}
                                </span>
                            </div>
                        </div>

                        <div v-show="!collapsed[index]" class="mt-3">
                            <input 
                                v-model="link.url" 
                                type="url" 
                                dir="ltr"
                                class="input w-full"
                                :class="{ 'border-red-500': errorsStore.errors && errorsStore.errors[`links.${index}.url`] }"
                                placeholder="https://example.com"
                            />
                            <span v-if="errorsStore.errors && errorsStore.errors[`links.${index}.url`]" class="text-red-500 text-xs">
                                {{ errorsStore.errors[`links.${index}.url`][0] }}
                            </span>
                        </div>
 
                    </div>
                </div>
                
                <div class="flex justify-between w-full pt-4">
                    <button 
                        @click="addLink"
                        class="btn btn-primary btn-outline"
                    >
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        إضافة رابط
                    </button>

                    <button 
                        @click="save" 
                        class="btn btn-primary" 
                        :disabled="formLoading"
                    > 
                        <span v-if="!formLoading">حفظ الروابط</span>
                        <span v-if="formLoading" class="loading loading-spinner loading-xs"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from 'axios'
import { ref, onMounted, watch } from 'vue'
import { useErrorsStore } from '@/stores/errors'

const errorsStore = useErrorsStore()

const form = ref({
    links: []
})

const loading = ref(false)
const formLoading = ref(false)
const collapsed = ref([])
const COLLAPSE_STORAGE_KEY = 'dashboard.links_block.collapsed'
 
onMounted(() => {
    loading.value = true
    axios.get('/api/blocks/links').then(response => {
        form.value = response.data.data
        // load collapsed state from localStorage and align lengths
        try {
            const saved = JSON.parse(localStorage.getItem(COLLAPSE_STORAGE_KEY) || '[]')
            const len = response.data.data.links.length
            collapsed.value = Array.from({ length: len }, (_, i) => Boolean(saved[i] ?? false))
        } catch (e) {
            collapsed.value = response.data.data.links.map(() => false)
        }
        loading.value = false
    })
    .catch(error => {
        console.error(error)
        loading.value = false
    })
})

const addLink = () => {
    form.value.links.push({
        url: '',
        network: '',
        label: '',
        active: true
    })
    collapsed.value.push(false)
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
}

const removeLink = (index) => {
    form.value.links.splice(index, 1)
    collapsed.value.splice(index, 1)
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
}

const getNetworkLabel = (network) => {
    const labels = {
        'facebook': 'فيسبوك',
        'twitter': 'تويتر',
        'instagram': 'إنستغرام',
        'linkedin': 'لينكد إن',
        'youtube': 'يوتيوب',
        'tiktok': 'تيك توك',
        'snapchat': 'سناب شات',
        'whatsapp': 'واتساب',
        'telegram': 'تيليجرام',
        'discord': 'ديسكورد',
        'github': 'جيت هاب',
        'website': 'موقع إلكتروني',
        'other': 'أخرى'
    }
    return labels[network] || network
}

const save = () => {
    formLoading.value = true;
 
    axios.post('/api/blocks/links', form.value).then(response => {
        formLoading.value = false
        errorsStore.setErrors([]);
        
        // Reload preview iframe
        const previewIframe = document.getElementById('preview-iframe')
        if (previewIframe) {
            previewIframe.contentWindow.location.reload();
        }
        
    })
    .catch(error => {
        console.error(error.response.data.errors)
        formLoading.value = false;
        if (error.response) {
            errorsStore.setErrors(error.response.data.errors);
        }
    })
}

const toggleCollapse = (index) => {
    collapsed.value[index] = !collapsed.value[index]
    localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(collapsed.value))
}

// persist whenever collapsed changes in length/content
watch(collapsed, (val) => {
    try { localStorage.setItem(COLLAPSE_STORAGE_KEY, JSON.stringify(val)) } catch (e) {}
}, { deep: true })
</script>
 