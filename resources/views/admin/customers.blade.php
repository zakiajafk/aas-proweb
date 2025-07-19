@extends('layouts.admin')

@section('title', 'Data Pelanggan Terbaru')

@section('content')
<div class="bg-gray-800 rounded-xl shadow-lg overflow-x-auto w-full max-w-6xl">
    <table class="min-w-full text-sm text-white rounded-xl overflow-hidden">
        <thead class="bg-gray-700 text-left uppercase text-xs">
            <tr>
                <th class="px-6 py-4">No</th>
                <th class="px-6 py-4">Nama</th>
                <th class="px-6 py-4">Email</th>
                <th class="px-6 py-4">Layanan</th>
                <th class="px-6 py-4">Tanggal</th>
                <th class="px-6 py-4">Lokasi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            @forelse ($bookings as $no => $row)
                <tr class="hover:bg-gray-700 transition-colors duration-200">
                    <td class="px-6 py-4">{{ $no + 1 }}</td>
                    <td class="px-6 py-4">{{ $row->user->username }}</td>
                    <td class="px-6 py-4">{{ $row->user->email }}</td>
                    <td class="px-6 py-4">{{ $row->service }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($row->booking_time)->format('d M Y H:i') }}</td>
                    <td class="px-6 py-4">{{ $row->location }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center px-6 py-4 text-gray-400">Belum ada data pelanggan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
