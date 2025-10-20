<div class="grid gap-y-6">

    <x-admin::mainbox title="الدومين المجاني"
        subtitle="تعديل الدومين الفرعي المجاني من {{config('app.name')}} في حال كنت لا تملك دومين مخصص بعد .">
        <x-slot:icon>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12s4.48 10 10 10"></path>
                <g opacity=".4">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M8 3h1a28.424 28.424 0 000 18H8M15 3c.97 2.92 1.46 5.96 1.46 9"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 16v-1c2.92.97 5.96 1.46 9 1.46M3 9a28.424 28.424 0 0118 0"></path>
                </g>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M18.2 21.4a3.2 3.2 0 100-6.4 3.2 3.2 0 000 6.4zM22 22l-1-1"></path>
            </svg>
        </x-slot:icon>

        <ui:form wire:submit="submitHandle">
            <ui:input name="handle" label="رابط ال{{config('app.name')}}" prefix="https://" suffix=".{{ config('app.domain') }}"
                dir="ltr" placeholder="your-company-handle" width="w-full" />
            <x-slot:footer>
                <ui:button wire-target="submitHandle" label="{{ __('Save') }}" />
            </x-slot>
        </ui:form>
    </x-admin::mainbox>

    {{-- {{ dd(tenant('subscription')) }} --}}
 
        <x-admin::mainbox :prime="false" title="دومين مخصص" subtitle="استخدم دومينك الخاص بدل الدومين الفرعي من {{config('app.name')}}.">
        <x-slot:icon>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12s4.48 10 10 10"></path>
                <g opacity=".4">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M8 3h1a28.424 28.424 0 000 18H8M15 3c.97 2.92 1.46 5.96 1.46 9"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 16v-1c2.92.97 5.96 1.46 9 1.46M3 9a28.424 28.424 0 0118 0"></path>
                </g>
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M18.2 21.4a3.2 3.2 0 100-6.4 3.2 3.2 0 000 6.4zM22 22l-1-1"></path>
            </svg>
        </x-slot:icon>

        <div class="p-4">
            <ui:callout color="blue" text=" قم بإضافة الدومين (النطاق) الخاص بك هنا.
                سنقوم بمراجعة الدومين وربطه، حال تفعيله وربطه بنجاح يمكنك استخدام الدومين الجديد لزيارة صفحاتك." />
        </div>

        <ui:form wire:submit="submit" formClass="flex flex-col gap-y-1">

            <ui:input name="domain" label="رابط الدومين الخاص" prefix="https://" dir="ltr"
                placeholder="you.com or blog.name.com" width="w-full" />

            <ui:field label="حالة الدومين" info="سيتم تحديث الحالة بعد تأكيد توجيه الدومين إلى نظام {{config('app.name')}}">

                @if ($approval)
                    <ui:callout color="yellow" class="mb-2"> 
                        <x-slot:text>
                             بإنتظار تفعيل الدومين المخصص
                            سيتم تحديث الحالة بعد تأكيد توجيه الدومين إلى نظام {{config('app.name')}}
                            ({{ data_get($approval, 'new_data.domain') }})
                        </x-slot>
                    </ui:callout>
                @endif

                <div x-data for="AcceptConditions" class="relative h-8 w-14 my-1" dir="ltr">
                    <input type="checkbox" id="AcceptConditions" @if ($tenant->domain_status) checked @endif
                        class="peer sr-only" />
                    <span class="absolute inset-0 rounded-full bg-gray-300 transition peer-checked:bg-green-500"></span>
                    <span
                        class="absolute inset-y-0 end-0 m-1 h-6 w-6 rounded-full bg-white transition-all peer-checked:end-6"></span>
                </div>
            </ui:field>

            <ui:callout color="blue">
                <x-slot:text>
                لا تنسى تعديل سجلات DNS
                للدومين الجديد لتوجييه لاستخدام {{config('app.name')}}
                <br>
                أضف سجل DNS من نوع  <b class="bg-yellow-200 inline-block p-0.5 px-1 rounded">CName</b> مع القيمة <b
                    class="bg-yellow-200 inline-block p-0.5 px-1 rounded">host.{{ config('app.domain') }}</b> من داخل حسابك في موقع مقدم خدمة الدومين. <br>
                إذا احتجت لأي
                مساعدة، تواصل معنا في أي وقت.
                </x-slot>
            </ui:callout>


            @if ($approval)
                {{-- {{ data_get($approval, 'new_data.domain') }} :
             {{ data_get($approval, 'state') }} --}}
            @else
                <x-slot:footer>
                    <ui:button wire-target="submit" label="{{ __('Change custom domain') }}" />
                </x-slot>
            @endif



        </ui:form>

    </x-admin::mainbox>
</div>

<?php

use App\Models\Tenant;

new class extends Livewire\Volt\Component {
    public $tenant;
    public $domain;
    public $handle;
    public $approval;
 
    function mount()
    {
        $this->tenant = currentTenant();
        $this->handle = $this->tenant->handle;

        //$this->domain = data_get($this->tenant->approvals()->where('state', 'pending')->latest('id')->first(), 'new_data.domain') ?: $this->tenant->domain;
        $this->domain = $this->tenant->domain;

        //$this->approval = $this->tenant->approvals()->where('state', 'pending')->latest('id')->first() ?: null;

        //  $this->approve();
    }

    function submit()
    {
        $this->validate([
            'domain' => 'required|max:255|unique:tenants,domain,' . tenant('id') . '|regex:/^(?:[a-z0-9](?:[a-z0-9-æøå]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$/isu',
        ]);

        if ($this->tenant->domain != $this->domain) {
            $this->tenant->domain = $this->domain;
            $this->tenant->domain_status = false;

            $this->tenant->save();
            $this->mount();
        }

        $this->dispatch('notify', text: __('Domain updated successfully.'));
    }

    function submitHandle()
    {
        $this->validate([
            'handle' => ['nullable', 'min:2', 'string', 'max:155', 'unique:tenants,handle,' . $this->tenant->id, 'alpha_dash', 'regex:/^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/'],
        ]);
 
        $this->tenant->handle = $this->handle;

        $this->tenant->save();

        $this->dispatch('notify', text: __('Domain updated successfully.'));
    }

    function approve()
    {

        $this->tenant->domain_status = true;
        $this->tenant->save();
        $this->approval->approveIf(true);

        $this->dispatch('notify', text: __('Domain approved successfully!!'));
    }
}; ?>
