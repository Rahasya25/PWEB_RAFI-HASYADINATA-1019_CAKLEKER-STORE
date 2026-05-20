@extends('layouts.app')
@section('title', 'Manajemen')
@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Manajemen Toko</h1>
    <p class="mt-4 text-gray-600 dark:text-gray-300">Halaman manajemen akan segera hadir.</p>

    <!-- Section Statistik Kunjungan -->
    <div class="mt-10 p-6 bg-gray-800 dark:bg-gray-200 rounded-lg shadow">
        <h2 class="text-xl font-bold text-white dark:text-gray-800 mb-4">Statistik Kunjungan Halaman</h2>
        <div class="space-y-2 text-gray-300 dark:text-gray-700">
            <p>Jumlah kunjungan: <strong id="visit-count">{{ $visit_count ?? 0 }}</strong></p>
            <p>Kunjungan pertama: <strong>{{ isset($first_visit) ? \Carbon\Carbon::parse($first_visit)->format('d/m/Y H:i:s') : '-' }}</strong></p>
            <p>Kunjungan terakhir: <strong>{{ isset($last_visit) ? \Carbon\Carbon::parse($last_visit)->format('d/m/Y H:i:s') : '-' }}</strong></p>
        </div>
        <button id="reset-stats" class="mt-4 bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">Reset Hitungan</button>
        <div id="reset-msg" class="mt-2"></div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('reset-stats')?.addEventListener('click', async function() {
        try {
            const response = await fetch('{{ route("manajemen.reset") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const data = await response.json();
            document.getElementById('reset-msg').innerHTML = `<div class="text-green-500">${data.message}</div>`;
            setTimeout(() => location.reload(), 1000);
        } catch (error) {
            document.getElementById('reset-msg').innerHTML = '<div class="text-red-500">Gagal mereset hitungan.</div>';
        }
    });
</script>
@endpush
@endsection
