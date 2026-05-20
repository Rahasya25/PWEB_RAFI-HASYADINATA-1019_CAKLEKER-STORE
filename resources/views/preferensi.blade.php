@extends('layouts.app')
@section('title', 'Preferensi')
@section('content')
<div class="form-section" style="max-width: 600px; margin: 60px auto; padding: 0 20px;">
    <div class="form-header" style="border-left-color: #DC0000;">
        <h1 style="font-size: 28px;">Pengaturan Tampilan</h1>
        <p>Atur tema dan ukuran font</p>
    </div>
    <div class="form-card" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.08); border-radius: 8px; padding: 30px;">
        <form id="pref-form">
            @csrf
            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #FFD700; font-size: 12px; letter-spacing: 1px;">Tema</label>
                <select name="theme" style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 4px; color: white;">
                    <option value="dark">Gelap</option>
                    <option value="light">Terang</option>
                    <option value="system">Sistem</option>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; color: #FFD700; font-size: 12px; letter-spacing: 1px;">Ukuran Font</label>
                <select name="font_size" style="width: 100%; padding: 10px; background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 4px; color: white;">
                    <option value="14px">Kecil</option>
                    <option value="16px">Normal</option>
                    <option value="18px">Besar</option>
                </select>
            </div>
            <div class="form-actions" style="display: flex; gap: 12px; margin-top: 24px;">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <div id="msg" style="margin-top: 20px;"></div>
    </div>
</div>
<script>
    document.getElementById('pref-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const response = await fetch('{{ route("preferensi.store") }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        });
        const result = await response.json();
        document.getElementById('msg').innerHTML = `<div style="color: #4CAF50;">${result.message}</div>`;
        const theme = formData.get('theme');
        if (theme === 'light') {
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.add('light');
        } else if (theme === 'dark') {
            document.documentElement.classList.remove('light');
            document.documentElement.classList.add('dark');
        } else if (theme === 'system') {
            const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (isDark) {
                document.documentElement.classList.remove('light');
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.classList.add('light');
            }
        }
        document.documentElement.style.fontSize = formData.get('font_size');
        setTimeout(() => location.reload(), 800);
    });
</script>
@endsection
