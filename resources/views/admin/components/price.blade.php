@props(['amount' => 0, 'currency' => currentTenant('currency', 'SAR'), 'long' => false])
<span {{$attributes}}>
    {{-- {{  $long ?  $amount / 100 : $amount , 0  }}  --}}
    {{ str_replace('.00', '', number_format($long ?  $amount / 100 : $amount , 2 ))   }} 
 
    @if($currency == 'SAR')
        <ui:icon name="sar" />
    @else 
        {{currency($currency)}}
    @endif
</span>