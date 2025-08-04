{{-- resources/views/filament/widgets/banner-widget.blade.php --}}
<x-filament-widgets::widget>
    <x-filament::section>
        <div class="relative">
            <img src="{{ $bannerImage }}" 
                 alt="Banner Dashboard" 
                 class="w-full h-48 md:h-64 object-cover rounded-lg shadow-lg">
            
            @if(isset($title) || isset($subtitle))
                <div class="absolute inset-0 bg-black bg-opacity-30 rounded-lg flex items-center justify-center">
                    <div class="text-center text-white">
                        @if(isset($title))
                            <h2 class="text-2xl md:text-4xl font-bold mb-2">{{ $title }}</h2>
                        @endif
                        @if(isset($subtitle))
                            <p class="text-sm md:text-lg">{{ $subtitle }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
