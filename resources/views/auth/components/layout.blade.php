<div class="min-h-screen bg-gray-200 flex flex-col items-center py-12 md:pt-32">
    <ui:brand logo="{{ asset('assets/images/logo.svg') }}" wire:navigate size="14" href="{{ route('site.home') }}" />
    <ui:brand name="{{ config('app.name') }}" href="{{ route('site.home') }}" wire:navigate class="text-3xl mt-4" />

    <ui:nav class="mt-12">
        <ui:button variant="ghost"  href="{{ route('auth.register') }}" icon="hexagon-plus" wire:navigate label="أنشئ بروشور جديد " wire:current="!bg-white" />
        <ui:button variant="ghost"  href="{{ route('auth.login') }}" icon="lock-open" wire:navigate label="تسجيل الدخول" wire:current="!bg-white" />
    </ui:nav>

    <div class="px-2 lg:px-0 mt-6 w-full mx-auto">
        <ui:card class="max-w-lg mx-auto p-4 sm:p-10 py-12 sm:py-16">
            <div class="text-center">
                @if ($title)
                    <ui:heading level="1" size="2xl">{{ $title ?? '' }}</ui:heading>
                @endif
                @if ($subtitle)
                    <ui:text>{{ $subtitle ?? '' }}</ui:text>
                @endif
            </div>

            <div class="mt-12">
                {{ $slot }}
            </div>
        </ui:card>
    </div>
</div>
 
