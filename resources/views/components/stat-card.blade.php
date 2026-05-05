@props(['judul', 'nilai', 'ikon' => '📊', 'warna' => '#DC0000'])

<div class="stat-card" style="background: rgba(0,0,0,0.6); backdrop-filter: blur(8px); border-radius: 16px; padding: 20px; text-align: center; border: 1px solid {{ $warna }}; min-width: 150px;">
    <div style="font-size: 32px; margin-bottom: 10px;">{{ $ikon }}</div>
    <div style="font-size: 28px; font-weight: bold; color: {{ $warna }};">{{ $nilai }}</div>
    <div style="font-size: 14px; color: #ccc;">{{ $judul }}</div>
</div>
