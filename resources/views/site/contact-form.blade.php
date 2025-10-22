<div class="mt-6 overflow-hidden bg-white rounded-xl">
    <div class="px-6 py-12 sm:p-12">
        <img src="{{ asset('assets/icons/send.png') }}" class="w-20 h-20 mx-auto mb-6" alt="">
        <h3 class="text-3xl font-semibold text-center text-gray-900">أرسل رسالة مباشرة</h3>

        
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-4 mt-14">
                <div>
                    <label for="" class="text-base font-medium text-gray-900"> اسمك </label>
                    <div class="mt-2.5 relative">
                        <input type="text" wire:model="name" name="" id="" placeholder="Enter your full name" class="block w-full px-4 py-4 text-black placeholder-gray-500 focus:bg-gray-50 text-sm transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-primary-600 caret-primary-600" />
                    </div>
                    @error('name')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label for="" class="text-base font-medium text-gray-900"> بريدك الإلكتروني </label>
                    <div class="mt-2.5 relative">
                        <input type="email" wire:model="email" name="" id="" placeholder="your@email.com" dir="ltr" class="block w-full px-4 py-4 text-black placeholder-gray-500 focus:bg-gray-50 text-sm transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-primary-600 caret-primary-600" />
                    </div>
                    @error('email')
                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="" class="text-base font-medium text-gray-900"> رسالتك </label>
                    <div class="mt-2.5 relative">
                        <textarea wire:model="message" name="" id="" placeholder="أكتب رسالتك .." class="block w-full px-4 py-4 text-black placeholder-gray-500 focus:bg-gray-50 text-sm transition-all duration-200 bg-white border border-gray-200 rounded-md resize-y focus:outline-none focus:border-primary-600 caret-primary-600" rows="4"></textarea>
                    </div>
                    @error('message')
                        <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                    @enderror
                </div>


                <div class="sm:col-span-2">

                    @if(session('success-send'))
                        <div class="text-green-600 font-semibold text-base bg-green-500/10 p-3 rounded-md mt-1 w-full mx-auto">{{session('success-send')}}</div>
                    @endif

                    <button wire:click="send" class="inline-flex items-center justify-center w-full px-4 py-4 mt-2 text-base font-semibold text-white transition-all duration-200 bg-primary-700 border border-transparent rounded-xl focus:outline-none hover:bg-primary-800 focus:bg-primary-700">
                        <span wire:loading.remove>أرسل</span>
                      
                        <span wire:loading>
                            <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-loader animate-spin h-6 w-6" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="6" x2="12" y2="3" />
                            <line x1="16.25" y1="7.75" x2="18.4" y2="5.6" />
                            <line x1="18" y1="12" x2="21" y2="12" />
                            <line x1="16.25" y1="16.25" x2="18.4" y2="18.4" />
                            <line x1="12" y1="18" x2="12" y2="21" />
                            <line x1="7.75" y1="16.25" x2="5.6" y2="18.4" />
                            <line x1="6" y1="12" x2="3" y2="12" />
                                <line x1="7.75" y1="7.75" x2="5.6" y2="5.6" />
                            </svg>
                        </span>

                    </button>
                </div>
            </div>
        
    </div>
</div>



<?php 
 
new class extends \Livewire\Volt\Component {

    public $email;
    public $name;
    public $message;

    public function mount()
    {
        $this->email = auth()->user()->email ?? null;
        $this->name = auth()->user()->name ?? null;
    }
  
    public function send()
    {
        $this->validate([
            'name' => 'required|string|max:255|min:1',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:255|min:5',
        ]);

        $body = '
        <html dir="rtl" >
            <div style="font-family: Tahoma, sans-serif; font-size: 15px; white-space: pre-line; background-color: #f4f4f4; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">        
                <div>الاسم: ' . $this->name . '</div>
                <div>البريد الإلكتروني: ' . $this->email . '</div>
                <div>الرسالة: <hr /> <div style="padding: 10px; white-space: pre-line;"> ' . nl2br($this->message) . '</div></div>
            </div>
        </html>
        ';
        
        \Mail::html($body, function ($message) {
            $message->from('info@broshur.com', $this->name)
                    ->to('info@broshur.com')
                    ->replyTo($this->email, $this->name)
                    ->subject('رسالة من موقع بروشور');
        });
 
 
        session()->flash('success-send', 'شكراً لك، تم ارسال رسالتك بنجاح. سيتم التواصل معك قريباً جداً. ');
 
        $this->reset(['message']);
    }
}; ?>

