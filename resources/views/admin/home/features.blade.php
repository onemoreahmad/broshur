<div>
    <ui:callout icon="info-circle" color="blue" text="قائمة المزايا الرئيسية، يمكنك إضافة أكثر من ميزة لعرضها لعملائك المحتملين." />
 
    <div class="mt-5 max-w-3xl">
        <form wire:submit="save" class="flex flex-col gap-y-1">

            <ui:toggle name="active" label="تفعيل القسم" :live="true"   />

            @if($active)
                <ui:input name="title" label="العنوان الأساسي" placeholder="مثال: المزايا الرئيسية" />
                <ui:textarea name="subtitle" label="العنوان الفرعي" placeholder="مثال: قائمة المزايا الرئيسية"   />
            
                <ui:separator text="قائمة المزايا" />

                <ui:item-list :items="$items" addLabel="أضف ميزة" :fields="['title' => [app()->getLocale() => ''], 'description' => [app()->getLocale() => '']]">
                    <ui:input x-model="item.title.{{app()->getLocale()}}" placeholder="مثال: الدعم 24/7" label="عنوان الميزة" />
                    <ui:textarea x-model="item.description.{{app()->getLocale()}}" placeholder="مثال: نحن نقدم دعم فني على مدار الساعة " label="وصف الميزة" />
                </ui:item-list>
            @endif

            <div class="flex mt-5 border-t border-gray-200 pt-3 border-dashed">
                <ui:button wire-target="save" label="حفظ " icon="check"  />
            </div>
        </form>
    </div>
</div>

<?php
use App\Models\Block;
 
new class extends \Livewire\Volt\Component {
   
    public $active = true;
    public $block;
    public $title;
    public $subtitle;
    public $items = [];

    public function mount() {
        $this->block =  Block::firstOrCreate(['name'=> 'features']);    

        $this->active = data_get($this->block, 'active', true);
        $this->title = data_get($this->block, 'config.title.' . app()->getLocale());
        $this->subtitle = data_get($this->block, 'config.subtitle.' . app()->getLocale());
        $this->items = data_get($this->block, 'config.items', []);
    }
  
    public function rules() {
        $rules = [
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'active' => 'required|boolean',
            'items' => 'nullable|array',
        ];
  
        return $rules;
    }

    public function save() {   
        $this->validate();
 
   
        $this->block->active = $this->active;
        $this->block->config->set('title.' . app()->getLocale(), $this->title);
        $this->block->config->set('subtitle.' . app()->getLocale(), $this->subtitle);
        $this->block->config->set('items', $this->items);
        $this->block->save();

        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');

        $this->dispatch('notify', type:'success', text:'تم حفظ التعديلات بنجاح'); 
    }
 
    function placeholder() {
        return loadingIcon();
    }
}; ?>