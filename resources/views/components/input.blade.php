@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-#4CB9E7 focus:ring-#4CB9E7 rounded-md shadow-sm']) !!}>
