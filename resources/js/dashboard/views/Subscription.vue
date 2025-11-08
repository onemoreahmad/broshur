<template>
    <Container title="الاشتراك والباقات" subtitle="اختر الخطة المناسبة لعملك وابدأ بالاستفادة من مزايا بروشور.">
        <div class="space-y-6">
            <div
                v-if="subscription"
                class="rounded-3xl border border-primary-200 bg-primary-50 px-6 py-4 text-sm text-primary-800 flex flex-col gap-1 md:flex-row md:items-center md:justify-between"
            >
                <div>
                    <span class="font-semibold">الباقة الحالية:</span>
                    <span>{{ subscription.plan_name || '—' }} {{ subscription.periodicity_type }}</span>
                </div>
                <div class="flex flex-wrap gap-4 text-xs text-primary-700/80 mt-2 md:mt-0">
                    <span v-if="subscription.started_at">تاريخ البداية: {{ subscription.started_at }}</span>
                    <span v-if="subscription.expired_at">تاريخ التجديد القادم: {{ subscription.expired_at }}</span>
                    <span v-if="subscription.grace_days_ended_at">نهاية فترة السماح: {{ subscription.grace_days_ended_at }}</span>
                </div>
            </div>

            <div v-if="loading" class="flex justify-center py-20">
                <span class="loading loading-spinner loading-lg text-primary-500"></span>
            </div>

            <div v-else>
                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    <article
                        v-for="plan in plans"
                        :key="plan.key"
                        :class="planCardClasses(plan)"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div
                                    :class="[
                                        'size-12 rounded-2xl flex items-center justify-center text-white shadow-sm',
                                        plan.info?.color || 'bg-primary-500'
                                    ]"
                                >
                                    <span v-if="plan.info?.image" v-html="plan.info.image"></span>
                                    <img
                                        v-else-if="plan.image"
                                        :src="plan.image"
                                        :alt="plan.name"
                                        class="h-10 w-10 object-contain"
                                    />
                                    <span v-else class="text-lg font-semibold">
                                        {{ plan.name?.charAt(0) }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400">{{ plan.label }}</p>
                                    <h3 class="text-lg font-semibold text-gray-900">{{ plan.name }}</h3>
                                </div>
                            </div>

                            <span
                                v-if="isCurrentPlanGroup(plan)"
                                class="rounded-full bg-primary-100 px-3 py-1 text-xs font-semibold text-primary-600"
                            >
                                الباقة الحالية
                            </span>
                        </div>

                        <div class="mt-5 flex flex-wrap gap-3">
                            <label
                                v-for="option in plan.options"
                                :key="option.id"
                                :class="[
                                    'cursor-pointer rounded-2xl border px-4 py-2 text-sm font-medium transition focus-within:ring-2 focus-within:ring-primary-300 flex flex-col text-start min-w-[130px]',
                                    optionClasses(plan.key, option.id)
                                ]"
                            >
                                <input
                                    class="sr-only"
                                    type="radio"
                                    :name="`periodicity-${plan.key}`"
                                    :value="option.id"
                                    v-model="selectedOptions[plan.key]"
                                />
                                <span>{{ periodicityLabel(option.periodicity_type) }}</span>
                                <span class="mt-1 text-xs font-normal text-gray-500">
                                    {{ formatPrice(option.price) }}
                                </span>
                            </label>
                        </div>

                        <div class="mt-6 flex items-baseline gap-2">
                            <p class="text-3xl font-semibold text-gray-900">
                                {{ formatPrice(getSelectedOption(plan)?.price) }}
                            </p>
                            <span v-if="getSelectedOption(plan)?.periodicity_type" class="text-sm text-gray-500">
                                / {{ periodicityLabel(getSelectedOption(plan)?.periodicity_type) }}
                            </span>
                        </div>

                        <p v-if="plan.info?.summary" class="mt-4 text-sm leading-relaxed text-gray-600">
                            {{ plan.info.summary }}
                        </p>

                        <p v-if="plan.info?.description" class="mt-3 text-xs leading-6 text-gray-500">
                            {{ plan.info.description }}
                        </p>

                        <ul v-if="plan.meta?.features?.length" class="mt-5 space-y-3 text-sm text-gray-600">
                            <li
                                v-for="feature in plan.meta.features"
                                :key="feature"
                                class="flex items-center gap-2"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 text-primary-500">
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                <span>{{ feature }}</span>
                            </li>
                        </ul>

                        <div class="mt-auto pt-6">
                            <button
                                class="btn btn-primary w-full"
                                :disabled="submitting || isCurrentPlanGroup(plan) || !getSelectedOption(plan)"
                                @click="openPlanModal(plan)"
                            >
                                <template v-if="isCurrentPlanGroup(plan)">
                                    الخطة الحالية
                                </template>
                                <template v-else>
                                    <span
                                        v-if="submitting && pendingPlanId === getSelectedOption(plan)?.id"
                                        class="loading loading-spinner loading-sm"
                                    ></span>
                                    <span v-else>اشترك الآن</span>
                                </template>
                            </button>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </Container>

    <div
        v-if="showConfirmModal && selectedPlan && modalOption"
        class="fixed inset-0 z-50 flex items-center justify-center px-4"
    >
        <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="closePlanModal()"></div>

        <div class="relative z-10 w-full max-w-2xl rounded-3xl bg-white p-6 shadow-2xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm text-gray-400">تأكيد الاشتراك</p>
                    <h2 class="mt-1 text-2xl font-semibold text-gray-900">{{ selectedPlan.name }}</h2>
                </div>
                <button class="text-gray-400 hover:text-gray-600 transition" @click="closePlanModal()" :disabled="submitting">
                    <span class="sr-only">إغلاق</span>
                    ✕
                </button>
            </div>

            <div class="mt-6 grid gap-4 md:grid-cols-2">
                <div class="space-y-2">
                    <p class="text-sm text-gray-500">سعر الباقة</p>
                    <p class="text-xl font-semibold text-gray-900">
                        {{ formatPrice(modalOption?.price) }}
                        <span v-if="modalOption?.periodicity_type" class="text-sm text-gray-500">
                            / {{ periodicityLabel(modalOption?.periodicity_type) }}
                        </span>
                    </p>

                    <div v-if="selectedPlan.info?.summary" class="rounded-2xl bg-gray-50 p-4 text-sm text-gray-600 leading-relaxed">
                        {{ selectedPlan.info.summary }}
                    </div>
                </div>

                <div class="space-y-2">
                    <p class="text-sm text-gray-500">تفاصيل إضافية</p>
                    <ul class="space-y-2 text-sm text-gray-600 leading-6">
                        <li>
                            <span class="font-medium text-gray-700">أيام السماح:</span>
                            <span>{{ modalOption?.grace_days ?? 0 }} يوم</span>
                        </li>
                        <li v-if="modalOption?.periodicity">
                            <span class="font-medium text-gray-700">الفترة:</span>
                            <span>{{ modalOption?.periodicity }} {{ periodicityLabel(modalOption?.periodicity_type) }}</span>
                        </li>
                        <li v-if="selectedPlan.info?.description">
                            <span class="font-medium text-gray-700 block">عن الباقة:</span>
                            <span>{{ selectedPlan.info.description }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div v-if="selectedPlan.meta?.features?.length" class="mt-6">
                <p class="text-sm font-semibold text-gray-700">تشمل الباقة:</p>
                <ul class="mt-3 grid gap-2 sm:grid-cols-2 text-sm text-gray-600">
                    <li
                        v-for="feature in selectedPlan.meta.features"
                        :key="feature"
                        class="flex items-start gap-2"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4 text-primary-500 mt-0.5">
                            <path
                                fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span>{{ feature }}</span>
                    </li>
                </ul>
            </div>

            <div class="mt-8 flex flex-col gap-3 md:flex-row md:justify-end">
                <button class="btn btn-outline w-full md:w-auto" @click="closePlanModal()" :disabled="submitting">
                    تراجع
                </button>
                <button
                    class="btn btn-primary w-full md:w-auto"
                    :disabled="submitting"
                    @click="confirmSubscription"
                >
                    <span v-if="submitting" class="loading loading-spinner loading-sm"></span>
                    <span v-else>تأكيد الاشتراك</span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, reactive } from 'vue'
import axios from 'axios'
import { useNotification } from '@kyvg/vue3-notification'
import { useAuthStore } from '@/stores/auth'
  import { useHead } from '@unhead/vue'

  const auth = useAuthStore()
const { notify } = useNotification()

const plans = ref([])
const subscription = ref(null)
const loading = ref(false)
const submitting = ref(false)
const pendingPlanId = ref(null)
const showConfirmModal = ref(false)
const selectedPlan = ref(null)
const modalOption = ref(null)
const selectedOptions = reactive({})
    
  useHead({
    title: 'الاشتراك والباقات',
    meta: [
      { name: 'description', content: 'الاشتراك والباقات' },
    ],
  })
    
const fetchPlans = async () => {
    loading.value = true
    try {
        const { data } = await axios.get('/api/subscription/plans')
        plans.value = data.data || []
        subscription.value = data.current_subscription || null
        initializeSelections(true)
    } catch (error) {
        notify({
            type: 'error',
            text: error.response?.data?.message || 'حدث خطأ أثناء تحميل الباقات. حاول مرة أخرى.',
        })
        console.error(error)
    } finally {
        loading.value = false
    }
}

const currentPlanId = computed(() => subscription.value?.plan_id ?? null)

const getSelectedOption = (plan) => {
    if (!plan) {
        return null
    }

    return plan.options?.find(option => selectedOptions[plan.key] === option.id) ?? plan.options?.[0] ?? null
}

const optionClasses = (planKey, optionId) => (
    selectedOptions[planKey] === optionId
        ? 'border-primary-500 bg-primary-50 text-primary-700 shadow-sm'
        : 'border-gray-200 hover:border-primary-200 hover:bg-primary-50/40 text-gray-600'
)

const isCurrentPlanGroup = (plan) => plan?.options?.some(option => option.id === currentPlanId.value)

const planCardClasses = (plan) => [
    'border rounded-3xl bg-white p-6 shadow-sm flex flex-col gap-4 h-full transition-all duration-200',
    isCurrentPlanGroup(plan)
        ? 'border-primary-500 ring-2 ring-primary-200'
        : 'border-gray-200 hover:border-primary-400 hover:ring-1 hover:ring-primary-100',
]

const initializeSelections = (force = false) => {
    plans.value.forEach((plan) => {
        const matched = plan.options?.find(option => option.id === currentPlanId.value)

        if (matched) {
            selectedOptions[plan.key] = matched.id
            return
        }

        if (force || !selectedOptions[plan.key]) {
            selectedOptions[plan.key] = plan.options?.[0]?.id ?? null
        }
    })
}

const periodicityLabel = (type) => {
    if (!type) {
        return 'مدى الحياة'
    }

    switch (String(type).toLowerCase()) {
    case 'month':
        return 'شهري'
    case 'year':
        return 'سنوي'
    case 'week':
        return 'أسبوعي'
    case 'day':
        return 'يومي'
    default:
        return type
    }
}

const formatPrice = (price) => {
    if (!price) {
        return 'مجانية'
    }

    return `${Number(price).toLocaleString('ar-SA')} ر.س`
}

const openPlanModal = (plan) => {
    if (isCurrentPlanGroup(plan)) {
        return
    }

    const option = getSelectedOption(plan)

    if (!option) {
        return
    }

    selectedPlan.value = plan
    modalOption.value = option
    pendingPlanId.value = null
    showConfirmModal.value = true
}

const closePlanModal = (force = false) => {
    if (submitting.value && !force) {
        return
    }

    showConfirmModal.value = false
    selectedPlan.value = null
    modalOption.value = null
    pendingPlanId.value = null
}

const confirmSubscription = async () => {
    if (!selectedPlan.value || !modalOption.value || submitting.value) {
        return
    }

    submitting.value = true
    pendingPlanId.value = modalOption.value.id

    try {
        const { data } = await axios.post('/api/subscription', {
            plan_id: modalOption.value.id,
        })

        subscription.value = data.subscription || null

        await auth.setAuth()

        notify({
            type: 'success',
            text: data.message || 'تم تحديث اشتراكك بنجاح.',
        })

        initializeSelections(true)
        closePlanModal(true)
    } catch (error) {
        const errors = error.response?.data?.errors
        const message = error.response?.data?.message

        notify({
            type: 'error',
            text: errors ? Object.values(errors)[0][0] : message || 'حدث خطأ أثناء تفعيل الباقة. حاول لاحقاً.',
        })

        console.error(error)
    } finally {
        submitting.value = false
        pendingPlanId.value = null
    }
}

onMounted(fetchPlans)
</script>