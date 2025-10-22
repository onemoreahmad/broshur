<div>
    <ui:callout icon="info-circle" color="blue" text="قائمة الأسئلة المتكررة، يمكنك إضافة أكثر من سؤال وإجابة لعرضها لعملائك المحتملين." />
 
    <div class="mt-5 max-w-3xl">
        <form wire:submit="save" class="flex flex-col gap-y-1">

            <ui:toggle name="active" label="تفعيل القسم" :live="true"   />

            @if($active)
                <ui:input name="title" label="العنوان الأساسي" placeholder="مثال: الأسئلة المتكررة" />
                <ui:textarea name="subtitle" label="العنوان الفرعي" placeholder="مثال: هنا قائمة بإجاباتنا على أكثر الأسئلة تكراراً، إذا لم تجد إجابة لسؤالك تواصل معنا في أي وقت."   />
            
                <ui:separator text="قائمة الأسئلة المتكررة" />

                <ui:item-list :items="$items" addLabel="أضف سؤال" :fields="['question' => [app()->getLocale() => ''], 'answer' => [app()->getLocale() => '']]">
                    <ui:textarea x-model="item.question.{{app()->getLocale()}}" placeholder="مثال: ما هي خدماتك؟" label="السؤال" />
                    <ui:textarea x-model="item.answer.{{app()->getLocale()}}" placeholder="مثال: نحن نقدم خدمات متكاملة لعملائنا بجودة عالية وبأسعار مناسبة." label="الإجابة" />
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
        $this->block =  Block::firstOrCreate(['name'=> 'faq']);    

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