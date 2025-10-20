@props([
    'icon' => null,
    'subtitle' => null,
    'button' => null,
])

<div {{ $attributes }}>
    <div class="text-center py-8 bg-gray-100 rounded-xl">
        @if($icon)
            <div class="mx-auto h-12 w-12 text-gray-500">{{$icon}}</div>
        @else 
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
        @endif 

        <h3 class="mt-3 text-sm font-semibold text-gray-600">{{$slot}}</h3>
        <p class="mt-3 text-sm text-gray-500">{{$subtitle ?? ''}}</p>
        <div class="mt-6 mx-auto text-center w-full">
            {{$button ?? ''}}
        </div>
    </div>
</div>