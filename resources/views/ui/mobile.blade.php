@props([
    'width' => 'w-[368px]',
    'bg' => 'bg-white',
])
<div {{ $attributes->class('relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[10px] rounded-[2.5rem] h-[700px] w-[390px] [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none] ') }} dir="ltr">
    <div class="h-[32px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[27px] top-[72px] rounded-s-lg"></div>
    <div class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[124px] rounded-s-lg"></div>
    <div class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[178px] rounded-s-lg"></div>
    <div class="h-[64px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -end-[17px] top-[142px] rounded-e-lg"></div>
    <div class="rounded-[2rem] overflow-hidden {{$width}} h-[672px] {{$bg}} dark:bg-gray-800 overflow-y-scroll ">
        {{ $slot }}
    </div>
</div>
