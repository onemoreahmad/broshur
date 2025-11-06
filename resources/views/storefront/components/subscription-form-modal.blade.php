<div class="overflow-hidden bg-white rounded-xl">
    <div class="p-px">
        <h3 class="text-base font-bold text-gray-900 p-5 bg-gray-50 w-full">اشترك الآن</h3>

        @if($subscriptionMessage)
            <div class="px-6">
                <p class="text-sm leading-6 text-gray-600 whitespace-pre-line">
                    {{ $subscriptionMessage }}
                </p>
            </div>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-5 gap-y-4 p-6 pt-4">
            <div>
                {{-- <label class="text-base font-medium text-gray-900"> اسمك </label> --}}
                <div class="mt-2.5 relative">
                    <input type="text" wire:model="name" placeholder="  اسمك الثنائي" class="block w-full px-4 py-4 text-black placeholder-gray-500 focus:bg-gray-50 text-sm transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-primary-600 caret-primary-600" />
                </div>
                @error('name')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <div>
                {{-- <label class="text-base font-medium text-gray-900"> بريدك الإلكتروني </label> --}}
                <div class="mt-2.5 relative">
                    <input type="email" wire:model="email" placeholder="you@email.com" dir="ltr" class="block w-full px-4 py-4 text-black placeholder-gray-500 focus:bg-gray-50 text-sm transition-all duration-200 bg-white border border-gray-200 rounded-md focus:outline-none focus:border-primary-600 caret-primary-600" />
                </div>
                @error('email')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
 

            <div class="sm:col-span-2">
                @if(session('success-subscription'))
                    <div class="text-green-600 font-semibold text-base bg-green-500/10 p-3 rounded-md mt-1 w-full mx-auto">{{ session('success-subscription') }}</div>
                @endif

                <button wire:click="send" class="inline-flex items-center justify-center w-full px-4 py-4 mt-2 text-base font-semibold text-white transition-all duration-200 bg-{{ option('primaryColor', 'blue') }}-700 border border-transparent rounded-xl focus:outline-none hover:bg-{{ option('primaryColor', 'blue') }}-800 focus:bg-{{ option('primaryColor', 'blue') }}-700">
                    <span wire:loading.remove>اشترك الآن</span>

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

use App\Models\Subscriber;
use App\Models\Link;

new class extends \Livewire\Volt\Component {
    public $email;
    public $name;
    public $subscriptionMessage = '';
 
    public function mount()
    {
        $link = Link::query()
            ->where('type', 'cta')
            ->where('slug', 'subscription')
            ->first();

        $this->subscriptionMessage = $link ? data_get($link->meta, 'message', '') : '';
    }

    public function send()
    {
        $this->validate([
            'name' => 'required|string|max:255|min:1',
            'email' => 'required|email|max:255',
        ]);

        Subscriber::updateOrCreate(
            ['email' => $this->email],
            [
                'name' => $this->name,
            ]
        );
 
        session()->flash('success-subscription', 'شكراً لك، تم الاشتراك بنجاح.  💌');

        $this->reset(['name', 'email']);
    }
};
?>

