<template>
    <Container>
        <div class="">
            <div class="grid gap-4 md:gap-6 xl:grid-cols-[2.2fr,1fr]">
                <div class="space-y-4 md:space-y-6">
                    <div class="grid gap-4 md:gap-6 lg:grid-cols-[1.4fr,1fr] items-stretch">
                        <div class="bg-white rounded-2xl md:rounded-3xl shadow-sm p-4 md:p-6 lg:p-8">
                            <div class="space-y-3 md:space-y-4 flex-1">
                                <h1 class="text-lg md:text-xl font-semibold text-gray-900 leading-snug">
                                    مرحبا بعودتك, {{ auth.user?.name }} 
                                    <span class="text-2xl md:text-3xl ms-2">
                                        👋
                                    </span>
                                </h1>
                                 <p class="text-xs md:text-sm text-gray-500/50 leading-relaxed max-w-md">
                                    إحصائيات صفحتك خلال الشهر ({{ dateRange.days }} يوم) الفترة من {{ dateRange.from }} إلى {{ dateRange.to }}
                                </p> 
                                <div class="grid gap-3 md:gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 w-full mt-4 md:mt-6">
                                    <div
                                        v-for="metric in summaryMetrics"
                                        :key="metric.id"
                                        :class="[
                                            'bg-gray-100 rounded-xl md:rounded-2xl px-3 py-3 md:px-5 md:py-4 flex items-center gap-2 md:gap-4 transition w-full',
                                            isLoadingMetrics ? 'animate-pulse' : ''
                                        ]"
                                    >
                                        <div :class="['flex items-center justify-center rounded-lg md:rounded-xl size-10 md:size-12 shrink-0', metric.iconBackground]">
                                            <svg
                                                v-if="metric.id === 'views'"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                class="size-5 md:size-6 text-white"
                                                fill="currentColor"
                                            >
                                                <path d="M4 13a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v6H5a1 1 0 0 1-1-1v-5Zm6-4a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v10h-5V9Zm6-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1h-4V4Z" />
                                            </svg>
                                            <svg
                                                v-else-if="metric.id === 'visitors'"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                class="size-5 md:size-6 text-white"
                                                fill="currentColor"
                                            >
                                                <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                                                <path d="M4 20a8 8 0 1 1 16 0z" />
                                            </svg>
                                            <svg
                                                v-else-if="metric.id === 'average_visit_time'"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                class="size-5 md:size-6 text-white"
                                                fill="currentColor"
                                            >
                                                <path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8Zm.5-13h-1a1 1 0 0 0-1 1v4.382a1 1 0 0 0 .293.707l2.536 2.535a1 1 0 0 0 1.414-1.414L12.5 11.586Z" />
                                            </svg>
                                            <svg
                                                v-else-if="metric.id === 'order_count'"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                class="size-5 md:size-6 text-white"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.5"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            >
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M13 5h8" />
                                                <path d="M13 9h5" />
                                                <path d="M13 15h8" />
                                                <path d="M13 19h5" />
                                                <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                                <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            </svg>
                                            <svg
                                                v-else
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                class="size-5 md:size-6 text-white"
                                                fill="currentColor"
                                            >
                                                <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm-3.25 8.25a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5Zm8.5 0a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5Zm-5.25 6.75a4.75 4.75 0 0 1-4.33-2.75.75.75 0 1 1 1.36-.6 3.25 3.25 0 0 0 5.94 0 .75.75 0 1 1 1.36.6A4.75 4.75 0 0 1 12 17Z" />
                                            </svg>
                                        </div> 
                                        <div class="flex-1 min-w-0">
                                            <p class="text-lg md:text-xl font-semibold text-gray-900 truncate">{{ metric.value }}</p>
                                            <p class="text-xs md:text-sm text-gray-500 line-clamp-2">{{ metric.label }}</p>
                                        </div>
                                        <span
                                            v-if="metric.trend"
                                            :class="[
                                                'ml-auto text-xs font-medium px-2 py-1 rounded-full hidden sm:inline-flex',
                                                metric.trend === 'up'
                                                    ? 'bg-green-100 text-green-600'
                                                    : metric.trend === 'down'
                                                        ? 'bg-red-100 text-red-600'
                                                        : 'bg-gray-100 text-gray-500'
                                            ]"
                                        >
                                            {{ metric.trend === 'up' ? '▲' : metric.trend === 'down' ? '▼' : '•' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
 
                    </div>
 
                </div>
 
            </div>
        </div>
    </Container>
</template>

<script setup>
    import { onMounted, ref } from 'vue'
    import axios from 'axios'
    import { useAuthStore } from '@/stores/auth'
    import { useHead } from '@unhead/vue'

    const auth = useAuthStore()

    const summaryMetrics = ref([
        {
            id: 'views',
            label: 'عدد الزايارات (المشاهدات)',
            value: '0',
            iconBackground: 'bg-blue-500',
            trend: null,
        },
        {
            id: 'visitors',
            label: 'عدد الزوار',
            value: '0',
            iconBackground: 'bg-indigo-500',
            trend: null,
        },
        {
            id: 'average_visit_time',
            label: 'متوسط زمن الزيارة',
            value: '0s',
            iconBackground: 'bg-teal-500',
            trend: null,
        },
        {
            id: 'order_count',
            label: 'عدد الطلبات',
            value: '0',
            iconBackground: 'bg-green-500',
            trend: null,
        },
        {
            id: 'subscribers_count',
            label: 'عدد المشتركين',
            value: '0',
            iconBackground: 'bg-purple-500',
            trend: null,
        },
    ])

    const isLoadingMetrics = ref(false)
    const dateRange = ref({})
    const fetchSummaryMetrics = async () => {
        isLoadingMetrics.value = true
        try {
            const response = await axios.get('/api/dashboard/analytics/overview')
            const summary = response?.data?.data?.summary ?? {}
            dateRange.value = response?.data?.date_range ?? {}
            const formatter = new Intl.NumberFormat()

            summaryMetrics.value = [
                {
                    id: 'views',
                    label: 'عدد الزايارات (المشاهدات)',
                    value: formatter.format(summary.views ?? 0),
                    iconBackground: 'bg-blue-500',
                    trend: null,
                },
                {
                    id: 'visitors',
                    label: 'عدد الزوار',
                    value: formatter.format(summary.visitors ?? 0),
                    iconBackground: 'bg-indigo-500',
                    trend: null,
                },
                {
                    id: 'average_visit_time',
                    label: 'متوسط زمن الزيارة',
                    value: summary.average_visit_time ?? '0s',
                    iconBackground: 'bg-purple-500',
                    trend: null,
                },
                {
                    id: 'order_count',
                    label: 'عدد الطلبات',
                    value: formatter.format(response?.data?.order_count ?? 0),
                    iconBackground: 'bg-teal-500',
                    trend: null,
                },
                {
                    id: 'subscribers_count',
                    label: 'عدد المشتركين',
                    value: formatter.format(response?.data?.subscribers_count ?? 0),
                    iconBackground: 'bg-cyan-500',
                    trend: null,
                },
            ]
        } catch (error) {
            console.error('Failed to load dashboard summary', error)
        } finally {
            isLoadingMetrics.value = false
        }
    }

    onMounted(() => {
        fetchSummaryMetrics()
    })

    useHead({
        title: 'الرئيسية',
        meta: [
            { name: 'description', content: 'الرئيسية' },
        ],
    })

    const targets = [
        {
            label: 'Views',
            value: '75%',
            barColor: 'bg-blue-500',
        },
        {
            label: 'Followers',
            value: '50%',
            barColor: 'bg-yellow-400',
        },
        {
            label: 'Income',
            value: '25%',
            barColor: 'bg-red-400',
        },
    ]

    const meetings = [
        {
            id: 1,
            name: 'Emmy Anderson',
            time: '08:00 - 10:00',
            avatar: 'https://i.pravatar.cc/100?img=5',
        },
        {
            id: 2,
            name: 'Joy McGlynn',
            time: '11:00 - 12:00',
            avatar: 'https://i.pravatar.cc/100?img=32',
        },
        {
            id: 3,
            name: 'Mara Dach',
            time: '14:00 - 15:00',
            avatar: 'https://i.pravatar.cc/100?img=56',
        },
    ]
</script>