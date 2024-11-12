@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-#4272D8 focus:ring-#4CB9E7 rounded-md']) !!}>
