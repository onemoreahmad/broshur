<div>
    <ui:callout icon="info-circle" color="blue" inline>
        <x-slot name="text"> أزرار الإجراءات الرئيسية، يمكنك إضافة أكثر من زر لدفع الزائر لإتخاذ إجراء مثل شراء أو حجز خدمة أو التواصل معك.</x-slot>
        {{-- <x-slot name="action" class="@md:h-full m-0!">
            <rasm:button variant="primary" icon:trailing="arrow-left" wire-target="saveAndNext" class="cursor-pointer" wire:click="saveAndNext"> التالي </rasm:button>
        </x-slot> --}}
    </ui:callout>
 
    <div class="mt-5 max-w-3xl">
        <form wire:submit="save" class="flex flex-col gap-y-1">
            <ui:toggle name="whatsappButton" label="زر محادثة واتساب"   />

            @if($whatsappButton)
                <ui:input name="whatsappNumber" label="رقم واتساب" placeholder="9665xxxxxxxx" dir="ltr" />
            @endif

            <ui:toggle name="contactButton" label="زر اتصل بنا"   />
 
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
   
    public $block;
    public $whatsappButton;
    public $contactButton;
    public $whatsappNumber;
     
    public function mount() {
        $this->block =  Block::firstOrCreate(['name'=> 'cta']);
        
        $this->whatsappButton = data_get($this->block, 'config.whatsappButton', true);
        $this->contactButton = data_get($this->block, 'config.contactButton', true);
        $this->whatsappNumber = data_get($this->block, 'config.whatsappNumber', '');


    }
  
    public function rules() {
        $rules = [
            'whatsappButton' => 'required|boolean',
            'contactButton' => 'required|boolean',
            'whatsappNumber' => 'required|string',
        ];
  
        return $rules;
    }

    public function save($showMessage = true) {   
        $this->validate();

        $this->block->config->set('whatsappButton', $this->whatsappButton);
        $this->block->config->set('contactButton', $this->contactButton);
        $this->block->config->set('whatsappNumber', $this->whatsappNumber);
        $this->block->save();
   
        $this->dispatch('notify', type:'success', text:'تم حفظ التعديلات بنجاح'); 
        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');
    }
 
    function placeholder() {
        return loadingIcon();
    }
}; ?>