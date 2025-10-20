@props([
    'title' => null,
    'subtitle' => null,
    'target' => '',
    'formClass' => '',
    'footer' => null
])

<form {{ $attributes->class('bg-white rounded-xl w-full') }}>
    @if ($title)
        <div class="mb-6 p-4  text-gray-600 ">
            <h2 class="text-sm font-semibold">{{ $title }}</h2>
            @if ($subtitle)
                <small class="opacity-50">{{ $subtitle }}</small>
            @endif
        </div>
    @endif

    <div class="md:p-4 py-4 {{ $formClass }}">
        {{ $slot }}
    </div>

    @if($footer)
        <div {{$footer->attributes->class('flex justify-end p-4')}}>
            {{ $footer }}
        </div>
    @endif
</form>
