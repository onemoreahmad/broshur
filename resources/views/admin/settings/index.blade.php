<x-admin::layout>
<x-admin::container>
 
       {{-- @foreach(config('setting-list') as $key => $setting)
                <x-admin::setting-card :title="data_get($setting, 'name')" :description="data_get($setting, 'description')" :icon="asset(data_get($setting, 'icon'))" :slug="$key" />
            @endforeach --}}

                    <livewire:dynamic-component is="admin.settings.company-info" />

     
  
</x-admin::container>

</x-admin::layout>


<?php 
 
new 
#[\Livewire\Attributes\Title('الإعدادات')]
class extends \Livewire\Volt\Component {

}; ?>


