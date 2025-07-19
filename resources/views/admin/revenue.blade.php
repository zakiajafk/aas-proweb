@extends('layouts.admin')

@section('title', 'Pendapatan')

@section('content')
<div class="bg-gray-800 rounded-xl shadow-lg overflow-x-auto w-full max-w-6xl">
    <table class="min-w-full text-sm text-white rounded-xl overflow-hidden">
        <thead class="bg-gray-700 text-left uppercase text-xs">
            <tr>
                <th class="px-6 py-4">Bulan</th>
                <th class="px-6 py-4">Jumlah Transaksi</th>
                <th class="px-6 py-4">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            @forelse ($monthlyRevenue as $data)
            <tr class="hover:bg-gray-700 transition-colors duration-200">
                <td class="px-6 py-4 font-medium">{{ $data->month }}</td>
                <td class="px-6 py-4">{{ $data->total_bookings }}</td>
                <td class="px-6 py-4 text-green-400 font-semibold">Rp {{ number_format($data->total_revenue, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center px-6 py-4 text-gray-400">Belum ada data pendapatan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
