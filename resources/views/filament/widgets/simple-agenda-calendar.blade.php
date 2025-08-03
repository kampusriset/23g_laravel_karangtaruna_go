{{-- resources/views/filament/widgets/simple-agenda-calendar.blade.php --}}

<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-6">
            {{-- Header --}}
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    Agenda Kegiatan
                </h3>
                <div class="text-sm text-gray-500 dark:text-gray-400">
                    {{ $currentDate->format('d F Y') }}
                </div>
            </div>

            {{-- Statistics Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-200 dark:border-blue-800">
                    <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                        {{ $agendaHariIni->count() }}
                    </div>
                    <div class="text-sm text-blue-700 dark:text-blue-300">Hari Ini</div>
                </div>
                
                <div class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg border border-green-200 dark:border-green-800">
                    <div class="text-2xl font-bold text-green-600 dark:text-green-400">
                        {{ $agendaMingguIni->count() }}
                    </div>
                    <div class="text-sm text-green-700 dark:text-green-300">Minggu Ini</div>
                </div>
                
                <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg border border-yellow-200 dark:border-yellow-800">
                    <div class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">
                        {{ $agendaBulanIni->count() }}
                    </div>
                    <div class="text-sm text-yellow-700 dark:text-yellow-300">Bulan Ini</div>
                </div>
                
                <div class="bg-purple-50 dark:bg-purple-900/20 p-4 rounded-lg border border-purple-200 dark:border-purple-800">
                    <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                        {{ $agendaMendatang->count() }}
                    </div>
                    <div class="text-sm text-purple-700 dark:text-purple-300">Mendatang</div>
                </div>
            </div>

            {{-- Agenda Lists --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Agenda Hari Ini --}}
                <div>
                    <h4 class="text-md font-semibold mb-3 text-gray-900 dark:text-gray-100 flex items-center">
                        <x-heroicon-m-calendar-days class="w-5 h-5 mr-2 text-blue-500" />
                        Agenda Hari Ini
                    </h4>
                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @forelse($agendaHariIni as $agenda)
                            <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                                <div class="text-sm font-medium text-blue-900 dark:text-blue-100 mb-1">
                                    {{ $agenda->nama_agenda }}
                                </div>
                                <div class="text-xs text-blue-700 dark:text-blue-300 flex items-center">
                                    <x-heroicon-m-clock class="w-4 h-4 mr-1" />
                                    @if($agenda->waktu_mulai && $agenda->waktu_selesai)
                                        {{ $agenda->waktu_mulai->format('H:i') }} - {{ $agenda->waktu_selesai->format('H:i') }}
                                    @elseif($agenda->waktu_mulai)
                                        {{ $agenda->waktu_mulai->format('H:i') }}
                                    @else
                                        Waktu belum ditentukan
                                    @endif
                                </div>
                                @if($agenda->deskripsi)
                                    <div class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                                        {{ Str::limit($agenda->deskripsi, 60) }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                <x-heroicon-m-exclamation-circle class="w-8 h-8 mx-auto mb-2 opacity-50" />                                <p class="text-sm">Tidak ada agenda hari ini</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Agenda Mendatang --}}
                <div>
                    <h4 class="text-md font-semibold mb-3 text-gray-900 dark:text-gray-100 flex items-center">
                        <x-heroicon-m-forward class="w-5 h-5 mr-2 text-green-500" />
                        Agenda Mendatang
                    </h4>
                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        @forelse($agendaMendatang as $agenda)
                            <div class="p-3 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                                <div class="text-sm font-medium text-green-900 dark:text-green-100 mb-1">
                                    {{ $agenda->nama_agenda }}
                                </div>
                                <div class="text-xs text-green-700 dark:text-green-300 space-y-1">
                                    <div class="flex items-center">
                                        <x-heroicon-m-calendar-days class="w-4 h-4 mr-1" />
                                        {{ $agenda->tanggal->format('d M Y') }}
                                    </div>
                                    <div class="flex items-center">
                                        <x-heroicon-m-clock class="w-4 h-4 mr-1" />
                                        @if($agenda->waktu_mulai && $agenda->waktu_selesai)
                                            {{ $agenda->waktu_mulai->format('H:i') }} - {{ $agenda->waktu_selesai->format('H:i') }}
                                        @elseif($agenda->waktu_mulai)
                                            {{ $agenda->waktu_mulai->format('H:i') }}
                                        @else
                                            Waktu belum ditentukan
                                        @endif
                                    </div>
                                </div>
                                @if($agenda->deskripsi)
                                    <div class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                                        {{ Str::limit($agenda->deskripsi, 60) }}
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                                <x-heroicon-m-exclamation-circle class="w-8 h-8 mx-auto mb-2 opacity-50" />                                <p class="text-sm">Tidak ada agenda mendatang</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>