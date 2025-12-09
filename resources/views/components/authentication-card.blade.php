<div class="min-h-screen flex flex-row sm:justify-center md:items-center pt-6 sm:pt-0 bg-white">
    <div class="w-full lg:max-w-[55%] mt-6 md:mt-none px-[10%] py-4 bg-white overflow-hidden">
        {{ $slot }}
    </div>

    <div class="hidden w-[35%] m-[21px] lg:block">
        {{ $logo }}
    </div>
</div>
