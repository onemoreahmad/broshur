@props([
    'class' => null,
    'value' => null,
    'name' => null,
    'type' => 'text',
    'inputWidth' => 'w-full',
    'label' => null,
    'disabled' => false,
    'focus' => false,
    'dir' => '',
    'info' => '',
    'width' => 'full',
    'placeholder' => '',
])

<ui:field name="{{ $name }}" info="{{ $info }}" label="{{ __($label) }}" id="rating-{{ $name }}">
        <div class="flex items-center" >
            <div x-data="
                {
                rating: $wire.entangle('{{$name}}'),
                hoverRating: $wire.entangle('{{$name}}'),
                    ratings: [{'amount': 1, 'label':'سيئ 😣'}, {'amount': 2, 'label':'مُخيّب 🥲'}, {'amount': 3, 'label':'جيّد 👍'}, {'amount': 4, 'label':'رائع 🥰'}, {'amount': 5, 'label':'استثنائي 🤩'}],
                    rate(amount) {
                        this.rating = amount;
                    },
                currentLabel() {
                    let r = this.rating;
                        let i = this.ratings.findIndex(e => e.amount == r);
                    if (i >=0) {return this.ratings[i].label;} else {return ''};     
                    }
                }
                " 
                {{ $attributes }}
                class="flex items-center ">
              <div class="flex items-center gap-x-4 justify-between">
                <div >
                    <template x-for="(star, index) in ratings" :key="index">
                        <button @click.prevent="rate(star.amount)" 
                            aria-hidden="true"
                            :title="star.label"
                            class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline mx-1 m-0  cursor-pointer hover:text-yellow-500"
                            :class="{ 'text-yellow-400': rating >= star.amount }">
                            <svg class="w-6 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span x-text="index+1" class="text-[10px] text-gray-400 block -mt-0.5"></span>
                        </button>
                
                    </template>
                </div>
              
                <template x-if="rating ">
                      <p x-text="currentLabel()" class="text-sm text-gray-500" ></p>
                </template>
               
                </div>
            
            </div>
            </div>



        {{ $slot }}
</ui:field>
