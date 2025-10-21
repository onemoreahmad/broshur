<div>
    <ui:callout icon="info-circle" color="blue" text="هيدر البروشور الرئيسي." />
  
    <div class="mt-5 max-w-3xl">
        <form wire:submit="save" id="header-form" class="flex flex-col gap-y-1">
           
            <ui:field name="logo" label="الشعار"  class="flex flex-col">
                <ui:uploader wire:model="logo" :file="$logo" mode="profile" />
            </ui:field>
            
            <ui:input name="name" label="اسم البروشور" placeholder="مثال: وجيز، قوت .." width="w-full" />
            <ui:input name="slogan" label="الشعار النصّي" placeholder="مثال: Just do it ✔" width="w-full" />
            
            <ui:field name="cover" label="صورة الغلاف"  class="flex flex-col">
                <ui:uploader wire:model="cover" :file="$cover"  />
            </ui:field>
            <div class="flex mt-5 border-t border-gray-200 pt-3 border-dashed">
                <ui:button wire-target="save" label="حفظ " icon="check"  />
            </div>
        </form>
 
    </div>
</div>

<?php
use App\Models\Block;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Renderless;
 
new class extends \Livewire\Volt\Component {
    use WithFileUploads;
 
    public $block;
    public $name;
    public $domain;
    public $tenant;
    public $slogan;
    public $logo;
    public $cover;

    public function mount() {
        $this->block =  Block::firstOrCreate(['name'=> 'header']);
        
        $this->tenant = currentTenant();
 
        $this->name = $this->tenant->name;
        $this->slogan = data_get($this->tenant->meta->slogan, app()->getLocale());
        $this->cover = data_get($this->block, 'config.cover') ? \Storage::url(data_get($this->block, 'config.cover')) : null;
        $this->domain = $this->tenant->domain;
        $this->logo = $this->tenant->logo;
    }
 

    public function rules() {
        $rules = [
            'name' => 'required|string|min:2|max:255',
        ];

        // Only validate image if a new image is being uploaded
        if ($this->logo instanceof TemporaryUploadedFile) {
            $rules['logo'] = 'image|max:5048';  
        }
 
        if ($this->cover instanceof TemporaryUploadedFile) {
            $rules['cover'] = 'image|max:5048';  
        }
 
        return $rules;
    }

    public function save($showMessage = true) {   
        $this->validate();
 
        // Update block
        $this->block->config->name = $this->name;
       
        // Update tenant
        $this->tenant->name = $this->name;
        $this->tenant->meta->set('slogan.' . app()->getLocale(), $this->slogan);
  
        if( !is_string($this->logo) && $this->logo) {
            $this->tenant->logo = $this->logo->store('logo');
        }
  
        if( !is_string($this->cover) && $this->cover) {
            $this->block->config->set('cover', $this->cover->store('cover'));
        }

        if(!$this->cover) {
            $this->block->config->set('cover', null);
        }

        if(!$this->logo) {
            $this->tenant->logo = null;
        }
 
        $this->tenant->save();
            $this->block->save();

        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');
 
        $this->dispatch('notify', type:'success', text:'تم حفظ التعديلات بنجاح'); 
    }
 

    #[Renderless]
    public function autoSave() {
        $this->save(false);
    }

    function placeholder() {
        return loadingIcon();
    }
}; ?>