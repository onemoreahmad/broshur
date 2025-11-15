 <x-admin::container>
     <x-admin::mainbox title="إدارة المنشآت" subtitle="يمكنك إنشاء وإدارة منشآت متعددة تحت حسابك.">
         <x-slot:icon>
             <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                 <path d="M12 12c1.83 0 3.18-1.49 3-3.32L14.34 2H9.67L9 8.68C8.82 10.51 10.17 12 12 12Z"
                     stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                 <path
                     d="M18.31 12c2.02 0 3.5-1.64 3.3-3.65l-.28-2.75C20.97 3 19.97 2 17.35 2H14.3l.7 7.01c.17 1.65 1.66 2.99 3.31 2.99ZM5.64 12c1.65 0 3.14-1.34 3.3-2.99l.22-2.21.48-4.8H6.59C3.97 2 2.97 3 2.61 5.6l-.27 2.75C2.14 10.36 3.62 12 5.64 12Z"
                     stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                 <g opacity=".4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                     stroke-linejoin="round">
                     <path d="M3.01 11.219v4.49c0 4.49 1.8 6.29 6.29 6.29h5.39c4.49 0 6.29-1.8 6.29-6.29v-4.49">
                     </path>
                     <path d="M12 17c-1.67 0-2.5.83-2.5 2.5V22h5v-2.5c0-1.67-.83-2.5-2.5-2.5Z"></path>
                 </g>
             </svg>
         </x-slot>
         <x-slot:actions>
             <ui:button @click.prevent="$dispatch('openmodal')" label="{{ __('Add tenant') }}" />
         </x-slot>

         <div class="mt-6 flex flex-col gap-y-1X divide-y divide-gray-100">
             @foreach ($tenants as $tenant)
                 <a href="{{ $tenant->dashboardUrl }}" class="flex group items-center gap-5 p-5  hover:bg-gray-50">
                     @if ($tenant->logo)
                         <img src="{{ $tenant->logo }}?p=logo" class="w-12 h-12 rounded-md" alt="">
                     @else
                         <img src="{{ asset('assets/images/t-logo.png') }}" class="w-12 h-12 rounded-md" alt="">
                     @endif
                     <div>
                         <h5 class="text-primary-800 group-hover:opacity-75 text-lg">
                             {{ $tenant->name }}
                             @if (currentTenant('id') == $tenant->id)
                                 <small class="bg-primary-50 p-1 px-2 rounded text-sm text-primary-700 italic">
                                     المنشأة الحالية </small>
                             @endif
                         </h5>
                         <small
                             class="text-gray-500">{{ data_get($tenant->meta, 'slogan.' . app()->getLocale()) }}</small>

                     </div>
                 </a>
             @endforeach
         </div>

         <ui:modal title="أضف منشأة جديدة" size="md">
             <x-admin::form wire:submit="submit">
                 <ui:input name="tenant_name" label="" width="w-full" placeholder="اسم المنشأة" />
                 <ui:input name="tenant_handle" dir="ltr" width="w-full" placeholder="subdomain-handle"
                     prefix="https://" suffix=".{{ config('app.domain') }}" />
                 <x-slot:footer>
                     <ui:button type="submit" wire-target="submit" label="{{ __('Save') }}" />
                 </x-slot>
                </x-admin::form>
         </ui:modal>

     </x-admin::mainbox>
 </x-admin::container>



 <?php
 use Catalog\Tenant\Models\Tenant;
 use Catalog\Tenant\Actions\CreateTenant;
 
 new class extends \Livewire\Volt\Component {
     public $plan_id = 1; // should be an option later when create new tenant / catalog
     public $tenant_name;
     public $tenant_handle;
 
     function mount()
     {
         $this->tenant_handle = generateKey(7);
     }
 
     protected function rules()
     {
         return [
             'tenant_name' => 'required|min:2|max:255',
             'tenant_handle' => 'required|min:2|string|max:255|unique:tenants,handle|alpha_dash|regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/',
         ];
     }
 
     function submit()
     {
         $this->validate();
 
         $tenant = CreateTenant::run([
                'tenant_name' => $this->tenant_name,
                'tenant_handle' => $this->tenant_handle,
                'user_id' => auth()->id(),
            ]); 
 
         $this->dispatch('notify', text: __('Tenant added successfully.'));
         $this->dispatch('closemodal');
         $this->redirect($tenant->dashboardUrl);
     }
 
     public function with(): array
     {
         return [
             'tenants' => Tenant::where('user_id', auth()->id())->latest('id')->get(),
         ];
     }
 
     public function rendering($view): void
     {
         $view->title(__('Tenants'))->layout('admin::layout');
     }
 };
 ?>
