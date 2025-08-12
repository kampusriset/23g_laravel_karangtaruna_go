@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Diskusi Internal</h1>
            <p class="text-gray-600">Forum diskusi untuk tim internal</p>
        </div>

        <div class="space-y-6">
            @forelse($diskusi as $diskusiItem)
                <div class="bg-white/50 backdrop-blur-sm rounded-xl shadow-lg p-6 hover:shadow-xl transition-all duration-300">
                    <!-- Header dengan foto profil -->
                    <div class="flex items-start space-x-4 mb-4">
                        <div class="flex-shrink-0">
                            @if($diskusiItem->user->avatar ?? null)
                                <img src="{{ $diskusiItem->user->avatar }}" 
                                     alt="{{ $diskusiItem->user->name }}" 
                                     class="w-12 h-12 rounded-full object-cover ring-2 ring-white shadow-md">
                            @else
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white font-semibold text-lg shadow-md">
                                    {{ substr($diskusiItem->user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2">
                                <h3 class="font-semibold text-gray-900">{{ $diskusiItem->user->name }}</h3>
                                <span class="text-sm text-gray-500">•</span>
                                <span class="text-sm text-gray-500">{{ $diskusiItem->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Teks diskusi -->
                    <div class="mb-4">
                        <p class="text-gray-700 leading-relaxed">{{ $diskusiItem->teks }}</p>
                    </div>

                    <!-- Tombol komentar dan counter -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div class="flex items-center space-x-4">
                            <button onclick="toggleComments({{ $diskusiItem->id }})" 
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Komentar
                            </button>
                            
                            @if($diskusiItem->komentar->count() > 0)
                                <span class="text-sm text-gray-500 font-medium">
                                    {{ $diskusiItem->komentar->count() }} komentar
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Area komentar (tersembunyi secara default) -->
                    <div id="comments-{{ $diskusiItem->id }}" class="hidden mt-6 pt-6 border-t border-gray-200">
                        <!-- Daftar komentar yang sudah ada -->
                        @if($diskusiItem->komentar->count() > 0)
                            <div class="space-y-4 mb-6">
                                @foreach($diskusiItem->komentar as $komentar)
                                    <div class="flex items-start space-x-3 bg-gray-50/50 rounded-lg p-4">
                                        <div class="flex-shrink-0">
                                            @if($komentar->user->avatar ?? null)
                                                <img src="{{ $komentar->user->avatar }}" 
                                                     alt="{{ $komentar->user->name }}" 
                                                     class="w-8 h-8 rounded-full object-cover">
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-500 to-teal-600 flex items-center justify-center text-white font-semibold text-xs">
                                                    {{ substr($komentar->user->name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span class="font-medium text-gray-900 text-sm">{{ $komentar->user->name }}</span>
                                                <span class="text-xs text-gray-500">{{ $komentar->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="text-gray-700 text-sm">{{ $komentar->teks }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Form komentar baru -->
                        <form action="{{ route('diskusi.komentar.store', $diskusiItem) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <textarea name="teks" 
                                         rows="3" 
                                         placeholder="Tulis komentar Anda..." 
                                         required
                                         class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none transition-colors duration-200"></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" 
                                        class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Kirim Komentar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="text-gray-400 text-6xl mb-4">💬</div>
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada diskusi</h3>
                    <p class="text-gray-500">Mulai diskusi baru melalui panel admin</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
function toggleComments(diskusiId) {
    const commentsDiv = document.getElementById('comments-' + diskusiId);
    if (commentsDiv.classList.contains('hidden')) {
        commentsDiv.classList.remove('hidden');
        commentsDiv.style.animation = 'slideDown 0.3s ease-out';
    } else {
        commentsDiv.classList.add('hidden');
    }
}

// CSS Animation
const style = document.createElement('style');
style.textContent = `
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
`;
document.head.appendChild(style);
</script>
@endsection

