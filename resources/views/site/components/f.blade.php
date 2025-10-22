@props([
    'icon' => null,
    'title' => null,
    'subtitle' => null,
    'color' => 'slate',
    'colorLevel' => '100/60',
])

<div>
    <div class="flex items-center justify-center w-20 h-20  lg:w-24  lg:h-24 mb-4  bg-{{$color}}-{{$colorLevel}} rounded-xl ">
        @if($icon)
        <img src="{{$icon}}" class="p-4" alt="">
        @else 
        <div class="p-4 w-24x">
          {{$slot}}  
        </div>
        @endif

        
    </div>
    <h3 class="mb-2 font-semibold leading-tight text-gray-900 text-xl font-camel-regular"> {{$title}} </h3>
    <p class="text-sm text-gray-500">{{$subtitle}}</p>
</div>