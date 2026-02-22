@if (!$errors->all())
    @if (session()->has('alert'))
        <div {{ $attributes }}>
            <p class="text-md text-green-500 bg-[#009d4d33] p-1 font-bold rounded-md font-inter">
                {{ session('alert') }}
            </p>
        </div>
    @endif
@else
    <div {{ $attributes }}>
        @foreach($errors->all() as $error)
            <p class="text-md text-[#E30000] bg-[#FFFC9C] p-1 font-bold rounded-md font-inter">
                {{ $error }}
            </p>
        @endforeach
    </div>
@endif
