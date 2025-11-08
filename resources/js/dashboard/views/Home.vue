<template>
    <Container>
        <div class="">
            <div class="grid gap-6 xl:grid-cols-[2.2fr,1fr]">
                <div class="space-y-6">
                    <div class="grid gap-6 lg:grid-cols-[1.4fr,1fr] items-stretch">
                        <div class="bg-white rounded-3xl shadow-sm p-8 flex flex-col lg:flex-row items-start lg:items-center gap-8">
                            <div class="space-y-4 flex-1">
                                <p class="text-sm text-gray-400">مرحبا {{ auth.user?.name }},</p>
                                <h1 class="text-3xl font-semibold text-gray-900 leading-snug">
                                    مرحبا بعودتك!
                                </h1>
                                <p class="text-sm text-gray-500 leading-relaxed max-w-md">
                                    هذه الصفحة مخصصة لتقديم بعض المعلومات المهمة عن صفحتك. 
                                </p>
                                <div class="grid gap-4 sm:grid-cols-3">
                                    <div
                                        v-for="metric in summaryMetrics"
                                        :key="metric.id"
                                        class="bg-gray-100 rounded-2xl px-5 py-4 flex items-center gap-4"
                                    >
                                        <div :class="['flex items-center justify-center rounded-xl size-12 shrink-0', metric.iconBackground]">
                                            <svg
                                                v-if="metric.id === 'likes'"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                class="size-6 text-white"
                                                fill="currentColor"
                                            >
                                                <path d="M2.5 11.25A2.25 2.25 0 0 1 4.75 9h3.5a.75.75 0 0 0 .75-.75V8c0-1.623.875-3.152 2.3-3.964l.77-.44A2.25 2.25 0 0 1 15.5 5.63V11h2.873a2.25 2.25 0 0 1 2.213 2.725l-1.075 5.16A3.75 3.75 0 0 1 15.852 22H9.75A2.75 2.75 0 0 1 7 19.25v-8H4.75A2.25 2.25 0 0 1 2.5 8.75v2.5Z" />
                                            </svg>
                                            <svg
                                                v-else-if="metric.id === 'love'"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                class="size-6 text-white"
                                                fill="currentColor"
                                            >
                                                <path d="M11.645 21.092a.75.75 0 0 0 .71 0c1.208-.663 5.895-3.35 7.897-6.692C21.73 12.779 22 11.86 22 10.875 22 8.053 19.868 6 17.25 6c-1.582 0-3.07.777-4.002 2.017C12.316 6.777 10.828 6 9.25 6 6.632 6 4.5 8.053 4.5 10.875c0 .985.27 1.904.748 3.525 2.002 3.342 6.69 6.029 7.897 6.692Z" />
                                            </svg>
                                            <svg
                                                v-else
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                class="size-6 text-white"
                                                fill="currentColor"
                                            >
                                                <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20Zm-3.25 8.25a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5Zm8.5 0a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5Zm-5.25 6.75a4.75 4.75 0 0 1-4.33-2.75.75.75 0 1 1 1.36-.6 3.25 3.25 0 0 0 5.94 0 .75.75 0 1 1 1.36.6A4.75 4.75 0 0 1 12 17Z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-xl font-semibold text-gray-900">{{ metric.value }}</p>
                                            <p class="text-sm text-gray-500">{{ metric.label }}</p>
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
                            <div class="relative sm:w-48 sm:h-48 w-full aspect-square">
                                <div class="absolute inset-0 bg-indigo-100 rounded-3xl"></div>
                                <div class="absolute inset-6 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-3xl flex items-center justify-center">
                                    <svg class="w-24 h-24 text-white" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="12" y="24" width="10" height="28" rx="3" fill="currentColor" opacity="0.7" />
                                        <rect x="28" y="16" width="10" height="36" rx="3" fill="currentColor" opacity="0.85" />
                                        <rect x="44" y="8" width="10" height="44" rx="3" fill="currentColor" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div hidden class="rounded-3xl bg-gradient-to-br from-blue-600 to-indigo-600 text-white p-8 flex flex-col justify-between gap-6">
                            <div class="space-y-3">
                                <p class="text-sm text-blue-100 uppercase tracking-wide">Congratulations John</p>
                                <h2 class="text-2xl font-semibold leading-snug">
                                    You have completed 75% of your profile.
                                </h2>
                                <p class="text-sm text-blue-100">
                                    Your current progress is great.
                                </p>
                            </div>
                            <button class="inline-flex items-center gap-2 self-start rounded-full bg-white text-blue-600 font-medium px-5 py-2 shadow-sm hover:bg-blue-50 transition">
                                View Profile
                                <span aria-hidden="true">→</span>
                            </button>
                        </div>
                    </div>

                    <div hidden class="grid gap-6 lg:grid-cols-2">
                        <div class="bg-white rounded-3xl shadow-sm p-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900">Views</h3>
                                <span class="text-sm text-gray-400">Jan - Apr</span>
                            </div>
                            <p class="text-4xl font-semibold text-gray-900 mt-4">6,967,431</p>
                            <div class="mt-6">
                                <svg viewBox="0 0 400 160" class="w-full h-40">
                                    <defs>
                                        <linearGradient id="chartGradient" x1="0" x2="0" y1="0" y2="1">
                                            <stop offset="0%" stop-color="#4F46E5" stop-opacity="0.4" />
                                            <stop offset="100%" stop-color="#818CF8" stop-opacity="0" />
                                        </linearGradient>
                                    </defs>
                                    <path
                                        d="M20 130 C80 90, 120 140, 170 110 C220 80, 270 40, 320 90 C340 110, 360 120, 380 100 L380 140 L20 140 Z"
                                        fill="url(#chartGradient)"
                                        opacity="0.7"
                                    />
                                    <path
                                        d="M20 130 C80 90, 120 140, 170 110 C220 80, 270 40, 320 90 C340 110, 360 120, 380 100"
                                        fill="none"
                                        stroke="#4F46E5"
                                        stroke-width="6"
                                        stroke-linecap="round"
                                    />
                                    <g fill="#4F46E5" opacity="0.6">
                                        <text x="30" y="150" font-size="12">Jan</text>
                                        <text x="120" y="150" font-size="12">Feb</text>
                                        <text x="210" y="150" font-size="12">Mar</text>
                                        <text x="300" y="150" font-size="12">Apr</text>
                                    </g>
                                </svg>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <button class="inline-flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-indigo-600 transition">
                                    View Dashboard
                                    <span aria-hidden="true">→</span>
                                </button>
                                <div class="flex items-center gap-4">
                                    <div class="flex items-center gap-2 text-sm text-gray-500">
                                        <span class="block size-2 rounded-full bg-indigo-500"></span> Current
                                    </div>
                                    <div class="flex items-center gap-2 text-sm text-gray-400">
                                        <span class="block size-2 rounded-full bg-indigo-200"></span> Previous
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-3xl shadow-sm p-6 space-y-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900">Targets</h3>
                                <p class="text-sm text-gray-500 mt-2">Quarterly performance overview</p>
                            </div>
                            <div class="space-y-5">
                                <div v-for="target in targets" :key="target.label" class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-medium text-gray-600">{{ target.label }}</span>
                                        <span class="text-sm font-semibold text-gray-900">{{ target.value }}</span>
                                    </div>
                                    <div class="h-2 rounded-full bg-gray-100 overflow-hidden">
                                        <div
                                            class="h-full rounded-full"
                                            :class="target.barColor"
                                            :style="{ width: target.value }"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div hidden class="space-y-6">
                    <div class="bg-white rounded-3xl shadow-sm p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-semibold text-gray-900">Meetings</h3>
                            <button class="size-10 flex items-center justify-center rounded-full bg-indigo-50 text-indigo-500 hover:bg-indigo-100 transition">
                                +
                            </button>
                        </div>
                        <div class="space-y-4">
                            <div
                                v-for="meeting in meetings"
                                :key="meeting.id"
                                class="flex items-center gap-4 p-4 rounded-2xl border border-transparent hover:border-indigo-100 hover:bg-indigo-50/40 transition"
                            >
                                <img
                                    :src="meeting.avatar"
                                    :alt="meeting.name"
                                    class="size-12 rounded-full object-cover"
                                />
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900">{{ meeting.name }}</p>
                                    <p class="text-sm text-gray-500">{{ meeting.time }}</p>
                                </div>
                                <button class="text-gray-300 hover:text-indigo-500 transition">›</button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl shadow-sm p-6 space-y-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
                            <button class="text-sm text-indigo-500 hover:text-indigo-600 transition">See all</button>
                        </div>
                        <div class="grid gap-4">
                            <button class="flex items-center justify-between p-4 rounded-2xl bg-indigo-50 text-indigo-600 font-medium hover:bg-indigo-100 transition">
                                Create new project
                                <span aria-hidden="true">→</span>
                            </button>
                            <button class="flex items-center justify-between p-4 rounded-2xl border border-gray-100 hover:border-indigo-100 hover:bg-indigo-50/40 transition text-sm text-gray-600">
                                Invite team member
                                <span aria-hidden="true">→</span>
                            </button>
                            <button class="flex items-center justify-between p-4 rounded-2xl border border-gray-100 hover:border-indigo-100 hover:bg-indigo-50/40 transition text-sm text-gray-600">
                                View analytics
                                <span aria-hidden="true">→</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Container>
</template>

<script setup>
    import { computed } from 'vue'
    import { useAuthStore } from '@/stores/auth'
    import { useHead } from '@unhead/vue'

    const auth = useAuthStore()
    
useHead({
  title: 'الرئيسية',
  meta: [
    { name: 'description', content: 'الرئيسية' },
  ],
})
    
    const summaryMetrics = computed(() => [
        {
            id: 'likes',
            label: 'Likes',
            value: '26,789',
            iconBackground: 'bg-blue-500',
            trend: 'up',
        },
        {
            id: 'love',
            label: 'Love',
            value: '6,754',
            iconBackground: 'bg-red-500',
            trend: 'steady',
        },
        {
            id: 'smiles',
            label: 'Smiles',
            value: '52,789',
            iconBackground: 'bg-yellow-400',
            trend: 'down',
        },
    ])

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