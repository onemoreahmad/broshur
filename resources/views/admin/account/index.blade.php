<x-admin::layout>
    <x-admin::container>
        <x-admin::mainbox title="بيانات الحساب" subtitle="إدارة بيانات الحساب">
            <x-slot:icon>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                    <path d="M12 12a5 5 0 1 0 0-10 5 5 0 0 0 0 10Z" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                    <path opacity=".4" d="M20.59 22c0-3.87-3.85-7-8.59-7s-8.59 3.13-8.59 7" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </x-slot>

            <x-ui::form wire:submit="submit" formClass="flex flex-col gap-y-1">
                <ui:input name="name" label="{{ __('Name') }}" width="w-full" placeholder="{{ __('Name') }}" />
                <ui:input name="email" label="{{ __('Email') }}" width="w-full" placeholder="your@email.com" dir="ltr" />

                <x-slot:footer>
                    <ui:button wire-target="submit" label="{{ __('Save') }}" />
                </x-slot>
            </x-ui::form>
        </x-admin::mainbox>
    </x-admin::container>
</x-admin::layout>

 
<?php
new class extends \Livewire\Volt\Component {
    public $title = 'Account info';
    public $name;
    public $email;

    function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->id()],
        ];
    }

    function submit()
    {
        $this->validate();

        auth()->user()->name = $this->name;
        auth()->user()->email = $this->email;
        auth()->user()->save();
 
        $this->dispatch('notify', text: 'تم تحديث بيانات الحساب بنجاح');
    }

    public function rendering($view): void
    {
        $view->title('إدارة الحساب') ;
    }
}; ?>
