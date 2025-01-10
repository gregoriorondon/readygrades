{{-- @props(['disabled' => false]) --}}

{{-- <input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-#4272D8 focus:ring-#4CB9E7 rounded-md']) !!}> --}}

<input {{ $attributes->merge(['class' => 'rounded-md border-solid p-1 px-4 border border-ready block mt-1 w-full focus:outline focus:outline-0']) }}>
