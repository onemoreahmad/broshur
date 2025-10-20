<x-auth::layout title="أنشئ بروشور جديد" subtitle="إبدأ مجاناً اليوم، وقم بترقية باقتك في أي وقت حسب إحتياجاتك">
    <form wire:submit="submit" class="flex flex-col gap-y-1">
        <ui:input label="اسم الصفحة" name="tenant_name" width="w-full" placeholder="مثال: وجيز الرقمية" />
        <ui:input name="tenant_handle" width="w-full" placeholder="my-business" dir="ltr" suffix=".{{ config('app.domain') }}" infoDir="rtl" prefix="https://" info="رابط الصفحة، يمكنه تغييره لاحقاً." wire:blur="reseterrors" />
 
        <ui:separator text="بيانات مدير الحساب" height="4" />
 
        <ui:input label="اسم مدير الحساب" name="user_name" width="w-full" placeholder="{{ __('Your name') }}" />
        <ui:input label="البريد الإلكتروني" name="user_email" width="w-full" dir="ltr" type="email" placeholder="your@email.com" />
        <ui:input label="كلمة المرور" name="user_password" width="w-full" dir="ltr" type="password" placeholder="*****" />

        <ui:button label="أنشئ حساب جديد"  wire-target="submit" class="mt-4" />
    </form>
</x-auth::layout>


<?php

use App\Actions\RegisterTenant;
use Illuminate\Support\Facades\Auth;
 
new class extends \Livewire\Volt\Component {
    public $tenant_name;
    public $tenant_handle;

    public $user_name;
    public $user_email;
    public $user_password;
 
    function mount()
    {
        $this->tenant_handle = generateKey(7);
    }
 
    function submit()
    {
        $data = RegisterTenant::run([
            'tenant_name' => $this->tenant_name,
            'tenant_handle' => $this->tenant_handle,
             
            'user_name' => $this->user_name,
            'user_email' => $this->user_email,
            'user_password' => $this->user_password,
        ]); 
 
        // \Mail::to($user->get('email'))->queue(new \Catalog\User\Mails\WelcomeEmail($user->get(), $tenant->get()));

        Auth::login($data['user'], true);
 
        $this->redirect(route('admin.home'));
    }

    public function reseterrors()
    {
        $this->resetValidation();
    }
   
}; ?>
