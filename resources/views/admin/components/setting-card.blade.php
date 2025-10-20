@props(['title', 'description', 'icon', 'slug'])
 <a href="{{ route('admin.settings.detail', ['slug' => $slug]) }}" wire:navigate class="flex gap-x-3 items-center bg-gray-100 hover:bg-gray-200/80 p-2 rounded-xl">
    <div class="bg-white p-2 rounded-xl shrink-0">
        {{-- <img class="h-10 w-10" src="{{ $icon }}"
            alt=""> --}}
            @if ($icon)
                {{-- <div class="h-8 w-8 bg-gray-100 p-1 rounded-lg flex-shrink-0 flex items-center justify-center"> --}}
                    <img class="h-10 w-10" src="{{ $icon }}"
                    alt="">
                {{-- </div> --}}
            @endif
    </div>
    <div class="truncate">
        <p class="text-sm font-medium text-gray-700">
            {{ $title }}
        </p>
        <small class="text-gray-500 text-xs truncate">
            {{ $description }} </small>
    </div>
</a>