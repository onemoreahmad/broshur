@props([
    'items' => [],
    'fields' => [],
    'imageField' => 'logo',
    'addLabel' => 'أضف عنصر',
])
    
<div x-data="{
         items: @js($items),
         items: @entangle('items'),
         newItem: false,
         init() {
             if (this.items.length == 0) {
                 this.addItem()
             }
         },
         addItem() {
             var fields =  @js($fields) ;
      
             var item =  { id: parseInt(Math.random() * 10) + 1, ...fields} ;

             this.items.push(item)
         },
         removeItem(i) {
             this.items.splice(i, 1)
         },
         handleImageUpload(itemIndex, file) {
             if (file) {
                 // Create a temporary URL for preview
                 const reader = new FileReader();
                 reader.onload = (e) => {
                     this.items[itemIndex]['{{ $imageField }}'] = e.target.result;
                 };
                 reader.readAsDataURL(file);
                 
                 // Use Livewire's upload method for the specific item
                 @this.upload('items.' + itemIndex + '.' + '{{ $imageField }}', file, () => {
                     console.log('Upload started');
                 }, () => {
                     console.log('Upload completed');
                 }, (event) => {
                     console.log('Upload progress:', event.detail.progress);
                 });
             }
         },
         removeImage(itemIndex) {
             this.items[itemIndex]['{{ $imageField }}'] = null;
         }
     }" x-cloak class="flex flex-col gap-y-1">
         <div wire:ignore x-id="['list-item']">
             <template x-for="(item, i) in items" :key="i">
                 <div class="mb-2 bg-gray-100 p-1 rounded-lg relative">

                     <ui:button @click.prevent="removeItem(i)" label="x"
                         class=" !bg-red-100 !text-red-500 !hover:text-red-500 !text-xs !hover:bg-red-300 flex-shrink-0 !px-2 !py-1 absolute top-0 rtl:left-0 ltr:right-0 z-40 !no-underline" />

                     <span x-text="i + 1" class="bg-primary-100 text-black/40 text-xs rounded-md px-2 py-1 absolute top-0 rtl:left-0 ltr:right-0 z-40 me-6"></span>
 
                     {{ $slot }}
                 </div>
             </template>
         </div>

         <div class="mt-3">
             <ui:button @click.prevent="addItem" icon="plus" variant="outline" label="{{ $addLabel }}" />
         </div>
     </div>