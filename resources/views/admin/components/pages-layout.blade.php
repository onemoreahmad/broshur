<x-admin::layout>
   <ui:navbar class="!bg-primary-800 !p-1" classes="gap-x-1 overflow-x-auto">
        <ui:button icon="file-text" variant="ghost" href="{{ route('admin.pages.index') }}" wire:navigate label="صفحات الموقع" class="rounded-md text-white" wire:current.exact="!bg-white !text-primary-800" />
        <ui:button icon="palette" variant="ghost" href="{{ route('admin.pages.design') }}" wire:navigate label="التصميم" class="rounded-md text-white" wire:current="!bg-white !text-primary-800 " />
        {{-- <ui:button icon="settings" variant="ghost" href="{{ route('admin.blog.settings') }}" wire:navigate label="إعدادات المدونة" class="rounded-md text-white" wire:current="!bg-white !text-primary-800" /> --}}
    </ui:navbar> 
 
    {{$slot}}
</x-admin::layout> 