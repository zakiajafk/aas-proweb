@extends('layouts.app')

@section('title', 'Jadwal Booking')

@section('content')
<!-- Glow Bar atas -->
<div class="h-1 bg-gradient-to-r from-indigo-500/50 via-pink-500/50 to-purple-500/50 blur-sm rounded-b-full shadow"></div>

<!-- Header -->
<div class="flex justify-between items-center px-6 py-5 rounded-b-2xl bg-gradient-to-br from-[#0f172a] via-[#1e293b] to-[#111827] shadow-lg backdrop-blur border-b border-white/10">
    <a href="{{ route('home') }}" class="text-white hover:text-indigo-400 transition font-semibold flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Home
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-4 py-2 rounded-xl text-sm shadow-md transition">
            Logout
        </button>
    </form>
</div>

<!-- Content -->
<div 
    x-data="deleteModal()" 
    x-init="$el.classList.add('opacity-0', 'translate-y-5'); setTimeout(() => $el.classList.remove('opacity-0', 'translate-y-5'), 10)" 
    class="max-w-3xl mx-auto mt-12 p-8 rounded-2xl bg-[#111827] border border-white/10 shadow-xl transition duration-500 ease-out"
>
    <h2 class="text-3xl font-bold text-white mb-6 flex items-center gap-2">
        <svg class="w-7 h-7 text-indigo-500 drop-shadow-[0_0_4px_rgba(99,102,241,0.8)]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M4 11h16M4 19h16M4 11v8M20 11v8M4 19v2M20 19v2" />
        </svg>
        Jadwal Anda
    </h2>

    <div class="space-y-4">
        @forelse ($bookings as $booking)
            <div class="p-5 rounded-xl border border-white/10 bg-[#1e293b] hover:border-indigo-500/70 transition shadow-[0_8px_16px_rgba(0,0,0,0.25)] hover:shadow-[0_10px_20px_rgba(99,102,241,0.25)] relative">
                <div>
                    <div class="text-white font-semibold text-lg">
                        {{ \Carbon\Carbon::parse($booking->booking_time)->translatedFormat('l, d M Y H:i') }}
                    </div>
                    <div class="text-gray-300 text-sm mt-1">
                        Service: {{ $booking->service }}
                    </div>
                    <div class="text-gray-400 text-sm">
                        Lokasi: {{ $booking->location }}
                    </div>
                </div>

                <!-- Tombol Hapus -->
                <button 
                    @click="openDeleteModal({{ $booking->id }}, '{{ \Carbon\Carbon::parse($booking->booking_time)->translatedFormat('l, d M Y H:i') }}')" 
                    class="absolute top-4 right-4 bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1 rounded-lg transition"
                >
                    Hapus
                </button>
            </div>
        @empty
            <p class="text-gray-400">Belum ada jadwal booking.</p>
        @endforelse
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div 
        x-show="show"
        x-cloak
        x-transition
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/70 backdrop-blur-sm"
        @keydown.escape.window="show = false"
    >
        <div 
            class="bg-[#1f2937] text-white p-6 rounded-xl shadow-2xl w-full max-w-sm text-center border border-white/10 ring-1 ring-indigo-500/30 ring-offset-2"
            @click.outside="show = false"
        >
            <h2 class="text-xl font-bold mb-3">Konfirmasi Hapus</h2>
            <p class="text-sm text-gray-300 mb-4">
                Yakin ingin menghapus booking pada 
                <span class="font-semibold text-white" x-text="bookingTime"></span>?
            </p>

            <form :action="'/booking/' + bookingId" method="POST" class="space-y-3">
                @csrf
                @method('DELETE')
                <div class="flex justify-center gap-4">
                    <button 
                        type="submit"
                        class="bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-4 py-2 rounded-lg transition shadow"
                    >
                        Ya, Hapus
                    </button>
                    <button 
                        type="button" 
                        @click="show = false"
                        class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition shadow"
                    >
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function deleteModal() {
        return {
            show: false,
            bookingId: null,
            bookingTime: '',
            openDeleteModal(id, time) {
                this.bookingId = id;
                this.bookingTime = time;
                this.show = true;
            }
        }
    }
</script>
@endpush
