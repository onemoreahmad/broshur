<div>
    <ui:callout icon="info-circle" color="blue" text="القسم الرئيسي Hero، يعمل على لفت انتباه الزائر بعنوان تسويقي جذاب لدفعه لإتخاذ إجراء وكسب انطباع ايجابي." />
 
    <div class="mt-5 max-w-3xl">
        <form wire:submit="save" id="header-form" class="flex flex-col gap-y-1">

            <ui:toggle name="active" label="تفعيل القسم" :live="true"   />

            @if($active)
                <ui:field name="image" label="الصورة البارزة"  class="flex flex-col">
                    <ui:uploader wire:model="image" :file="$image"  />
                </ui:field>
                <ui:input name="title" label="العنوان الأساسي" placeholder="مثال: أنشئ بروشور لأعمالك بدقائق .." />
                <ui:textarea name="subtitle" label="العنوان الفرعي" placeholder="عنوان فرعي يضيف ويشرح العنوان الأساسي"   />
                
                <ui:toggle name="whatsappButton" label="زر محادثة واتساب" :live="true"   />

                @if($whatsappButton)
                    <ui:input name="whatsappNumber" label="رقم واتساب" placeholder="9665xxxxxxxx" dir="ltr" />
                @endif

                <ui:toggle name="contactButton" label="زر اتصل بنا"   />
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
    public $whatsappButton;
    public $contactButton;
    public $whatsappNumber;
    public $active = true;

    public function mount() {
        $this->block =  Block::firstOrCreate(['name'=> 'hero']);    

        $this->title = data_get($this->block, 'config.title.' . app()->getLocale());
        $this->subtitle = data_get($this->block, 'config.subtitle.' . app()->getLocale());
        $this->image = data_get($this->block, 'config.image') ? \Storage::url(data_get($this->block, 'config.image')) : null;
        $this->whatsappButton = data_get($this->block, 'config.whatsappButton', true);
        $this->contactButton = data_get($this->block, 'config.contactButton', true);
        $this->whatsappNumber = data_get($this->block, 'config.whatsappNumber', '');
        $this->active = data_get($this->block, 'active', true);
    }
  
    public function rules() {
        $rules = [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'whatsappButton' => 'required|boolean',
            'contactButton' => 'required|boolean',
            'whatsappNumber' => 'nullable|string',
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
        $this->block->config->set('whatsappButton', $this->whatsappButton);
        $this->block->config->set('contactButton', $this->contactButton);
        $this->block->config->set('whatsappNumber', $this->whatsappNumber);

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