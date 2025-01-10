<button {{ $attributes->merge(['type' => 'submit', 'style'=>'color:#fff;', 'class' => 'items-center px-4 py-2 bg-ready rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0F2167] focus:outline-none focus:ring-2 focus:ring-[#4CB9E7] focus:ring-offset-2 transition ease-in-out duration-150 w-full font-inter']) }}>
    {{ $slot }}
</button>
