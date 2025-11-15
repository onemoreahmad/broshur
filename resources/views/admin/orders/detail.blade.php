 <x-admin::layout>

 <x-admin::container title="الطلب #{{ $order->sNumber ?: $order->hNumberhas }}"
     backRoute="{{ route('admin.orders.index') }}">

<div>
    <div class="px-4 lg:px-0 flex items-start justify-between">
        <div>
            <h3>
                <span class="text-gray-800 font-bold inline-block" dir="ltr">#{{ $order->sNumber }}</span>
                <time datetime="{{ $order->created_at }}"
                    class="text-base ms-3 opacity-50 inline-block">{{ $order->created_at->translatedFormat('j M Y') }}</time>
            </h3>
            <span
                class="text-sm text-gray-600 bg-gray-300 p-0.5 font-semibold px-2 rounded">{{ __($order->status) }}</span>
        </div>
        
        <div class="flex items-center justify-between gap-x-1">
            {{-- Platform/ResponseList/Order/order-detail --}}
          
        </div>
    </div>
    <div class="mt-10 mb-2 text-sm flex gap-x-2 text-gray-600">
         <button wire:click="openTab('order-detail')"  class="p-2 px-3 rounded-md flex items-center gap-x-2 hover:bg-white/40 @if($activeTab === 'order-detail') text-gray-800 bg-white hover:bg-white @endif"> 
            <ui:icon name="receipt" />
            {{ __('Order detail') }} 
        </button>

        @if(data_get($order, 'invoice'))
            <button wire:click="openTab('order-invoice')"  class="p-2 px-3 rounded-md flex items-center gap-x-2 hover:bg-white/40 @if($activeTab === 'order-invoice') text-gray-800  bg-white hover:bg-white @endif">
                <ui:icon name="file-invoice" />
                {{ __('Order invoice') }} 
            </button>
        @endif
        {{-- <ui:button wire:click="openTab('order-invoice')" label="{{ __('Order invoice') }}" variant="ghost" class="@if($activeTab === 'order-invoice') !bg-primary-500 @endif" />  --}}
        {{-- <ui:button wire:click="openTab('order-payment')" label="{{ __('Order payment') }}" variant="ghost" class="@if($activeTab == 'order-payment') !bg-pxrimary-500 @endif" />  --}}
             
    </div>
 
    @if($activeTab == 'order-detail')
    <div class="grid grid-cols-1 lg:grid-cols-3 lg:gap-8  px-2 lg:px-0 gap-y-8">
        <div class="col-span-2 text-base flex flex-col gap-y-6 lg:order-1 order-2">

 
            <livewire:admin.orders._order-items :order="$order" />
      
            {{-- <livewire:platform.ResponseList.Order.order-payment :response="$order" /> --}}
       
          
            {{-- <livewire:platform.ResponseList.Order.order-activities :response="$order" /> --}}
        </div>
        <div class="order-1">
            <div class="flex flex-col gap-y-6 w-full bg-white py-3 divide-y-2 rounded-md divide-dotted">
                <div class=" ">

                    <div class="text-sm divide-y-2 divide-gray-100 ">
                        <div class="gap-y-2 flex flex-col mb-2">
                            <div class="px-2 flex justify-end gap-x-2">
                                    <livewire:admin.orders.set-status :model="$order" />
                                
                                {{-- @if(data_get($order, 'invoice'))
                                    @if(request()->route()->getName() != 'admin.responses.invoice')
                                        <ui:button icon="printer" variant="outline" href="{{ route('admin.responses.invoice', ['responseId' => $order->id, 'invoiceId' => data_get($order, 'invoice.id')]) }}" target="_blank" label="{{__('Print invoice')}}" color="blue" />
                                    @endif
                                @endif --}}
                                {{-- <livewire:order.components.set-status :model="$order" /> --}}
                            </div>
                            {{-- <div class="px-2">
                                <livewire:order.components.print-order-summary :model="$order" />
                            </div> --}}
                            {{-- <div class="px-2">
                                <livewire:order.components.print-invoice :model="$order" />
                            </div> --}}
                        </div>
                
                        <div class="flex items-center justify-between p-2 px-4">
                            <dt class="font-medium text-gray-600">{{ __('Order number') }}</dt>
                            <dd class="text-gray-500 font-bold" dir="ltr">#{{ $order->sNumber }}</dd>
                        </div>
                
                        <div class=" p-2 px-4">
                            <div class="flex items-center justify-between">
                                <dt class="font-medium text-gray-600">{{ __('Order status') }}</dt>
                                <dd class="text-gray-500">
                                    <span
                                        class="text-sm text-gray-600 bg-gray-200 p-0.5 font-semibold px-2 rounded">{{ __($order->status) }}</span>
                                </dd>
                            </div>
                
                            @if ($order->status()?->reason)
                                <div class="mt-2 text-xs text-gray-500 bg-gray-100 p-1 rounded">
                                    {{ $order->status()?->reason }}
                                </div>
                            @endif
                        </div>
                        {{-- <div class="flex items-center justify-between p-2 px-4">
                            <dt class="font-medium text-gray-600">{{ __('Payment status') }}</dt>
                            <dd class="text-gray-500">
                                <span
                                    class="text-sm text-gray-600 bg-gray-200 p-0.5 font-semibold px-2 rounded">{{ __($order->payment_status) }}</span>
                            </dd>
                        </div> --}}
                        <div class="flex items-center justify-between p-2 px-4">
                            <dt class="font-medium text-gray-600">{{ __('Order date') }}</dt>
                            <dd class="text-gray-500">
                                <time datetime="{{ $order->created_at }}" title="{{ $order->created_at }}"
                                    class=" inline-block">{{ $order->created_at->translatedFormat('j M Y 🕘  h:i A') }}</time>
                            </dd>
                        </div>
                
                        <div class="flex items-center justify-between p-2 px-4">
                            <dt class="font-medium text-gray-600">   الشحن </dt>
                            <dt class="text-gray-600">{{ __(data_get($order, 'shipping_type')) }}</dt>
                            {{-- <dd class=" text-gray-900 text-end">
                                {{ price(data_get($order, 'shipping_cost'), 0) }}
                            </dd> --}}
                        </div>
                
                        <div class="flex items-center justify-between p-2 px-4">
                            <dt class="font-medium text-gray-600"> طريقة الدفع </dt>
                            {{-- <dt class="text-gray-600">{{ __(data_get($order, 'data.payment.name')) }}</dt> --}}
                            <dt class="text-gray-600">{{ __(data_get($order, 'data.paymentOption')) }}</dt>
                        </div>
                
                        <div class="flex items-center justify-between p-2 px-4">
                            <dt class="font-medium text-gray-600">{{ __('Total') }}</dt>
                            <dd class="font-medium text-base">{!! price(data_get($order, 'total', 0)) !!}</dd>
                        </div>
                 
                        <div class="text-sm px-4 py-3 divide-y-2 divide-gray-100">
                            <div class="font-semibold mb-2 text-gray-600">{{ __('Client') }}</div>
                            <div class="p-2 rounded bg-primary-50 mb-px flex items-center gap-x-2">
                                <img src="{{ data_get($order, 'client.image', asset('assets/images/user.png')) }}"
                                    alt="{{ data_get($order, 'client.name') }}"
                                    class="w-8 h-8 rounded-md object-cover object-center">
                
                                <div>
                                    {{ __(data_get($order, 'client.name')) }}
                                    <div>
                                        {{ data_get($order, 'client.phone') }}
                                        {{ data_get($order, 'client.email') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                
                        @if(data_get($order, 'shipping_type') != 'not-required')
                        <div class="text-sm px-4 pt-3 pb-0">
                            <div class="font-semibold mb-2 text-gray-600">{{ __('Delivery') }}</div>
                            <div class="p-2 rounded bg-primary-50 mb-px   gap-x-2 text-xs">
                                <div class=" font-semibold">
                                    {{ __(data_get($order, 'shipping_type')) }}
                                </div>
                                    {{ __('world::countries.' . data_get($order, 'data.address.country')) }}<br>
                
                                    {{-- {{ cityById(data_get($order, 'data.address.city')) }} -  --}}
                                    {{ data_get($order, 'data.address.district') }} <br>
                                    {{ data_get($order, 'data.address.street') }} <br>
                                    {{ data_get($order, 'data.address.postal_code') }} 
                                    {{ data_get($order, 'data.address.shortcode') }} 
                                    {{-- {{ data_get($order, 'dataArray.shipping.street') }} <br>
                                    {{ data_get($order, 'dataArray.shipping.shortcode') }} --}}
                            </div>
                        </div>
                        @endif
                
                    </div>
            </div>
        </div>
    </div>
</div>
@endif

    @if($activeTab == 'order-invoice')
    <div>
        order-invoice
        {{-- <livewire:platform.ResponseList.Order.order-invoice :response="$order" /> --}}
    </div>
    @endif

    @if($activeTab == 'order-payment')
    <div>
        order-payment
        {{-- <livewire:platform.ResponseList.Order.order-payment :response="$order" /> --}}
    </div>
    @endif

</div>

 </x-admin::container>
</x-admin::layout>

 <?php
 use App\Models\Order;
 
 new class extends \Livewire\Volt\Component {
    public $order;
    public $status;
    public $activeTab = 'order-detail';

    #[\Livewire\Attributes\On('updateOrderDetail')]
    public function updateOrderDetail()
    {
        $this->order = Order::whereId($this->order->id)->firstOrFail();
    }

    public function mount()
    {
        $this->order = Order::whereId(request()->id)->firstOrFail();
    }
 
    public function openTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function rendering($view): void
    {
        $view->title(__('Order') . ' #' . $this->order->snumber) ;
    }
     
 }; ?>
