<template>
<div class="max-w-7xl mx-auto py-6 flex flex-col gap-y-4 px-2 md:px-0">
	<div class="rounded-lg bg-blue-50 p-2 border border-gray-200  ">
		<div class="flex items-center">
			<div class="flex-shrink-0 ms-2">
				<span>
					<svg class="text-blue-600/50 inline-block size-6 dark:text-gray-500"
						xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
						<path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
						<path d="M12 9h.01"></path>
						<path d="M11 12h1v4h1"></path>
					</svg>
				</span>
			</div>
			<div class="flex w-full px-2 items-center justify-between pt-1">
				<div>
					<p size="1" class="text-sm !text-blue-700">يمكنك نشر ومشاركة رابط البروشور من هنا.</p>
				</div>
				<div></div>
			</div>
		</div>
	</div>
	<div class="flex items-center gap-2 bg-gray-300/50 p-1 rounded-lg">
		<span>
			<svg class="text-gray-500 inline-block size-5 ms-2 dark:text-gray-500"
				xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
				<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
				<path d="M9 15l6 -6"></path>
				<path d="M11 6l.463 -.536a5 5 0 0 1 7.071 7.072l-.534 .464"></path>
				<path d="M13 18l-.397 .534a5.068 5.068 0 0 1 -7.127 0a4.972 4.972 0 0 1 0 -7.071l.524 -.463"></path>
			</svg>
		</span>
		<div class="text-gray-400 text-sm w-full bg-white p-2 px-3 rounded-lg border border-gray-200" dir="ltr">{{ auth?.tenant?.site_url }}</div>
		<button role="button" class="btn btn-soft"
         @click="copyToClipboard(auth?.tenant?.site_url)">
			<span>
				<svg class="size-5"
					xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
					<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
					<path d="M8 8m0 2a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2z"></path>
					<path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
				</svg>
			</span>
		</button>
       
		<a :href="auth?.tenant?.site_url" class="btn btn-primary hidden lg:flex" target="_blank">
			<span>
				<svg class="!h-5 !w-5 inline-block size-5 ltr:-ml-1 rtl:-mr-1"
					xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
					<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
					<path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
					<path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
				</svg>
			</span>
 
 
معاينة البروشور

    
			<span>
				<svg class="!h-5 !w-5 inline-block size-5 rtl:-ml-1 ltr:-mr-1"
					xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
					<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
					<path d="M7 7l10 10"></path>
					<path d="M16 7l-9 0l0 9"></path>
				</svg>
			</span>
		</a>
	</div>
	<div class="!block px-1 lg:!hidden">
		<a :href="auth?.tenant?.site_url" class="focus-visible:ring-ring focus-visible:ring-1 text-white cursor-pointer gap-2 h-9 inline-flex w-full bg-green-500 bg-primary-600 px-4 py-2 text-sm transition-all transition-colors duration-300 items-center justify-center whitespace-nowrap rounded-md hover:bg-green-600 hover:bg-primary-700 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none" icon:trailing="arrow-up-left" target="_blank">
			<span>
				<svg class="!h-5 !w-5 inline-block size-5 ltr:-ml-1 rtl:-mr-1 text-white"
					xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
					<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
					<path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
					<path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
				</svg>
			</span>


 
معاينة البروشور

    
			<span>
				<svg class="!h-5 !w-5 inline-block size-5 rtl:-ml-1 ltr:-mr-1 text-white"
					xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
					<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
					<path d="M7 7l10 10"></path>
					<path d="M16 7l-9 0l0 9"></path>
				</svg>
			</span>
		</a>
	</div>
	<div class="md:flex items-center bg-gray-50 p-2 rounded-lg" data-sentry-component="ShareCv" data-sentry-source-file="share-cv.tsx">
		<div class="grow">
			<div class="me-3 font-bold ms-1 mb-6 mt-2 md:mb-0 shrink-0 text-gray-500 flex items-center text-sm grow">
				<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
					xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 me-2" data-sentry-element="svg" data-sentry-source-file="share-cv.tsx">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" data-sentry-element="path" data-sentry-source-file="share-cv.tsx"></path>
				</svg>
                  مشاركة البروشور        
			</div>
			<div class="flex flex-col md:flex-row items-center gap-2 p-2 mt-4">
				<a :href="`https://api.whatsapp.com/send?text=${auth?.tenant?.site_url}`" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex w-full border-black/10 bg-white px-4 py-2 text-sm transition-all transition-colors border duration-300 items-center justify-center whitespace-nowrap rounded-md hover:bg-black/5 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none lg:w-auto" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="size-5"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
					واتساب
				</a>
				<a :href="`https://t.me/share/url?text=${auth?.tenant?.site_url}&amp;url=${auth?.tenant?.site_url}`" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex w-full border-black/10 bg-white px-4 py-2 text-sm transition-all transition-colors border duration-300 items-center justify-center whitespace-nowrap rounded-md hover:bg-black/5 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none lg:w-auto" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-telegram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4" /></svg>
					 تليجرام
 				</a>
				<a :href="`https://x.com/intent/tweet?url=${auth?.tenant?.site_url}&amp;text=${auth?.tenant?.name}`" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex w-full border-black/10 bg-white px-4 py-2 text-sm transition-all transition-colors border duration-300 items-center justify-center whitespace-nowrap rounded-md hover:bg-black/5 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none lg:w-auto" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-x"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4l11.733 16h4.267l-11.733 -16z" /><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" /></svg>
					X (تويتر)
				</a>
				<a :href="`https://www.facebook.com/sharer/sharer.php?u=${auth?.tenant?.site_url}`" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex w-full border-black/10 bg-white px-4 py-2 text-sm transition-all transition-colors border duration-300 items-center justify-center whitespace-nowrap rounded-md hover:bg-black/5 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none lg:w-auto" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
					 فيسبوك
				</a>
				<a :href="`https://www.linkedin.com/shareArticle?mini=true&amp;url=${auth?.tenant?.site_url}`" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex w-full border-black/10 bg-white px-4 py-2 text-sm transition-all transition-colors border duration-300 items-center justify-center whitespace-nowrap rounded-md hover:bg-black/5 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none lg:w-auto" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-brand-linkedin"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 11v5" /><path d="M8 8v.01" /><path d="M12 16v-5" /><path d="M16 16v-3a2 2 0 1 0 -4 0" /><path d="M3 7a4 4 0 0 1 4 -4h10a4 4 0 0 1 4 4v10a4 4 0 0 1 -4 4h-10a4 4 0 0 1 -4 -4z" /></svg>
					 لينكد ان
				</a>
				<a :href="`mailto:${auth?.tenant?.email}?&amp;subject=&amp;cc=&amp;bcc=&amp;body=${auth?.tenant?.site_url}`" class="focus-visible:ring-ring shadow-none focus-visible:ring-1 text-black/70 cursor-pointer gap-2 h-9 inline-flex w-full border-black/10 bg-white px-4 py-2 text-sm transition-all transition-colors border duration-300 items-center justify-center whitespace-nowrap rounded-md hover:bg-black/5 focus-visible:outline-none disabled:opacity-50 disabled:pointer-events-none lg:w-auto" target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail-forward"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" /><path d="M3 6l9 6l9 -6" /><path d="M15 18h6" /><path d="M18 15l3 3l-3 3" /></svg>
					البريد الإلكتروني
				</a>
				</div>
			</div>
		</div>
	</div>
</template>

<script setup>
import { useAuthStore } from '@/stores/auth';
import { useNotification } from '@kyvg/vue3-notification';

const auth = useAuthStore()
const { notify } = useNotification()

const copyToClipboard = async (text) => {
	try {
		await navigator.clipboard.writeText(text)
		notify({ type: "success", text: "تم نسخ رابط البروشور" })
	} catch (error) {
		console.error('Failed to copy:', error)
		notify({ type: "error", text: "فشل نسخ الرابط" })
	}
}
</script>