@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-lg font-inter']) }}>
    {{ $value ?? $slot }}
</label>
