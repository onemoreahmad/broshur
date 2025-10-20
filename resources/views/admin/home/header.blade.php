<div>
    <ui:callout icon="info-circle" color="blue" inline>
        <x-slot name="text"> هيدر البروشور الرئيسي.</x-slot>
        {{-- <x-slot name="action" class="@md:h-full m-0!">
            <rasm:button variant="primary" icon:trailing="arrow-left" wire-target="saveAndNext" class="cursor-pointer" wire:click="saveAndNext"> التالي </rasm:button>
        </x-slot> --}}
    </ui:callout>
 
    <div class="mt-5 max-w-3xl">
        <form wire:submit="save" class="flex flex-col gap-y-6">
             
            <!-- Basic Information -->
            <div class="bg-gray-50 rounded-lg p-3">
              
 
            <ui:input 
                name="name" 
                label="الاسم" 
               
            />
             
            </div>
 
            <div class="flex mt-5 border-t border-gray-200 pt-3 border-dashed">
                <ui:button 
                    wire-target="save" 
                    wire-action="submit" 
                    variant="primary" 
                    icon="check" 
                    type="submit" 
                    class="cursor-pointer"
                > 
                    حفظ التعديلات 
                </ui:button>
            </div>
        </form>
    </div>
</div>

<?php
use App\Models\Block;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Renderless;
 
new class extends \Livewire\Volt\Component {
    use WithFileUploads;
 
    public $block;
    public $name;
    public $profileImage;
 
    public function mount() {
        $this->block =  Block::firstOrCreate(['name'=> 'header']);
        
        $this->name = data_get($this->block, 'config.name', '');
    }

    public function updatedProfileImage() {
        if ($this->profileImage instanceof TemporaryUploadedFile) {
            $this->tempProfileImageUrl = $this->profileImage->temporaryUrl();
        }
    }

    public function rules() {
        $rules = [
            'name' => 'required|string',
        ];

        // Only validate profile image if a new image is being uploaded
        if ($this->profileImage instanceof TemporaryUploadedFile) {
            $rules['profileImage'] = 'image|max:5048'; // 2MB max
        }
 
        return $rules;
    }

    public function save($showMessage = true) {   
        $this->validate();
 
        // Update personal data
        $this->block->config->name = $this->name;
 
        if ($this->profileImage instanceof TemporaryUploadedFile) {
            //$this->cv->personal->profile_image = $this->profileImage->store('cv_images');
        }
        
        $this->block->save();
 
        $this->dispatch('notify', type:'success', text:'تم حفظ التعديلات بنجاح'); 
    }
 

    #[Renderless]
    public function autoSave() {
        $this->save(false);
    }

    function placeholder() {
        return loadingIcon();
    }
}; ?>