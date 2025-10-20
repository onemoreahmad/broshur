@props([
    'title' => '',
    'subtitle' => '',
    'icon' => null,
    'actions' => null,
    'prime' => false,
])

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl w-full relative']) }}>
 
    <div class="flex justify-between items-start p-4 border-b-2 border-dotted mb-3  border-gray-100">
        <div class="flex gap-x-4">
            @if ($icon)
                <div class="h-8 w-8 bg-gray-100 p-1 rounded-lg flex-shrink-0 flex items-center justify-center">
                    {{ $icon }}
                </div>
            @endif

            @if ($title)
                <div class="">
                    <h2 class="text-base text-gray-700">{{ $title }} </h2>
                    @if ($subtitle)
                        <p class="opacity-30 text-xs mt-1"><span class="opacity-50">/</span> {{ $subtitle }} </p>
                    @endif
                </div>
            @endif
        </div>
        <div class="flex-shrink-0 ">
            {{ $actions }}
        </div>
    </div>

    <div class="flex flex-col [&>*:last-child]:rounded-b-xl [&>*:last-child]:border-b-0">
        {{ $slot }}
    </div>
</div>
