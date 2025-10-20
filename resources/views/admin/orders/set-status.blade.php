<div>
    <ui:button @click.prevent="$dispatch('openmodal', { modal: 'set-status' })" icon="pencil" label="{{ __('Change status') }}" />
 
    <ui:modal title="{{ __('Change status') }}" name="set-status" size="2xl">
        <ui:form wire:submit="submit">
            <ui:select name="status" :options="$statusList" label="{{ __('Status') }}" />
            <ui:textarea name="note"
                placeholder="{{ __('Write a note or reason about this status change (optional).') }}"
                label="{{ __('Note') }}" />
            <ui:toggle name="notifyClient" label="{{ __('Notify client ?') }}"
                info="{{ __('Send email and notify the user about this update.') }}" />

            <x-slot:footer>
                <ui:button type="submit" wire-target="submit" label="{{ __('Save') }}" />
            </x-slot>
        </ui:form>

    </ui:modal>
         
</div>

<?php

new class extends Livewire\Volt\Component {
    
    public $model;
    public $status;
    public $note;
    public $statusList;
    public $notifyClient = false;

    protected function rules()
    {
        return [
            'status' => 'required',
            'note' => 'nullable',
            // 'note' => 'nullable|required_if:status,custom',
        ];
    }

    public function mount()
    {
        $this->status = $this->model->status;
        $this->statusList = ['pending', 'processing', 'awaiting_payment', 'awaiting_fulfillment', 'awaiting_shipment', 'shipped', 'partially_shipped', 'awaiting_pickup', 'completed', 'cancelled', 'refunded', 'partially_refunded', 'custom', 'other', 'draft'];
    }

    public function submit()
    {
       
        $this->validate();
        
        $this->model->setStatus($this->status, $this->note);
        $this->dispatch('notify', text: __('Status has been updated successfully.'));
        $this->dispatch('closemodal');
        $this->dispatch('updateOrderDetail');
    }
}; ?>
