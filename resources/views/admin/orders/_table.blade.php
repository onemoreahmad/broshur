<div class=" divide-y divide-gray-200 divide-dotted">

    <div class="bg-gray-100 p-3 flex items-center gap-x-7 w-full">
        <div class="ps-3">
            <div class="flex items-center">
                <x-admin::check-all />
            </div>
        </div>
        <div class="flex-grow">
            <div class="relative text-sm text-gray-800 col-span-3">
                <div class="absolute ps-2 right-0 top-0 bottom-0 flex items-center pointer-events-none text-gray-500">
                    <ui:icon name="search" class="  text-gray-400" />
                </div>

                <input wire:model.live="search" type="text" placeholder="ابحث .."
                    class="block w-full rounded-lg   py-1.5 ps-10 text-gray-800 ring-0 ring-inset border-transparent border ring-gray-200 placeholder:text-gray-400 focus:border focus:outline-none focus:border-primary-500 sm:text-sm sm:leading-6">
            </div>
        </div>
        <div x-show="$wire.selectedIds.length > 0" x-cloak class="flex items-center gap-x-2">
            {{-- <div class="flex items-center gap-1 text-sm text-gray-600">
                <span x-text="$wire.selectedIds.length"></span>

                <span>محددة</span>
            </div> --}}

            <button wire:click="deleteSelected" wire:confirm="Are you sure you want to delete all selected items?"
                class="flex items-center gap-2 rounded-lg border px-3 py-1.5 bg-white text-sm text-gray-700 hover:bg-gray-200 disabled:cursor-not-allowed disabled:opacity-75">

                <ui:icon name="trash" wire:loading.remove class=" text-gray-300 w-4 h-4" />
                <ui:icon name="loader-3" wire:loading wire:target="deleteSelected"
                    class="animate-spin  text-gray-300 w-4 h-4" />
                {{ __('Delete selected') }}<span x-text="'('+$wire.selectedIds.length+')'"></span>
            </button>
        </div>
    </div>

    <div class="relative last-child:rounded-b-2xl pb-4X">

        @if ($results->count() == 0)
            <ui:empty subtitle="سيتم عرض قائمة الطلبات وأي تفاعلات تحدث على الصفحات الخاص بك هنا." class="p-2">
                {{ __('No responses.') }}
                <x-slot:icon>
                    <ui:icon name="message-2" class="!w-12 !h-12 text-gray-400 p-0.5" />
                </x-slot:icon>
            </ui:empty>
        @else
            <div class="pb-4 divide-y divide-gray-100">
                @foreach ($results as $item)
                    <div wire:key="{{ $item->id }}"
                        class="flex items-center justify-between gap-x-7 w-full hover:bg-gray-50 last:rounded-b-2xl">
                        <div class="ps-6">
                            <div class="flex items-center">
                                <input wire:model="selectedIds" value="{{ $item->id }}" type="checkbox"
                                    class="rounded-xl border-gray-300 shadow-sm w-4 h-4">
                            </div>
                        </div>
                        <div class="py-3 w-full">
                            <a href="{{ route('admin.orders.detail', ['id' => $item->id]) }}" wire:navigate
                                class="flex items-center gap-x-2">

                              
                                <div>
                                    <h2 class="text-lg text-gray-700 dark:text-white flex items-center gap-x-2">
                                        <p>{{ $item->sNumber }}</p>
                                        <span class="text-sm font-bold ms-1 text-gray-600 dark:text-gray-400 bg-primary-100 p-px px-2 rounded-md">
                                            <x-admin::price amount="{{ data_get($item, 'total') }}" :long="true" />
                                        </span>
                                    </h2>
                                    <div class="flex items-center gap-x-1.5 mt-1 flex-wrap">

                                        {{-- <span
                                            class="bg-{{ data_get(responseList($item->type), 'twcolor') }}-50 text-{{ data_get(responseList($item->type), 'twcolor') }}-700 rounded-md text-xs flex items-center px-0.5">
                                            <span
                                                class="h-6 w-6  text-{{ data_get(responseList($item->type), 'twcolor') }}-600 p-1 rounded-r-md">{!! data_get(responseList($item->type), 'icon') !!}</span>
                                            <span>{{ data_get(responseList($item->type), 'name') }}</span>
                                        </span> --}}
                                        <span title="{{ $item->created_at }} "
                                            class="opacity-50 inline-flex items-center gap-x-1 bg-gray-200 p-1 px-1 rounded-md text-xs">
                                            {{ $item->created_at->diffForHumans() }}
                                        </span>
                                        @if ($item->status)
                                            <span title="{{ $item->status }}"
                                                class="opacity-50x inline-flex items-center gap-x-1 bg-{{$item->statusColor}}-100 text-{{$item->statusColor}}-600 p-1 px-1 rounded-md text-xs font-semibold">
                                                {{ __($item->status) }}
                                            </span>
                                        @else
                                            <span
                                                class="inline-block text-xs rounded bg-orange-200 text-gray-500 font-semibold p-1 px-1">{{ __('Draft') }}</span>
                                        @endif
                                                                                   
                                        <span
                                                class="inline-block text-xs rounded bg-gray-200 text-gray-500 font-semibold p-1 px-1">حالة الدفع: {{   __($item->payment_status) }}</span>

                                        {{-- <span
                                            class="inline-block text-xs rounded bg-{{ data_get($item->draftStatus, 'color') }}-100 p-1 px-1">{{ __(data_get($item->draftStatus, 'label')) }}</span> --}}


                                        {{-- @includeIf(responseList( $item->app->slug, 'components.list-view'),
                                            ['response' => $item, 'responseId' => request()->id]
                                        ) --}}


                                        <div>
                                            @if (data_get($item, 'data.selected_payment'))
                                                <span class="opacity-50 inline-flex items-center gap-x-1 bg-teal-200 p-1 px-1 rounded-md text-xs">
                                                    {{ __(data_get($item, 'data.selected_payment.name.ar')) }}
                                                </span>
                                            @endif
                                         
                                            @if (data_get($item, 'data.client.name') || data_get($item, 'data.client_name'))
                                                <span class="opacity-50 inline-flex items-center gap-x-1 bg-cyan-200 p-1 px-1 rounded-md text-xs font-bold">
                                                    {{ __(data_get($item, 'data.client.name', data_get($item, 'data.client_name'))) }}
                                                    {{-- <ui:icon name="user" class="!h-4" /> --}}
                                                    {{-- {{ data_get($item, 'data.client.phone', data_get($item, 'data.client_phone')) ?: data_get($item, 'data.client.email', data_get($item, 'data.client_email')) }} --}}
                                                </span>
                                            @endif
                                        </div>
                                        

                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="pe-6">

                            <div x-data="{ dropdownMenu: false }">
                                <div class="relative" @click.outside="dropdownMenu=false" x-cloak>
                                    <button @click="dropdownMenu = ! dropdownMenu" type="button"
                                        class="hover:bg-gray-200 p-1 rounded-lg inline-block" id="user-menu-button"
                                        aria-expanded="false" aria-haspopup="true">
                                        <ui:icon name="dots" class="  text-gray-400" />

                                    </button>

                                    <div x-show="dropdownMenu"
                                        class="absolute z-50 mt-2 bg-white border shadow-sm rounded-lg text-gray-800 text-sm flex p-1 ltr:right-0 rtl:left-0 w-48 flex-col gap-y-px"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                                        tabindex="-1" x-transition.scale.origin.top>


                                        <a href="{{ route('admin.orders.detail', ['id' => $item->id]) }}"
                                            wire:navigate
                                            class="hover:bg-stone-100 p-1.5 rounded flex items-center gap-x-2">
                                            {{ __('Details') }}
                                        </a>

                                        <a wire:confirm="Are you sure you want to delete this item?"
                                            wire:click="delete('{{ $item->id }}')"
                                            class="hover:bg-red-100 text-red-500 p-1.5 rounded flex items-center gap-x-2">
                                            {{ __('Delete') }}
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Table loading spinners... --}}
        <div wire:loading wire:target="sortBy, search, nextPage, previousPage, archive, archiveSelected"
            class="absolute inset-0 bg-white opacity-50">
            {{--  --}}
        </div>

        <div wire:loading.flex wire:target="sortBy, search, nextPage, previousPage, archive, archiveSelected"
            class="flex justify-center items-center absolute inset-0">

            <ui:icon name="loader-3" class="animate-spin  text-gray-300 w-10 h-10" />
        </div>
    </div>

    @if ($results->total() > $results->perPage())
        <div class=" p-4 px-6 bg-gray-50 rounded-b-2xl flex justify-between items-center">
            <div class="text-gray-500 text-sm">
                النتائج : <b>{{ \Illuminate\Support\Number::format($results->total()) }}</b>
            </div>
            {{ $results->links('admin::components.pagination') }}
        </div>
    @endif
</div>

<?php

use App\Models\Order;
use Livewire\WithPagination;

new class extends Livewire\Volt\Component {
    use WithPagination;

    public $search;
    public $selectedIds = [];
    public $allIdsOnPage = [];

    public function placeholder()
    {
        return loadingIcon();
    }

    protected function applySearch($query)
    {
        return $this->search === '' ? $query : $query->where('number', 'like', '%' . $this->search . '%');
    }

    function delete($id)
    {
        $entry = Order::whereId($id)->first();
        $entry->delete();

        $this->dispatch('notify', text: __('Item(s) deleted successfully.'));
    }

    public function deleteSelected()
    {
        $items = Order::whereIn('id', $this->selectedIds)->get();

        foreach ($items as $item) {
            $this->delete($item->id);
        }

        $this->dispatch('notify', text: __('Selected items deleted successfully.'));
    }

    public function with(): array
    {
        $query = Order::orderBy('id', 'desc');

        $query = $this->applySearch($query);

        $results = $query->paginate(20);

        $this->allIdsOnPage = $results->map(fn($item) => (string) $item->id)->toArray();

        return [
            'results' => $results,
        ];
    }
}; ?>
