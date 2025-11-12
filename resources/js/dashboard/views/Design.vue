<template>
    <div class="max-w-7xl mx-auto mt-2 md:mt-4 px-2 md:px-4 xl:px-0">
        <!-- Theme Selection Section -->
        <div class="mb-4">
            <!-- Loading State -->
            <div v-if="isLoadingThemes" class="flex justify-center items-center py-12">
                <span class="loading loading-spinner loading-lg"></span>
                <!-- <span class="mr-3 text-gray-600">جاري تحميل القوالب...</span> -->
            </div>
            
            <!-- Horizontal Theme List -->
            <div v-else class="flex gap-2 md:gap-3 lg:gap-4 overflow-x-auto py-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 -mx-2 px-2 md:mx-0 md:px-0">
                <div 
                    v-for="theme in themes" 
                    :key="theme.id"
                    @click="selectTheme(theme)"
                    :class="[
                        'flex-none w-36 sm:w-40 md:w-42 bg-white border-2 rounded-lg md:rounded-xl p-1 cursor-pointer transition-all duration-300 hover:border-primary-500 xhover:-translate-y-1 relative',
                        selectedTheme?.id === theme.id 
                            ? 'border-primary-500 bg-primary-50' 
                            : 'border-gray-200'
                    ]"
                >
               
                    <!-- Current Theme Badge -->
                    <div v-if="currentThemeId === theme.id" 
                         class="absolute top-1.5 right-1.5 md:top-2 md:right-2 bg-green-500 text-white text-[10px] md:text-xs px-1.5 md:px-2 py-0.5 md:py-1 rounded-full font-medium z-10">
                        القالب الحالي 
                    </div>
                    
                    <div class="w-full aspect-[3/4] bg-gray-50 rounded-md md:rounded-lg overflow-hidden mb-2 md:mb-3">
                        <img 
                            :src="theme.preview" 
                            :alt="theme.name"
                            class="w-full h-full object-cover object-top"
                        /> 
                    </div>
                    <div class="flex items-center justify-between gap-1 p-1">
                        <h3 class="text-[10px] md:text-xs font-semibold text-gray-800 truncate flex-1">{{ theme.name }}</h3>
                        <p class="text-[9px] md:text-[10px] badge badge-sm badge-soft badge-success shrink-0">
                            <span class=" ">
                                {{ theme.price == 0 ? 'مجاني' : '$' + theme.price }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selected Theme Details -->
        <div v-if="selectedTheme" class="bg-white rounded-xl md:rounded-2xl border border-gray-200 overflow-hidden">
            <div class="p-4 md:p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row gap-6 md:gap-8 items-start">
                    <!-- Theme Info Section -->
                    <div class="flex-1 w-full">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 md:gap-4 mb-3 md:mb-4">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3">
                                <h3 class="text-xl md:text-2xl font-bold text-gray-800">{{ selectedTheme.name }}</h3>
                                <span v-if="currentThemeId === selectedTheme.id" 
                                      class="bg-green-500 text-white text-xs md:text-sm px-2 md:px-3 py-1 rounded-full font-medium self-start sm:self-auto">
                                    القالب الحالي
                                </span>
                            </div>
                          

                            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 sm:gap-3">
                                <span class="text-base md:text-lg font-bold text-green-600">
                                    {{ selectedTheme.price == 0 ? 'مجاني' : '$' + selectedTheme.price }}
                                </span>
                                <button 
                                    @click="setCurrentTheme"
                                    :disabled="isLoading || currentThemeId === selectedTheme.id"
                                    class="btn btn-primary w-full sm:w-auto text-sm md:text-base"
                                >
                                    <span v-if="!isLoading">
                                        {{ currentThemeId === selectedTheme.id ? 'القالب الحالي' : 'تعيين كقالب حالي' }}
                                    </span>
                                    <span v-if="isLoading" class="flex items-center gap-2">
                                        <span class="loading loading-spinner loading-xs"></span>
                                        جاري التطبيق...
                                    </span>
                                </button>
                                
                            </div>


                        </div>
                        <span class="inline-block bg-primary-500 text-white px-2 md:px-3 py-1 rounded-full text-xs font-medium mb-3 md:mb-4">
                            {{ selectedTheme.category }}
                        </span>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed mb-4 md:mb-6">{{ selectedTheme.description }}</p>
                       
                           

                        <div class="mb-6 md:mb-8">
                             
                            <ul class="space-y-2">
                                <li v-for="feature in selectedTheme.features" :key="feature" 
                                    class="text-sm md:text-base text-gray-600 pr-5 md:pr-6 relative">
                                    <span class="absolute right-0 text-green-500 font-bold">✓</span>
                                    {{ feature }}
                                </li>
                            </ul>
                        </div>
                        
                     

                        <ThemeOptionsForm v-model="options" :options="options" :themeOptions="selectedTheme.optionFields" :themeId="selectedTheme.id" />


                    </div>

                    <!-- Mobile Preview Section -->
                    <div class="lg:px-5 shrink-0">
                        <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[10px] rounded-[2.5rem] h-[700px] w-[300px] lg:w-[420px] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]" dir="ltr">
                            <div class="h-[672px] mx-auto overflow-hidden w-[280px] lg:w-[398px] bg-white overflow-y-scroll rounded-[2rem] dark:bg-gray-800">
                                <iframe id="preview-iframe" :src="authStore.tenant?.preview_url" class="w-full min-h-screen"></iframe> 
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted, computed } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { useHead } from '@unhead/vue'
import axios from 'axios'
import { useAuthStore } from '@/stores/auth'
import { storeToRefs } from 'pinia'
import { useNotification } from '@kyvg/vue3-notification'

const router = useRouter()
const route = useRoute()
const authStore = useAuthStore()
const { tenant } = storeToRefs(authStore)
const { notify } = useNotification()

useHead({
  title: 'تخصيص التصميم',
  meta: [
    { name: 'description', content: 'تخصيص تصميم البروشور' },
  ],
})

// Themes from API
const themes = ref([])
const options = ref({})

const selectedTheme = ref(null)
const isLoading = ref(false)
const isLoadingThemes = ref(false)
 
const currentThemeId = computed(() => {
    return   tenant.value?.theme_id ?? null
})

// Initialize theme from URL or default to first theme
const initializeTheme = () => {
    // Get current theme from auth store
    currentThemeId.value = tenant.value?.theme_id || null
    
    const themeId = route.query.theme ? parseInt(route.query.theme) : null
    const theme = themeId ? themes.value.find(t => t.id === themeId) : themes.value[0]
    selectedTheme.value = theme

    options.value = theme.tenantOptions || {}
    
    // Update URL if no theme in query params
    if (!route.query.theme) {
        router.replace({ query: { theme: theme.id } })
    }
}

const selectTheme = (theme) => {
    selectedTheme.value = theme
    // Update URL with selected theme ID
    router.push({ query: { theme: theme.id } })
}

const setCurrentTheme = async () => {
    if (!selectedTheme.value) return

    console.log(selectedTheme)
    
    isLoading.value = true
    try {
        const response = await axios.post('/api/tenant/theme', {
            theme_id: selectedTheme.value.id
        })
        
        // Update the tenant in the auth store
        authStore.updateTenant({ theme_id: selectedTheme.value.id })
        
        // Update current theme ID
        currentThemeId.value = selectedTheme.value.id
        
        notify({ type: "success", text: "تم تعيين القالب بنجاح" })
        
        console.log('Theme updated successfully:', response.data)
        document.getElementById('preview-iframe').contentWindow.location.reload();

        
    } catch (error) {
        console.error('Error updating theme:', error)
        notify({ type: "error", text: "فشل تعيين القالب" })
    } finally {
        isLoading.value = false
    }
}

// Watch for URL changes (back/forward navigation)
watch(() => route.query.theme, (newThemeId) => {
    if (newThemeId) {
        const theme = themes.value.find(t => t.id === parseInt(newThemeId))
        if (theme) {
            selectedTheme.value = theme
        }
    }
})

// Initialize on component mount
onMounted(() => {
    isLoadingThemes.value = true
    axios.get('/api/themes').then(response => {
        themes.value = response.data.data.map(t => ({
            id: t.id,
            name: t.name,
            category: t.category || 'عام',
            price: t.price ?? 0,
            description: t.description || '',
            preview: t.image,
            optionFields: t.optionFields,
            features: Array.isArray(t.features) ? t.features : [],
            tenantOptions: t.tenantOptions
        }))
        initializeTheme()
    }).catch(() => {
        themes.value = []
        initializeTheme()
    }).finally(() => {
        isLoadingThemes.value = false
    })
})
</script>
