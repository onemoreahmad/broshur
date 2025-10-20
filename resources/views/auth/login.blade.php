 <x-auth::layout title="تسجيل الدخول" subtitle="سجل دخولك لإدارة أعمالك.">
     <form wire:submit="submit" class="grid mb-12 flex flex-col gap-y-1">
         <ui:input label="البريد الإلكتروني" width="w-full" name="email" dir="ltr" type="email" placeholder="your@email.com" />
         <ui:input label="كلمة المرور" width="w-full" name="password" dir="ltr" type="password" placeholder="*****" />
         {{-- <ui:toggle label="{{ __('Remember') }}" /> --}}
         <ui:button label="تسجيل الدخول" wire-target="submit" class="mt-4" />
     </form>

     <div class="text-sm flex justify-between items-center border-b border-gray-300/50 border-dotted p-1 rounded">
         <span class="text-gray-500 text-sm">هل نسيت كلمة المرور ؟ </span>
         <ui:button href="{{ route('auth.password.forgot-password') }}" wire:navigate label="إضغط هنا لإستعاداتها" variant="ghost" />
     </div>

     <div class="mt-2  flex justify-between items-center border-b border-gray-300/50 border-dotted p-1 rounded">
         <span class="text-gray-500 text-sm">ليس لديك حسابك بعد ؟ </span>
         <ui:button href="{{ route('auth.register') }}" wire:navigate label="أنشئ حساب جديد" variant="outline" />
     </div>
 </x-auth::layout>

 <?php
 
 use Illuminate\Support\Facades\Auth;
 use App\Models\User;
 
 new class extends \Livewire\Volt\Component {
     public $email;
     public $password;
     public $remember;
 
     protected function rules()
     {
         return [
             'email' => 'required|email|max:255',
             'password' => 'required|min:6|max:250',
         ];
     }
 
     public function submit()
     {
         $this->withValidator(function ($validator) {
             $validator->after(function ($validator) {
                 // if (!Auth::login($user->get(), true)){
                 if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], true)) {
                     $validator->errors()->add('email', trans('auth.failed'));
                 }

                 request()->session()->regenerate();
                
             });
         });
 
         $this->validate();
 
         $user = User::whereId(auth()->id())->select('id')->with('tenant')->first();
  
         $this->redirect(route('admin.home'));
     }
  
 }; ?>
