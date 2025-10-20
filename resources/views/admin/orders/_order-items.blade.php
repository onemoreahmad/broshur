 
<div class="bg-gray-50  pt-3 relative rounded-lg">
 
<table class="w-full text-gray-500 bg-white ">
    <caption class="sr-only"> {{ __('Order items') }}</caption>

    <thead
        class="sr-only rtl:text-right font-semibold bg-gray-50 text-sm text-gray-500 sm:not-sr-only border-b-2 border-gray-200/50">
        <tr>
            <th scope="col" class="py-3 px-5 sm:w-2/5 lg:w-2/3">{{ __('Item') }}</th>
            <th scope="col" class="hidden w-1/5 py-3  sm:table-cell">{{ __('Price') }}</th>
            <th scope="col" class="hidden w-1/5 py-3  sm:table-cell">{{ __('Quantity') }}</th>
            {{-- <th scope="col" class="w-0 pe-4"></th> --}}
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200/50 border-b border-gray-200 text-sm ">
        @foreach ($order->items()->whereNotIn('type', ['coupon', 'extra', 'shipping'])->get() as $item)
            <tr class="">
                <td class="py-2 p-2 ">
                    <div class="flex items-center px-3 ">

                        <img src="{{ data_get($item, 'image') }}?p=thumb"
                            alt="{{ data_get($item, 'data.name') }}"
                            class="me-3 h-10 w-10 rounded object-cover object-center">
                        <div>
                            <div class="font-medium text-gray-900">
                                {{ data_get($item, 'data.name') }}
                            </div>
                            <div class="mt-1 flex flex-wrap gap-1">
                                @if (data_get($item, 'type') == 'service' )
                                    {{-- <div class="text-green-700 text-xs font-normal mt-1">
                                        {{data_get($item, 'data.options.dateFormatted')}} 
                                        <br>  
                                        {{data_get($item, 'data.options.timeFormatted')}} <br>
                                        {{data_get($item, 'data.options.duration')}} دقيقة 
                                    </div> --}}

                                    <div class="mt-2 text-xs">
                                        <span class="font-normal inline-block w-12">اليوم </span> <b class="bg-green-100  mb-1 p-px px-2 inline-block rounded" dir="ltr">{{\Carbon\Carbon::parse(data_get($item, 'data.options.date'))->translatedFormat('l')}} - {{\Carbon\Carbon::parse(data_get($item, 'data.options.date'))->translatedFormat('d/n/Y')}} 
                                          
                                        </b> 
                                        ({{\Alkoumi\LaravelHijriDate\Hijri::Date('j F ، Y', data_get($item, 'data.options.date'))}})  
                                        <br>  
                                    
                                        <span class="font-normal inline-block w-12">الوقت </span> <b class="bg-green-100  mb-1 p-px px-2 inline-block rounded">{{\Carbon\Carbon::parse(data_get($item, 'data.options.time'))->translatedFormat('H:i a')}}</b> <br>
                                        <span class="font-normal inline-block w-12">المدة </span> <b class="bg-pink-100  mb-1 p-px px-2 inline-block rounded">{{data_get($item, 'data.options.duration')}} دقيقة</b> 
    
                                    </div>
                                  

                                @else 
                                    @foreach (data_get($item, 'data.options', []) ?: [] as $stockValue)
                                        <span class="bg-gray-100 p-1 inline-block mb-1">
                                            {{-- {{ data_get($stockValue, 'option') }}: --}}
                                            <b>{{ data_get($stockValue, 'value') }}</b>
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mt-1 sm:hidden">{{ data_get($item, 'quantity', 0) }}</div>
                            {{-- <div class="mt-1 sm:hidden">{!! price(data_get($item, 'amount', 0)) !!}
                                <input type="number" x-data value="{{ data_get($item, 'quantity', 0) }}"
                                    class="w-12 p-1 border text-center"
                                    @change="$wire.updateQuantity($event.target.value, '{{ $item->id }}')">
                            </div> --}}
                        </div>
                    </div>
                </td>
                <td class="hidden py-6 sm:table-cell">  {!! price(data_get($item, 'amount', 0), true) !!}</td>
                <td class="hidden py-6 sm:table-cell">
                    {{ data_get($item, 'quantity') }}

                    {{-- <input type="number" x-data value="{{ data_get($item, 'quantity', 0) }}" min="1"
                        class="w-12 p-1 border text-center"
                        @change="$wire.updateQuantity($event.target.value, '{{ $item->id }}')"> --}}

                </td>
                {{-- <td class="sm:table-cell text-end pe-8">
                    <button
                        wire:confirm="{{ trans('Are you sure you want to delete this item from order ?', ['title' => data_get($item, 'entry.title')]) }} "
                        wire:click="removeOrderItem('{{ $item->id }}')"
                        class="hover:text-red-600 hover:bg-gray-200 p-0.5 px-1 font-bold rounded">x</button>
                </td> --}}
            </tr>
        @endforeach
        
        <tr class="bg-gray-50">
            <td class="py-2 ps-5 ">
                {{t('Subtotal')}} 
            </td>
            <td class=" ">  {!! price(data_get($order, 'subtotal', 0)) !!}</td>
            <td class="hidden py-6 sm:table-cell">
                 
            </td>   
        </tr>

         
        @foreach (data_get($order, 'data.cartCoupons', []) ?: [] as $coupon)
            <tr class="bg-gray-50">
                <td class="py-2 ps-5 ">
                    <b class="bg-gray-200 p-1 inline-block rounded text-xs">الخصم</b>
                    {{ data_get($coupon, 'name') }} : {{ data_get($coupon, 'description') }}
                </td>
                <td class=""> {!! price(data_get($coupon, 'getPriceSumWithConditions', 0)) !!} 
                    (-{{ data_get($coupon, 'valueType') == 'percentage' ? data_get($coupon, 'value') . '%' : price(data_get($coupon, 'value')) }})
                </td>
                <td class="hidden py-6 sm:table-cell">
                     
                </td>   
            </tr>
        @endforeach
        
       
        @foreach (data_get($order, 'data.cartExtras', []) ?: [] as $extra)
            <tr class="bg-gray-50">
                <td class="py-2 ps-5 ">
                    {{ data_get($extra, 'name') }}
                </td>
                <td class=" ">  {!! price(data_get($extra, 'price', 0)) !!}</td>
                <td class="hidden py-6 sm:table-cell">
                     
                </td>   
            </tr>
        @endforeach

        @if (data_get($order, 'data.cartShipping', []))
            <tr class="bg-gray-50">
                <td class="py-2 ps-5 ">
                    الشحن ({{ data_get($order->data->cartShipping, 'name') }})
                </td>
                <td class=" ">  {!! price(data_get($order->data->cartShipping, 'price', 0)) !!}</td>
                <td class="hidden py-6 sm:table-cell">
                </td>   
            </tr>
        @endif

        <tr class="bg-gray-100 font-bold">
            <td class="py-2 ps-5 ">
                {{t('Total')}} 
            </td>
            <td class=" ">  {!! price(data_get($order, 'total', 0)) !!}</td>
            <td class="hidden py-6 sm:table-cell">
                 
            </td>   
        </tr>

    </tbody>
</table>
</div>


<?php
 
new class extends \Livewire\Volt\Component {
    public $order;

    public function mount($order)
    {
        $this->order = $order;


    }
}
?>
