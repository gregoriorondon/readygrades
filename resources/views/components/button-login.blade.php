<button {{ $attributes->merge(['type' => 'submit', 'class' => 'items-center px-4 py-2 bg-[#4272D8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0F2167] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-[#4CB9E7] focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150 w-full']) }}>
    {{ $slot }}
</button>
