<template>
    <div class=" max-w-7xl mx-auto">
        <!-- Theme Selection Section -->
        <div class="mb-8">
            <!-- Horizontal Theme List -->
            <div class="flex gap-3 md:gap-4 overflow-x-auto py-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                <div 
                    v-for="theme in themes" 
                    :key="theme.id"
                    @click="selectTheme(theme)"
                    :class="[
                        'flex-none w-40 md:w-48 bg-white border-2 rounded-xl p-1 cursor-pointer transition-all duration-300 hover:border-primary-500 xhover:-translate-y-1 relative',
                        selectedTheme?.id === theme.id 
                            ? 'border-primary-500 bg-primary-50' 
                            : 'border-gray-200'
                    ]"
                >
               
                    <!-- Current Theme Badge -->
                    <div v-if="currentThemeId === theme.id" 
                         class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-medium z-10">
                        القالب الحالي 
                    </div>
                    
                    <div class="w-full h-28 bg-gray-50 rounded-lg overflow-hidden mb-3">
                        <img 
                            :src="theme.preview" 
                            :alt="theme.name"
                            class="w-full h-full object-cover"
                        />
                    </div>
                    <div class="text-center">
                        <h3 class="text-sm font-semibold text-gray-800 mb-1">{{ theme.name }}</h3>
                        <p class="text-xs text-gray-500 mb-2">{{ theme.category }}</p>
                        <p class="text-lg font-bold text-green-600">
                            {{ theme.price == 0 ? 'مجاني' : '$' + theme.price }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selected Theme Details -->
        <div v-if="selectedTheme" class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="p-8">
                <div class="flex flex-col lg:flex-row gap-8 items-start">
                    <!-- Theme Info Section -->
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-3">
                                <h3 class="text-2xl font-bold text-gray-800">{{ selectedTheme.name }}</h3>
                                <span v-if="currentThemeId === selectedTheme.id" 
                                      class="bg-green-500 text-white text-sm px-3 py-1 rounded-full font-medium">
                                    القالب الحالي
                                </span>
                            </div>
                          

                            <div class="flex items-center gap-3">
                                <span class="text-lg font-bold text-green-600">
                                    {{ selectedTheme.price == 0 ? 'مجاني' : '$' + selectedTheme.price }}
                                </span>
                                <button 
                                    @click="setCurrentTheme"
                                    :disabled="isLoading || currentThemeId === selectedTheme.id"
                                    class="btn btn-primary"
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
                        <span class="inline-block bg-primary-500 text-white px-3 py-1 rounded-full text-xs font-medium mb-4">
                            {{ selectedTheme.category }}
                        </span>
                        <p class="text-gray-600 leading-relaxed mb-6">{{ selectedTheme.description }}</p>
                       
                           

                        <div class="mb-8">
                             
                            <ul class="space-y-2">
                                <li v-for="feature in selectedTheme.features" :key="feature" 
                                    class="text-gray-600 pr-6 relative">
                                    <span class="absolute right-0 text-green-500 font-bold">✓</span>
                                    {{ feature }}
                                </li>
                            </ul>
                        </div>
                        
                     

                        <ThemeOptionsForm v-model="options" :options="options" :themeOptions="selectedTheme.optionFields" :themeId="selectedTheme.id" />


                    </div>

                    <!-- Mobile Preview Section -->
                    <div class="lg:px-5">
                        <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[10px] rounded-[2.5rem] h-[700px] w-[420px] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]" dir="ltr">
                            <div class="h-[672px] overflow-hidden w-[398px] bg-white overflow-y-scroll rounded-[2rem] dark:bg-gray-800">
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

const router = useRouter()
const route = useRoute()
const authStore = useAuthStore()
const { tenant } = storeToRefs(authStore)

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
        
        // Show success message (you can add a toast notification here)
        console.log('Theme updated successfully:', response.data)
        document.getElementById('preview-iframe').contentWindow.location.reload();

        
    } catch (error) {
        console.error('Error updating theme:', error)
        // Handle error (you can add error handling here)
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
    })
})
</script>
