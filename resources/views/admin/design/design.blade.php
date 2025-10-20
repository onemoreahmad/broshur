<div>
     <x-ui::form wire:submit="submit" id="catalog-info-form" formClass="flex flex-col gap-y-1">
 
        <ui:field  label="التصميم" class="flex flex-col">
        <div class=" flex flex-wrap gap-1">
            @foreach ($themes as  $item) 
 
                <label class="relative flex items-center " for="theme-option-{{ $item->id }}">
                    <input
                        name="color"
                        type="radio"
                        class="peer sr-only h-5 w-5 cursor-pointer appearance-none rounded-full border border-slate-300 checked:border-slate-400 transition-all"
                        id="theme-option-{{ $item->id }}"
                        wire:model.live="themeId"
                        value="{{ $item->id }}"
                        />
 
                    @if (data_get($tenant, 'theme_id') == $item->id)
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="icon icon-tabler icon-tabler-check size-7 border-4 border-primary-100 bg-primary-600 text-white rounded-full p-1 mx-auto z-10 absolute -top-3 left-0 right-0"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M5 12l5 5l10 -10"></path>
                    </svg>
                    @endif
                    <span class="peer-checked:bg-primary-100 peer-checked:border-primary-300 hover:bg-gray-100 @if($themeId == $item->id) bg-primary-100 border-primary-300 @endif p-1 text-sm rounded-lg cursor-pointer flex flex-col gap-2 border border-gray-200" >
                        <img src="{{ asset($themePath.$item->slug.'/'.$item->slug.'.png') }}?v=5" alt="{{ $item->name }}" class="size-24 object-cover rounded-t-lg">
                        <div class="text-center p-2 text-xs">{{ $item->name }}</div>
                    </span>
                </label>
            @endforeach
        </div>
        </ui:field>
 
        <div>
            @if (count(themeOptionList($themePath.data_get($theme, 'slug'))))
                @foreach (themeOptionList($themePath.data_get($theme, 'slug')) as $key => $field)
                    @if (view()->exists('ui::' . data_get($field, 'type')))
                        <div wire:key="{{ $key }}" class="mb-2">
                            <x-dynamic-component 
                                :component="'ui::' . data_get($field, 'type')" 
                                class="mt-4" 
                                name="options.{{ $key }}"
                                label="{{ __(data_get($field, 'label')) }}" 
                                :options="data_get($field, 'options', [])" 
                                :value="data_get($options, $key, data_get($field, 'default'))" 
                                :wirename="$key"
                                :modelId="currentTenant('id')" 
                                modelType="tenant"
                                mediaCollection="{{ data_get($field, 'collection', 'theme-media') }}"
                                collection="{{ data_get($field, 'collection', 'theme-media') }}"
                                placeholder="{{ data_get($field, 'label') }}" info="{{ data_get($field, 'info') }}"
                            />
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
 
        <x-slot:footer>
            <ui:button wire-target="submit" label="حفظ" icon="device-floppy" />
        </x-slot>
    </x-ui::form>
</div>

<?php
    
use App\Models\ThemeOption;
use App\Models\Theme;
use App\Models\Tenant;

new class extends \Livewire\Volt\Component {
 
    public $tenant;
    public $theme;
    public $options = [];
    public $themes = [];
    public $themeOption;
    public $themeId;
    public $themePath = 'themes/';

    //#[\Livewire\Attributes\On('tenant-logo-updated')]
    function mount()
    {
        $this->themePath = 'themes/';
        $this->tenant = currentTenant();
        $this->themes = Theme::get();
        $this->theme = Theme::whereId($this->tenant->theme_id)->first() ?? $this->themes->first() ;
        $this->themeId = $this->theme->id;

        $this->themeOption = ThemeOption::firstOrCreate([
             'model_id' => $this->tenant->id,
             'model_type' => Tenant::class,
             'theme_id' => $this->theme->id ,
        ]);
 
        $this->options = collect(themeOptionList($this->themePath.data_get($this->theme, 'slug')))
             ->mapWithKeys(function ($option, $key) {
                 return [$key => data_get($this->themeOption?->config, $key, data_get($option, 'default'))];
             })
             ->toArray();
  
    }

    public function updatedThemeId($value)
    {
        $this->theme = Theme::whereId($value)->first();

        $this->themeOption = ThemeOption::firstOrCreate([
             'model_id' => $this->tenant->id,
             'model_type' => Tenant::class,
             'theme_id' => $this->theme->id ,
        ]);
  
        $this->options = collect(themeOptionList($this->themePath.data_get($this->theme, 'slug')))
             ->mapWithKeys(function ($option, $key) {
                 return [$key => data_get($this->themeOption?->config, $key, data_get($option, 'default'))];
             })
             ->toArray();

        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');
    }

    public function rules()
    {
        return [
            'themeId' => 'required',
        ];
    }

    function submit()
    {
        $this->validate();
        $this->tenant->theme_id = $this->themeId;
        $this->tenant->save();
 

        $this->themeOption->config = $this->options;
        $this->themeOption->save();
        $this->js('document.getElementById("linkinbio-iframe").contentWindow.location.reload();');

        $this->dispatch('notify', text: 'تم تحديث التصميم بنجاح');
    }
};
?>
