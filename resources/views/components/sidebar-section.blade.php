@props(['active'=>false, 'link'=>'', 'icon' => ''])

@php
    $active = request()->is($link) || request()->routeIs($link);
@endphp

<a href="/{{ $link }}" class="{{ $active ? 'bg-gray-700 hover:bg-gray-500' : 'hover:bg-gray-700 hover:rounded-xl' }} transition-all flex items-center rounded-xl px-4 py-2 mt-2 font-inter"
    aria-current="{{ $active ? 'page' : 'false' }}"{{ $attributes }}><i class="{{ $icon }}"></i>
    {{ $slot }}
</a>
