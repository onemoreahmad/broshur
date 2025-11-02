<template>
    <div class="
bg-slate-200 hover:bg-slate-100 border-slate-300
bg-gray-200 hover:bg-gray-100 border-gray-300
bg-zinc-200 hover:bg-zinc-100 border-zinc-300
bg-neutral-200 hover:bg-neutral-100 border-neutral-300
bg-stone-200 hover:bg-stone-100 border-stone-300
bg-red-200 hover:bg-red-100 border-red-300
bg-orange-200 hover:bg-orange-100 border-orange-300
bg-amber-200 hover:bg-amber-100 border-amber-300
bg-yellow-200 hover:bg-yellow-100 border-yellow-300
bg-lime-200 hover:bg-lime-100 border-lime-300
bg-green-200 hover:bg-green-100 border-green-300
bg-emerald-200 hover:bg-emerald-100 border-emerald-300
bg-teal-200 hover:bg-teal-100 border-teal-300
bg-cyan-200 hover:bg-cyan-100 border-cyan-300
bg-sky-200 hover:bg-sky-100 border-sky-300
bg-blue-200 hover:bg-blue-100 border-blue-300
bg-indigo-200 hover:bg-indigo-100 border-indigo-300
bg-violet-200 hover:bg-violet-100 border-violet-300
bg-purple-200 hover:bg-purple-100 border-purple-300
bg-fuchsia-200 hover:bg-fuchsia-100 border-fuchsia-300
bg-pink-200 hover:bg-pink-100 border-pink-300
bg-rose-200 hover:bg-rose-100 border-rose-300
    "></div>
    <fieldset class="fieldset bg-base-200/50 rounded-box p-4">
        <legend class="fieldset-legend">{{ label }}</legend>
     
        <div class="w-full mt-1 flex items-center gap-2 flex-wrap">

            <label class="input radio-input radio-input-sm w-fit cursor-pointer "
                v-for="(item,key) in options" 
                :key="key"
                :class="`bg-${item}-200 hover:bg-${item}-100  border-${item}-300`"
            > 
                <input
                    type="radio"
                    :value="item"
                    :checked="modelValue == item"
                    @change="$emit('update:modelValue', $event.target.value)"
                    class="radio radio-neutral radio-xs">
                    <span class="capitalize text-xs lg:block hidden">{{item}}  </span>
            </label>

            <div class="text-xs text-gray-400 leading-2 p-1" v-if="help">{{help}}</div>
        </div>            
    </fieldset>
</template>

<script setup>
 
const props = defineProps(['modelValue',  'options', 'themeOptions', 'model', 'options',  'label', 'placeholder', 'validationErrors', 'help', 'ltr', 'female'])
  

</script>