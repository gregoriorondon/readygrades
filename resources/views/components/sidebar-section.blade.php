@props(['active' => false])

<a class="{{ $active ? 'bg-gray-700 hover:bg-gray-500': 'hover:bg-gray-700 hover:rounded-xl' }} transition-all flex items-center rounded-xl px-4 py-2 mt-2 font-inter" aria-current="{{ $active ? 'page': 'false'}}"{{ $attributes }}>{{ $slot }}</a>
