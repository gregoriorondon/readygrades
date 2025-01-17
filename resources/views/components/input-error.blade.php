@props(['name'])

@error($name)
    <p {{ $attributes->merge(['class' => 'text-md text-[#E30000] bg-[#FFFC9C] p-1 font-bold rounded-md font-inter mt-2']) }}>{{ $message }}</p>
@enderror
