@props([
    'class' => null,
    'value' => null,
    'name' => null,
    'type' => 'text',
    'inputWidth' => 'w-full',
    'disabled' => (bool)false,
    'label' => null,
    'items' => [],
    'focus' => false,
    'errormsg' => true,
    'dir' => null,
    'key' => null,
    'icon' => null,
    'description' => '',
    'info' => '',
    'width' => 'w-full',
    'placeholder' => '',
    'prefix' => null,
    'suffix' => null,
    'labelWidth' => 'w-36',
    'block' => false,
    'prime' => false,
    'infoDir' => null,
    'copyable' => false,
    'goto' => false,
])

@php $iconTrailing = $attributes->get('icon:trailing'); @endphp

<ui:field name="{{ $name }}" :info="$info" :label="__($label)" :prefix="$prefix" :suffix="$suffix" :dir="$dir" :infoDir="$infoDir" :width="$width" :labelWidth="$labelWidth" :errormsg="$errormsg" :key="$key" :block="$block" :prime="$prime">

    <div class="relative w-full">
 
        <div class="flex items-center gap-3">
            <!-- Image Preview --> 
            <div x-show="{{ $name }}" class="flex-shrink-0">
                <img :src="`{{ storage() }}`+{{ $name }}" alt="Preview" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
            </div>
            
            <!-- Upload Area -->
            <div class="flex-1" x-data="{ items: @js($items) }">
 
                <label x-show="items[{{ $name }}] !== null" :for="'upload-image-' + i" class="block">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-gray-400 transition-colors cursor-pointer">
                        <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <p class="mt-2 text-sm text-gray-600">اضغط لرفع الشعار</p>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG</p>
                    </div>
                </label>
                
                <input 
                    :id="'upload-image-' + i"
                    type="file" 
                    accept="image/*"
                    class="hidden"
                    @change="handleImageUpload(i, $event.target.files[0])"
                />
                
                <!-- Remove Image Button -->
                {{-- <div x-show="items[{{ $name }}] !== null" class="mt-2">
                    <button 
                        type="button"
                        @click="removeImage(i)"
                        class="text-xs text-red-500 hover:text-red-700"
                    >
                        حذف الصورة
                    </button>
                </div> --}}
            </div>
        </div>
     
    </div>
</ui:field>
