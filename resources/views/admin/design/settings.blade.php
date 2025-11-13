<div>
    <x-ui::form wire:submit="submit" id="catalog-info-form" formClass="flex flex-col gap-y-1">
        <ui:field name="logo" label="الشعار"  class="flex flex-col">
                <ui:uploader wire:model="logo" :file="$logo" mode="profile" />
        </ui:field>

        <ui:input name="name" label="الاسم" placeholder="الاسم " width="w-full" />
        <ui:input name="slogan" label="الوصف" placeholder="مثال: Just do it ✔" width="w-full" />

        <x-slot:footer>
            <ui:button wire-target="submit" label="حفظ" icon="device-floppy" />
        </x-slot>
    </x-ui::form>
</div>


<?php
use App\Models\Setting;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Catalog\Media\Models\Media;

new class extends \Livewire\Volt\Component {
    use WithFileUploads;

    public $setting;
    public $name;
    public $slogan;
    public $handle;
    public $logo;

    #[\Livewire\Attributes\On('tenant-logo-updated')]
    function mount()
    {
        $this->setting = Setting::where('name', 'settings')->firstOrCreate([
            'name' => 'settings',
            'app' => 'link-in-bio',
        ]);
 
        $this->name =  data_get($this->setting, 'config.name') ?? data_get(currentTenant(), 'name');
        $this->slogan =  data_get($this->setting, 'config.slogan.' . app()->getLocale()) ?? currentTenant()->slogan;
        $this->handle = data_get($this->setting, 'config.handle') ?? data_get(currentTenant(), 'handle');
        $this->logo = data_get($this->setting, 'config.logo') ?? data_get(currentTenant(), 'meta.logo');

        $this->js('document.getElementById("linkat-iframe").contentWindow.location.reload();');
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
 
        $this->setting->config->set('name', $this->name);
        $this->setting->config->set('handle', $this->handle);
        $this->setting->config->set('slogan.' . app()->getLocale(), $this->slogan);
        if( !is_string($this->logo) && $this->logo) {
            $this->setting->config->set('logo', $this->logo->store('logo', 'public'));
        }
        $this->setting->save();
        $this->js('document.getElementById("linkat-iframe").contentWindow.location.reload();');

        $this->dispatch('notify', text: __('Settings updated successfully.'));
    }
};
?>
