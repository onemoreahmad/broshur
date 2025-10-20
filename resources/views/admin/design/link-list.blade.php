<x-admin::mainbox :title="$title" :subtitle="$subtitle">
    <x-slot:icon>
        <ui:icon :name="$icon" class="!w-7 !h-7 text-gray-500 p-0.5" />
    </x-slot:icon>

    <div class="flex flex-col gap-y-2 mb-5" wire:sortable="updateItemsOrder" wire:sortable.options="{ animation: 100, ghostClass:'bg-blue-200' }">
    @forelse ($links as $link)
        <div class="bg-gray-100 rounded-xl  border border-gray-200" wire:key="link-{{ data_get($link, 'id') }}" id="item{{ data_get($link, 'id') }}" wire:sortable.item="{{ data_get($link, 'id') }}">
            <div class="flex items-center justify-between gap-x-2">
                <div class="flex items-center cursor-pointer p-3 w-full gap-x-2" wire:click="setCurrentLink({{ data_get($link, 'id') }})"> 
                    <ui:badge :text="$type" wire:sortable.handle class="text-xs font-normal !hover:bg-gray-300  !bg-gray-200 !text-gray-600" />
                    <ui:heading size="sm" class="font-normal !m-0"> {{ data_get($link, 'name') }} </ui:heading>
                </div>
                <div class="flex items-center gap-x-px pe-2">
                    <ui:button icon="trash" title="حذف" wire:click="deleteLink({{ data_get($link, 'id') }})" wire:confirm="هل أنت متأكد من حذف هذا الرابط؟" variant="ghost" class="text-gray-400 hover:bg-transparent hover:text-red-500 w-7" />
                    <ui:button icon="copy" title="نسخ" wire:click="duplicateLink({{ data_get($link, 'id') }})"  variant="ghost" class="text-gray-400 hover:bg-transparent hover:text-gray-500 w-7" />
                    <ui:button icon="arrows-move-vertical" title="ترتيب"  variant="ghost" class="text-gray-400 hover:bg-transparent hover:text-gray-500 w-7 cursor-move" wire:sortable.handle />
                </div>
            </div>
    
            @if($currentLink?->id == data_get($link, 'id'))
                <div class="flex flex-col gap-y-1 p-4 border-t border-gray-200 bg-gray-50/50 rounded-b-xl">
                   
                    @if($type == 'social-link')
                    <ui:select name="currentLinkName" label="النوع" name="currentLinkName" :options="__('socialNetworks')" />
                    @else
                    <ui:input name="currentLinkName" label="اسم الرابط" name="currentLinkName" />
                    @endif

                    <ui:input name="currentLinkLink" label="الرابط" dir="ltr" placeholder="https://example.com" name="currentLinkLink" />
                    <ui:toggle name="currentLinkActive" label="منشور" name="currentLinkActive" />
                    <ui:button label="حفظ" wire:click="saveLink" wire-target="saveLink" icon="device-floppy" />
                </div>
            @endif

        </div>
    @empty
        <ui:callout text="لا توجد بروفايل" color="blue" icon="alert-circle" class="text-xs text-blue-800" />
        
    @endforelse
    </div>
    <div class="mb-3">
        <ui:button icon="plus" wire:click="addLink" variant="secondary" label="أضف رابط" />
    </div>
</x-admin::mainbox>

<?php 
 
use App\Models\Link;

new 
#[\Livewire\Attributes\Title('إدارة البروفايل')]
class extends \Livewire\Volt\Component {

    public $currentLink;
    public $currentLinkName;
    public $currentLinkLink;
    public $currentLinkActive;
    public $type = 'link';
    public $icon = 'link';
    public $title = 'البروفايل الرئيسية';
    public $subtitle = 'أضف البروفايل المهمة لأعمالك ومشاريعك وطرق التواصل بك.';
 
    public function addLink() {
        $entry = new Link();
        $entry->tenant_id = currentTenant('id');
        $entry->name = $this->type == 'social-link' ? 'instagram' : '';
        $entry->link = '';
        $entry->type = $this->type;
        $entry->active = true;
        $entry->save(); 
 
        $this->setCurrentLink($entry->id);
    }

    public function setCurrentLink($id) {
        if($this->currentLink?->id == $id) {
            $this->currentLink = null;
            $this->currentLinkName = null;
            $this->currentLinkLink = null;
            $this->currentLinkActive = false;
            return;
        }

        $this->currentLink = Link::where('tenant_id', currentTenant('id'))->where('id', $id)->first() ?? null;
 
        $this->currentLinkName = data_get($this->currentLink, 'name');
        $this->currentLinkLink = data_get($this->currentLink, 'link');
        $this->currentLinkActive = (boolean) data_get($this->currentLink, 'active');
    }
 
    public function saveLink() {
        $this->currentLink->name = $this->currentLinkName;
        $this->currentLink->link = $this->currentLinkLink;
        $this->currentLink->active = $this->currentLinkActive;
        $this->currentLink->save();

        $this->dispatch('notify', text: 'تم تحديث الرابط بنجاح');
        //$this->dispatch('space-updated', space: auth()->user()->username);
        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');
    }

    public function deleteLink($id) {
        $entry = Link::where('tenant_id', currentTenant('id'))->where('id', $id)->first();
        $entry->delete();
 
        $this->dispatch('notify', text: 'تم حذف الرابط بنجاح');
        //$this->dispatch('space-updated', space: auth()->user()->username);
        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');
    }

    public function duplicateLink($id) {
        $entry = Link::where('tenant_id', currentTenant('id'))->where('id', $id)->first();
        $entry->duplicate();
        $this->dispatch('notify', text: 'تم نسخ الرابط بنجاح');
        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');
    }

    public function updateItemsOrder($items)
    {
        foreach ($items as $item) {
            Link::where('id', $item['value'])->update(['sort' => $item['order']]);
        }
         
        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');
    }
  
    public function with() {
        return [
            'links' => Link::where('tenant_id', currentTenant('id'))->where('type', $this->type)->orderBy('sort')->get(), 
        ];
    }

}; ?>


