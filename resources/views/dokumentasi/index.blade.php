@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Dokumentasi</h1>
            <p class="text-gray-600">Koleksi dokumentasi dan panduan sistem</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($dokumentasi as $doc)
                <div class="bg-white/50 backdrop-blur-sm rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <!-- Gambar -->
                    <div class="aspect-video overflow-hidden">
                        @if($doc->gambar)
                            <img src="{{ $doc->gambar_url }}" 
                                 alt="Dokumentasi" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Konten -->
                    <div class="p-6">
                        <p class="text-gray-700 leading-relaxed line-clamp-4">{{ $doc->deskripsi }}</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                {{ $doc->created_at->format('d M Y') }}
                            </span>
                            <button class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                Baca Selengkapnya
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <div class="text-gray-400 text-xl mb-2">📚</div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada dokumentasi</h3>
                    <p class="text-gray-500">Dokumentasi akan muncul di sini setelah ditambahkan</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection