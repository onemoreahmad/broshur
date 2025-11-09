<template>
    <Container title="الاشتراك والباقات" subtitle="اختر الخطة المناسبة لعملك وابدأ بالاستفادة من مزايا بروشور.">
        <div class="space-y-6">
            <div
                v-if="subscription"
                class="rounded-xl border border-gray-200 bg-gray-50 px-6 py-4 text-sm text-primary-800 flex flex-col gap-1 md:flex-row md:items-center"
            >
                <div>
                    <span class="font-semibold">الباقة الحالية:</span>
                    <span>{{ subscription.plan_name || '—' }} {{ subscription.periodicity_type }}</span>
                </div>
                <div class="flex flex-wrap items-center gap-8 text-xs text-primary-700/80 mt-2 md:mt-0">
                    <span v-if="subscription.started_at" class="text-gray-500">تاريخ البداية: <b class="text-gray-900 inline-block me-2">{{ subscription.started_at }}</b>   </span>
                    <span v-if="subscription.expired_at" class="text-gray-500">تاريخ التجديد القادم: <b class="text-gray-900 inline-block me-2">{{ subscription.expired_at }}</b>   </span>
                    <span v-if="subscription.grace_days_ended_at" class="text-gray-500">نهاية فترة السماح: <b class="text-gray-900 inline-block me-2">{{ subscription.grace_days_ended_at }}</b>   </span>
                </div>
            </div>

            <div v-if="loading" class="flex justify-center py-20">
                <span class="loading loading-spinner loading-lg text-primary-500"></span>
            </div>

            <div v-else>
                <div class="grid gap-6 sm:grid-cols-2 md:grid-cols-3">
                    <article
                        v-for="plan in plans"
                        :key="plan.key"
                        :class="planCardClasses(plan)"
                    >
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-center gap-3">
                                <div
                                    :class="[
                                        'size-12 rounded-2xl flex items-center justify-center text-white p-2',
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
                                class="rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold text-primary-600"
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

            <div v-if="requiresPayment" class="mt-6 space-y-4 w-full">
                <!-- <div class="rounded-2xl border border-primary-100 bg-primary-50/70 p-4 text-sm text-primary-700">
                    <p>سيتم إكمال الاشتراك بعد نجاح عملية الدفع.</p>
                    <p class="mt-1 font-medium">
                        المبلغ المستحق: {{ formatPrice(modalOption?.price) }}
                        <span>
                            / {{ periodicityLabel(modalOption?.periodicity_type) }}
                        </span>
                    </p>
                </div> -->

                <div
                    :id="paymentFormId"
                    :key="paymentFormKey"
                    class="rounded-2xl border border-gray-200 bg-white p-4 !w-full"
                     
                ></div>

                <p v-if="paymentError" class="text-sm text-red-500">{{ paymentError }}</p>
            </div>

            <div class="mt-8 flex flex-col gap-3 md:flex-row md:justify-end">
                 
                <button
                    v-if="!requiresPayment"
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
import { ref, computed, onMounted, reactive, watch, nextTick, onUnmounted } from 'vue'
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

const getMetaContent = (name) => {
    if (typeof document === 'undefined') {
        return ''
    }

    const meta = document.head?.querySelector(`meta[name="${name}"]`)

    return meta?.content?.trim() || ''
}

const publishableKey =
    getMetaContent('moyasar-publishable-key') ||
    import.meta.env?.VITE_MOYASAR_PUBLISHABLE_KEY ||
    (typeof window !== 'undefined' ? window.moyasarPublishableKey : '') ||
    ''

const callbackUrl =
    getMetaContent('moyasar-callback-url') ||
    import.meta.env?.VITE_MOYASAR_CALLBACK_URL ||
    (typeof window !== 'undefined' ? window.moyasarCallbackUrl : '') ||
    ''

const MOYASAR_SCRIPT_SRC = 'https://cdn.moyasar.com/mpf/1.12.0/moyasar.js'
const MOYASAR_STYLES_SRC = 'https://cdn.moyasar.com/mpf/1.12.0/moyasar.css'

const paymentError = ref(null)
const moyasarReady = ref(false)
const paymentFormKey = ref(0)
const paymentFormId = 'moyasar-payment-form'
const moyasarInstance = ref(null)

const requiresPayment = computed(() => Number(modalOption.value?.price ?? 0) > 0)
const amountInHalala = computed(() => {
    const price = Number(modalOption.value?.price ?? 0)

    if (!Number.isFinite(price) || price <= 0) {
        return 0
    }

    return Math.round(price * 100)
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
        ? 'border-primary-500 bg-primary-50 text-primary-700 p-2'
        : 'border-gray-200 hover:border-primary-200 hover:bg-primary-50/40 text-gray-600'
)

const isCurrentPlanGroup = (plan) => plan?.options?.some(option => option.id === currentPlanId.value)

const planCardClasses = (plan) => [
    'border rounded-3xl bg-white p-6 flex flex-col gap-4 h-full transition-all duration-200',
    isCurrentPlanGroup(plan)
        ? 'border-primary-500 ring-2 ring-primary-200'
        : 'border-gray-200 hover:border-primary-400X XXhover:ring-1 hover:ring-primary-100',
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

const paymentDescription = computed(() => {
    if (!selectedPlan.value) {
        return 'اشتراك بروشور'
    }

    const periodicityText = modalOption.value?.periodicity_type
        ? periodicityLabel(modalOption.value.periodicity_type)
        : 'مدى الحياة'

    return `اشتراك ${selectedPlan.value.name} - ${periodicityText}`
})

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
    paymentError.value = null
    moyasarReady.value = false
    showConfirmModal.value = true
}

const cleanupPayment = (resetKey = true) => {
    if (moyasarInstance.value && typeof moyasarInstance.value.destroy === 'function') {
        try {
            moyasarInstance.value.destroy()
        } catch (error) {
            console.warn('Failed to destroy Moyasar instance', error)
        }
    }

    moyasarInstance.value = null
    moyasarReady.value = false
    paymentError.value = null
    if (resetKey) {
        paymentFormKey.value += 1
    }
}

const handlePaymentError = (error, isInitialization = false) => {
    submitting.value = false

    let message = ''

    if (error) {
        if (typeof error === 'string') {
            message = error
        } else if (error?.message) {
            message = error.message
        } else if (error?.detail) {
            message = error.detail
        } else if (error?.response?.data?.message) {
            message = error.response.data.message
        }
    }

    if (!message) {
        message = isInitialization
            ? 'تعذر تحميل بوابة الدفع. حاول مرة أخرى.'
            : 'تعذر إكمال عملية الدفع. يرجى التحقق من البيانات والمحاولة مجدداً.'
    }

    paymentError.value = message
    console.error(error)
}

const loadMoyasarAssets = () => {
    if (typeof window === 'undefined') {
        return Promise.reject(new Error('Window is not available'))
    }

    if (window.Moyasar) {
        return Promise.resolve(window.Moyasar)
    }

    if (!document.querySelector(`link[href="${MOYASAR_STYLES_SRC}"]`)) {
        const link = document.createElement('link')
        link.rel = 'stylesheet'
        link.href = MOYASAR_STYLES_SRC
        document.head.appendChild(link)
    }

    if (window.__moyasarLoader) {
        return window.__moyasarLoader
    }

    window.__moyasarLoader = new Promise((resolve, reject) => {
        const script = document.createElement('script')
        script.src = MOYASAR_SCRIPT_SRC
        script.async = true
        script.onload = () => resolve(window.Moyasar)
        script.onerror = (event) => {
            script.remove()
            window.__moyasarLoader = null
            reject(event)
        }

        document.head.appendChild(script)
    })

    return window.__moyasarLoader
}

const preparePaymentForm = async () => {
    if (!showConfirmModal.value || !requiresPayment.value) {
        return
    }

    const key = typeof publishableKey === 'string' ? publishableKey.trim() : ''

    if (!key) {
        paymentError.value = 'مفتاح بوابة الدفع غير مهيأ. يرجى التواصل مع الدعم.'
        return
    }

    if (amountInHalala.value <= 0) {
        paymentError.value = 'قيمة الاشتراك غير صالحة للدفع.'
        return
    }

    cleanupPayment(false)

    paymentError.value = null
    moyasarReady.value = false
    paymentFormKey.value += 1

    await nextTick()

    const formElement = document.getElementById(paymentFormId)

    if (!formElement) {
        paymentError.value = 'تعذر تهيئة نموذج الدفع. حاول مرة أخرى.'
        return
    }

    try {
        const Moyasar = await loadMoyasarAssets()

        if (!Moyasar) {
            paymentError.value = 'تعذر تحميل بوابة الدفع. حاول مرة أخرى.'
            return
        }

        const options = {
            element: formElement,
            amount: amountInHalala.value,
            currency: 'SAR',
            description: paymentDescription.value,
            publishable_api_key: key,
            methods: ['creditcard', 'mada'],
            metadata: {
                plan_id: modalOption.value?.id,
                plan_key: selectedPlan.value?.key,
            },
            on_completed: async (payment) => {
                await finalizeSubscription(payment)
            },
            on_failure: (error) => {
                handlePaymentError(error)
            },
            on_error: (error) => {
                handlePaymentError(error)
            },
            on_cancel: () => {
                submitting.value = false
            },
            on_canceled: () => {
                submitting.value = false
            },
        }

        if (callbackUrl) {
            options.callback_url = callbackUrl
        }

        moyasarInstance.value = Moyasar.init(options)
        moyasarReady.value = true
    } catch (error) {
        handlePaymentError(error, true)
    }
}

const submitPaymentForm = () => {
    const form = document.getElementById(paymentFormId)

    if (!form) {
        paymentError.value = 'تعذر العثور على نموذج الدفع.'
        return
    }

    if (!moyasarReady.value) {
        paymentError.value = 'بوابة الدفع قيد التهيئة. يرجى الانتظار لحظات.'
        return
    }

    paymentError.value = null

    if (typeof form.requestSubmit === 'function') {
        form.requestSubmit()
        return
    }

    form.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }))
}

const finalizeSubscription = async (payment = null) => {
    if (!modalOption.value) {
        return
    }

    submitting.value = true
    pendingPlanId.value = modalOption.value.id

    try {
        const payload = {
            plan_id: modalOption.value.id,
        }

        if (payment?.id) {
            payload.payment_id = payment.id
        }

        const { data } = await axios.post('/api/subscription', payload)

        subscription.value = data.subscription || null

        await auth.setAuth()

        notify({
            type: 'success',
            text: data.message || 'تم تحديث اشتراكك بنجاح.',
        })

        initializeSelections(true)
        paymentError.value = null
        closePlanModal(true)
    } catch (error) {
        const errors = error.response?.data?.errors
        const message = error.response?.data?.message
        const firstError = errors ? Object.values(errors)[0][0] : null
        const text = firstError || message || 'حدث خطأ أثناء تفعيل الباقة. حاول لاحقاً.'

        notify({
            type: 'error',
            text,
        })

        if (requiresPayment.value) {
            paymentError.value = text
        }

        console.error(error)
    } finally {
        submitting.value = false
        pendingPlanId.value = null
    }
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

    if (requiresPayment.value) {
        submitPaymentForm()
        return
    }

    await finalizeSubscription()
}

watch(
    () => showConfirmModal.value,
    async (visible) => {
        if (visible && requiresPayment.value) {
            await preparePaymentForm()
        }

        if (!visible) {
            cleanupPayment()
        }
    },
)

watch(
    () => modalOption.value?.id,
    async () => {
        if (!showConfirmModal.value) {
            return
        }

        if (requiresPayment.value) {
            await preparePaymentForm()
        } else {
            cleanupPayment()
        }
    },
)

onMounted(fetchPlans)
onUnmounted(cleanupPayment)
</script>