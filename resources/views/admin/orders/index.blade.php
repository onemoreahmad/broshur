 <x-admin::layout>
    <x-admin::container>
        <div class="lg:grid grid-cols-12 gap-8">
            <div class="col-span-12 xl:col-span-8 relative">
                <x-admin::mainbox title="الطلبات" subtitle="إدارة طلبات, يمكنك إدارة الطلبات هنا..">
                    <x-slot:icon>
                        <ui:icon name="message-2"  />
                    </x-slot:icon>
       
                    <livewire:admin.orders._table lazy />
         
                </x-admin::mainbox>
            </div>
            <div class="col-span-1 lg:col-span-2 relative">
                
            </div>
        </div>
    </x-admin::container>
</x-admin::layout>

<?php 
 
new 
#[\Livewire\Attributes\Title('تحويل : إدارة صفحات الهبوط')]
class extends \Livewire\Volt\Component {
     
}; ?>


