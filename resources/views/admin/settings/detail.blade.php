<x-admin::layout>
    <x-admin::container :title="data_get(config('setting-list.'.$slug), 'name')" :backRoute="route('admin.settings.index')">
        <livewire:dynamic-component :is="data_get(config('setting-list.'.$slug), 'components.index')" />
    </x-admin::container>
</x-admin::layout>

<?php 
 
new 
#[\Livewire\Attributes\Title('تفاصيل الإعدادات')]
class extends \Livewire\Volt\Component {
    public $slug;
 
}; ?>


