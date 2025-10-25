<div>
    <ui:callout icon="info-circle" color="blue" text="القسم الرئيسي سيجالري معرض الصور، يعمل على عرض الصور الخاصة بالشركة والمنتجات التي تقدمها." />
 
    <div class="mt-5 max-w-3xl">
        <form wire:submit="save" id="header-form" class="flex flex-col gap-y-1">

            <ui:toggle name="active" label="تفعيل القسم" :live="true"   />

            @if($active)
                <ui:field name="image" label="الصورة البارزة"  class="flex flex-col">
                    <ui:uploader wire:model="image" :file="$image"  />
                </ui:field>
                <ui:input name="title" label="العنوان الأساسي" placeholder="مثال: أنشئ بروشور لأعمالك بدقائق .." />
                <ui:textarea name="subtitle" label="العنوان الفرعي" placeholder="عنوان فرعي يضيف ويشرح العنوان الأساسي"   />
                 
            @endif

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

new class extends \Livewire\Volt\Component {
    use WithFileUploads;

    public $block;
    public $title;
    public $subtitle;
    public $image;
    public $active = true;

    public function mount() {
        $this->block =  Block::firstOrCreate(['name'=> 'gallery']);    

        $this->title = data_get($this->block, 'config.title.' . app()->getLocale());
        $this->subtitle = data_get($this->block, 'config.subtitle.' . app()->getLocale());
        $this->image = data_get($this->block, 'config.image') ? \Storage::url(data_get($this->block, 'config.image')) : null;
        $this->active = data_get($this->block, 'active', true);
    }
  
    public function rules() {
        $rules = [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'active' => 'required|boolean',
        ];

        if ($this->image instanceof TemporaryUploadedFile) {
            $rules['image'] = 'image|max:5048';  
        }
  
        return $rules;
    }

    public function save($showMessage = true) {   
        $this->validate();

        $this->block->active = $this->active;
        $this->block->config->set('title.' . app()->getLocale(), $this->title);
        $this->block->config->set('subtitle.' . app()->getLocale(), $this->subtitle);

        if( !is_string($this->image) && $this->image) {
            $this->block->config->set('image', $this->image->store('image'));
        }

        if(!$this->image) {
            $this->block->config->set('image', null);
        }

        $this->block->save();

        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');

        $this->dispatch('notify', type:'success', text:'تم حفظ التعديلات بنجاح'); 
    }
 

    function placeholder() {
        return loadingIcon();
    }
}; ?>