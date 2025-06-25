@props(['icon'=>''])
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#4272D8] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0F2167] disabled:opacity-50 transition ease-in-out duration-150']) }}>
    @if($icon !== '')
        <i class="{{ $icon }}"></i>
    @endif
    {{ $slot }}
</button>
