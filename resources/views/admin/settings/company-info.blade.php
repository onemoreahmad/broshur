<div>
    <x-admin::mainbox title="إعدادات الشركة" subtitle="تعديل اسم وشعار الشركة .">
        <x-slot:icon>
            <ui:icon name="id" class="!w-7 !h-7 text-gray-500 p-0.5" />
        </x-slot:icon>

        <ui:form wire:submit="submit" id="catalog-info-form" formClass="flex flex-col gap-y-1">
            <ui:field name="logo" label="الشعار"  class="flex flex-col">
                <ui:uploader wire:model="logo" :file="$logo" mode="profile" />
            </ui:field>
            
            <ui:input name="name" label="الاسم التجاري" placeholder="مثال: وجيز، قوت .." width="w-full" />
            <ui:input name="slogan" label="الشعار النصّي" placeholder="مثال: Just do it ✔" width="w-full" />

            <x-slot:footer>
                <ui:button wire-target="submit" label="{{ __('Save') }}" />
            </x-slot>
        </ui:form>
 
    </x-admin::mainbox>
</div>

<?php

use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
 
new class extends \Livewire\Volt\Component {
    use WithFileUploads;

    public $tenant;
    public $name;
    public $slogan;
    public $domain;
    public $logo;
    public $currentLogo;

    #[\Livewire\Attributes\On('tenant-logo-updated')]
    function mount()
    {
        $this->tenant = currentTenant();
        $this->name = $this->tenant->name;
        $this->slogan = data_get($this->tenant->meta->slogan, app()->getLocale());
        $this->domain = $this->tenant->domain;
        //$this->logo = $this->tenant->meta->get('logo');
        $this->logo = $this->tenant->logo;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:2|max:255',
            // 'logo' => 'nullable|image|max:15024',
        ];
    }

    function submit()
    {
        $this->validate();

        $this->tenant->name = $this->name;
        $this->tenant->meta->set('slogan.' . app()->getLocale(), $this->slogan);
  
       if( !is_string($this->logo) && $this->logo) {
            //$this->tenant->meta->set('logo', $this->logo->store('logo'));
            $this->tenant->logo = $this->logo->store('logo');
        }
        
       /* if ($this->logo) {
            $path = $this->logo->storePublicly('media/' . $this->tenant->hashId .'-'.$this->tenant->handle .'/logo', 'spaces');
 
            $this->tenant->meta->set('logo.path', $path);
            $this->tenant->meta->set('logo.disk', 'spaces');
        } */

        $this->tenant->save();

        $this->dispatch('notify', text: __('Tenant updated successfully.'));
    }
};
?>
