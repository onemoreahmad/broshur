<div>
    <ui:callout icon="info-circle" color="blue" text="قائمة الحسابات الإجتماعية التي يمكنك إضافها لعرضها في الهيدر والصفحة الرئيسية." />
 
    <div class="mt-5 max-w-3xl">
        <form wire:submit="save" class="flex flex-col gap-y-1">
  
                <ui:item-list :items="$items" addLabel="أضف حساب إجتماعي" :fields="['name' => 'twitter', 'url' => '']">
                    <ui:select x-model="item.name" :options="__('socialNetworks')" placeholder="مثال: الفيسبوك" label="الشبكة" />
                    <ui:input x-model="item.url" placeholder="https://x.com/yourhandle" dir="ltr" label="الرابط" />
                </ui:item-list>
                <pre x-text="JSON.stringify($items, null, 2)"></pre>
            

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
        $this->items = data_get(tenant(), 'meta.socialLinks', [
            [
                'name' => 'twitter',
                'url' => ''
            ],
        ]);
    }
  
    public function rules() {
        $rules = [
            'items' => 'nullable|array',
        ];
  
        return $rules;
    }

    public function save() {   
        $this->validate();
 
   
        tenant()->meta->set('socialLinks', $this->items);
        tenant()->save();

        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');

        $this->dispatch('notify', type:'success', text:'تم حفظ التعديلات بنجاح'); 
    }
 
    function placeholder() {
        return loadingIcon();
    }
}; ?>