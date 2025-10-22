<div>
    <ui:callout icon="info-circle" color="blue" text="قائمة آراء وتقييمات العملاء، يمكنك إضافة التقييمات الخاصة بالعملاء لعرضها بالصفحة." />
 
    <div class="mt-5 max-w-3xl">
        <form wire:submit="save" class="flex flex-col gap-y-1">

            <ui:toggle name="active" label="تفعيل القسم" :live="true"   />

            @if($active)
                <ui:input name="title" label="العنوان الأساسي" placeholder="مثال: آراء العملاء" />
                <ui:textarea name="subtitle" label="العنوان الفرعي" placeholder="مثال: هنا قائمة بآراء العملاء على أكثر الخدمات تكراراً، إذا لم تجد آراء لخدمتك تواصل معنا في أي وقت."   />
            
                <ui:separator text="قائمة التقييمات" />

                <ui:item-list :items="$items" addLabel="أضف تقييم" :fields="['comment' => '', 'name' => '', 'email' => '', 'rating' => 5]">
                    <ui:textarea x-model="item.comment" placeholder="مثال: كانت الخدمة رائعة، والموظفين مهذبين ومتعاونين." label="التعليق" />
                    <ui:input x-model="item.name" placeholder="مثال: عبد الله خالد" label="الاسم" />
                    <ui:input x-model="item.email" dir="ltr" placeholder="example@gmail.com" label="البريد الإلكتروني" type="email" />
                    <ui:input x-model="item.rating" placeholder="5" label="التقييم" type="number" min="1" max="5" step="1" />
                    {{-- <ui:rating x-model="item.rating" placeholder="5" label="التقييم" type="number" min="1" max="5" step="1" /> --}}
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
        $this->block =  Block::firstOrCreate(['name'=> 'testimonials']);    

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