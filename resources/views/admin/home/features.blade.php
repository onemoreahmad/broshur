<div>
    <ui:callout icon="info-circle" color="blue" inline>
        <x-slot name="text"> أزرار الإجراءات الرئيسية، يمكنك إضافة أكثر من زر لدفع الزائر لإتخاذ إجراء مثل شراء أو حجز خدمة أو التواصل معك.</x-slot>
    </ui:callout>
 
    <div class="mt-5 max-w-3xl">
         form .. 
    </div>
</div>

<?php
use App\Models\Block;
use Livewire\Attributes\Renderless;
 
new class extends \Livewire\Volt\Component {
   
    public $radio;
  
    public function mount() {
  
        $block =  Block::where('tenant_id', currentTenant('id'))->where('name', 'faq')->first();
        
        $this->radio = data_get($block, 'config.radio', '');
    }
  
    public function rules() {
        $rules = [
            'faq' => 'required|array',
        ];
  
        return $rules;
    }

    public function save($showMessage = true) {   
        $this->validate();
   
        $this->dispatch('notify', type:'success', text:'تم حفظ التعديلات بنجاح'); 
    }

    public function saveAndNext() {
        $this->save();
        $this->dispatch('setTab', tab: 'cta');
    }

    #[Renderless]
    public function autoSave() {
        $this->save(false);
    }

    function placeholder() {
        return loadingIcon();
    }
}; ?>