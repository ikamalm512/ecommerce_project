<div class="relative">
    <select
        {{ $attributes->merge([
            'class' => '
                w-full
                px-4
                py-2.5
                border border-gray-300
                rounded-lg
                shadow-sm
                text-gray-800
                bg-white
                outline-none
                transition-all
                duration-300
                ease-in-out
                focus:border-[#4e73df]
                focus:ring-4
                focus:ring-[#4e73df]/20
                hover:border-[#4e73df]
                hover:shadow-md
                transform
                hover:-translate-y-[1px]
                appearance-none
                cursor-pointer
            '
        ]) }}
    >
        {{ $slot }}
    </select>

