@props([
    'icon' => null,
    'title' => null,
    'subtitle' => null,
    'color' => 'slate',
    'colorLevel' => '200/50',
])

<div>
    <div class="flex items-center justify-center w-20 h-20  lg:w-24  lg:h-24 mb-4  bg-{{$color}}-{{$colorLevel}}  rounded-full" style="clip-path: polygon(50% 0%, 83% 12%, 100% 43%, 94% 78%, 68% 100%, 32% 100%, 6% 78%, 0% 43%, 17% 12%);">
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