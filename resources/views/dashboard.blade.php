@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="hero-content">
    <div>
        <a href="{{ route('produk.index') }}" class="btn">Halo {{ auth()->user()->name }}, ayo jelajahi toko!</a>
    </div>
    <p class="hero-desc">
        Cakleker Store adalah toko merchandise Scuderia Ferrari terpercaya di Indonesia.
        Temukan koleksi eksklusif kaos, topi, diecast, dan aksesoris untuk para Tifosi sejati.
    </p>
    <div class="hero-stats">
        <div><div class="stat-number">5+</div><div class="stat-label">Tahun Berdiri</div></div>
        <div><div class="stat-number">200</div><div class="stat-label">Tifosi Puas</div></div>
    </div>
    <div class="hero-promo">🏎️ Gratis ongkir untuk pembelian di atas Rp500.000 &nbsp;•&nbsp; Garansi original merchandise 🏎️</div>
</div>

<div class="championship-section">
    <h2>Kejuaraan F1 (Data Historis 2024)</h2>
    <div class="championship-grid">
        <div class="championship-card">
            <h3>Drivers Championship</h3>
            <div id="drivers-championship" class="loading-indicator">Memuat data...</div>
        </div>
        <div class="championship-card">
            <h3>Constructors Championship</h3>
            <div id="teams-championship" class="loading-indicator">Memuat data...</div>
        </div>
        <div class="championship-card">
            <h3>Hasil Sesi Terakhir</h3>
            <div id="session-result" class="loading-indicator">Memuat data...</div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', async () => {
        const fetchData = async (url) => {
            const res = await fetch(url);
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            return res.json();
        };
        const driversUrl = 'https://api.jolpi.ca/ergast/f1/2024/driverstandings/';
        const constructorsUrl = 'https://api.jolpi.ca/ergast/f1/2024/constructorstandings/';
        const sessionUrl = 'https://api.jolpi.ca/ergast/f1/2024/last/results/';
        try {
            const [driversData, constructorsData, sessionData] = await Promise.all([
                fetchData(driversUrl), fetchData(constructorsUrl), fetchData(sessionUrl)
            ]);
            const driversContainer = document.getElementById('drivers-championship');
            const driverStandings = driversData?.MRData?.StandingsTable?.StandingsLists?.[0]?.DriverStandings;
            if (driverStandings) {
                let html = '<ul class="championship-list">';
                driverStandings.forEach(item => {
                    html += `<li><span>${item.position}. ${item.Driver.givenName} ${item.Driver.familyName}</span><span>${item.points} pts</span></li>`;
                });
                html += '</ul>';
                driversContainer.innerHTML = html;
            } else driversContainer.innerHTML = '<p>Data tidak tersedia</p>';

            const constructorsContainer = document.getElementById('teams-championship');
            const constructorStandings = constructorsData?.MRData?.StandingsTable?.StandingsLists?.[0]?.ConstructorStandings;
            if (constructorStandings) {
                let html = '<ul class="championship-list">';
                constructorStandings.forEach(item => {
                    html += `<li><span>${item.position}. ${item.Constructor.name}</span><span>${item.points} pts</span></li>`;
                });
                html += '</ul>';
                constructorsContainer.innerHTML = html;
            } else constructorsContainer.innerHTML = '<p>Data tidak tersedia</p>';

            const sessionContainer = document.getElementById('session-result');
            const race = sessionData?.MRData?.RaceTable?.Races?.[0];
            if (race && race.Results) {
                let html = `<p style="margin-bottom:12px; font-weight:bold;">${race.raceName}</p><ul class="championship-list">`;
                race.Results.forEach(r => {
                    html += `<li>${r.position}. ${r.Driver.givenName} ${r.Driver.familyName} - ${r.Constructor.name}</li>`;
                });
                html += '</ul>';
                sessionContainer.innerHTML = html;
            } else sessionContainer.innerHTML = '<p>Data tidak tersedia</p>';
        } catch (error) {
            document.querySelectorAll('#drivers-championship, #teams-championship, #session-result').forEach(el => {
                el.innerHTML = '<p>Gagal memuat data.</p>';
            });
        }
    });
</script>
@endpush
@endsection
