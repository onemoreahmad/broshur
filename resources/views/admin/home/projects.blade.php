<div>
    <ui:callout icon="info-circle" color="blue" inline>
        <x-slot name="text"> أزرار الإجراءات الرئيسية، يمكنك إضافة أكثر من زر لدفع الزائر لإتخاذ إجراء مثل شراء أو حجز خدمة أو التواصل معك.</x-slot>
        {{-- <x-slot name="action" class="@md:h-full m-0!">
            <ui:button variant="primary" icon:trailing="arrow-left" wire-target="saveAndNext" class="cursor-pointer" wire:click="saveAndNext"> التالي </ui:button>
        </x-slot> --}}
    </ui:callout>
 
    <div class="mt-5 max-w-3xl">
        <form wire:submit="save" class="flex flex-col gap-y-6">
             
            <!-- Basic Information -->
            <div class="bg-gray-50 rounded-lg p-3">
              
 
            <ui:radio 
                name="radio" 
                label="الخدمة العسكرية" 
                width="w-full"
                :options="[
                    'yes' => 'نعم',
                    'no' => 'لا',
                    'hide' => 'إخفاء'
                ]"
            />
             
            </div>
 
            <div class="flex mt-5 border-t border-gray-200 pt-3 border-dashed">
                <ui:button 
                    wire-target="save" 
                    wire-action="submit" 
                    variant="primary" 
                    icon="check" 
                    type="submit" 
                    class="cursor-pointer"
                > 
                    حفظ التعديلات 
                </ui:button>
            </div>
        </form>
    </div>
</div>

<?php
use App\Models\Block;
use Livewire\Attributes\Renderless;
 
new class extends \Livewire\Volt\Component {
   
    public $radio;
  
    public function mount() {
  
        $block =  Block::where('tenant_id', currentTenant('id'))->where('name', 'cta')->first();
        
        $this->radio = data_get($block, 'config.radio', '');
    }
  
    public function rules() {
        $rules = [
            'radio' => 'required|string',
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