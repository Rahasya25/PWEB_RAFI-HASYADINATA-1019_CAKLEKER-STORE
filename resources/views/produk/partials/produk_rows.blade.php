@if($produk->count())
    @foreach($produk as $item)
    <tr style="border-bottom: 1px solid var(--border-card);">
        <td style="padding: 12px;">
            @if($item->foto_produk)
                <img src="{{ asset('storage/'.$item->foto_produk) }}" width="45" height="45" style="object-fit: cover; border-radius: 8px; border: 1px solid var(--border-card);">
            @else
                <div style="width:45px; height:45px; background: rgba(0,0,0,0.1); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px;">🏎️</div>
            @endif
        </td>
        <td style="padding: 12px; font-weight: bold; color: #DC0000;">{{ $item->kode_produk }}</td>
        <td style="padding: 12px; font-weight: 500;">{{ $item->nama_produk }}</td>
        <td style="padding: 12px;">
            <span style="background: rgba(220, 0, 0, 0.1); color: #DC0000; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600; display: inline-block;">
                {{ $item->kategori }}
            </span>
        </td>
        <td style="padding: 12px;">
            @if($item->stok_produk == 0)
                <span style="color: #D32F2F; font-weight: bold;">Habis</span>
            @elseif($item->stok_produk <= 5)
                <span style="color: #EF6C00; font-weight: bold;">Menipis ({{ $item->stok_produk }})</span>
            @else
                <span style="color: #2E7D32; font-weight: bold;">{{ $item->stok_produk }} unit</span>
            @endif
        </td>
        <td style="padding: 12px; font-weight: 700;">Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</td>
        <td style="padding: 12px; color: var(--sub-teks); font-size: 14px;">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
        <td style="padding: 12px;">
            <div style="display: flex; gap: 6px; align-items: center;">
                <a href="{{ route('produk.show', $item->id) }}" style="background: #2196F3; padding: 6px 14px; border-radius: 6px; color: white; text-decoration: none; font-size: 12px; font-weight: bold; transition: opacity 0.2s;">Detail</a>
                @if(auth()->user() && auth()->user()->role === 'admin')
                    <a href="{{ route('produk.edit', $item->id) }}" style="background: #FFC107; padding: 6px 14px; border-radius: 6px; color: black; text-decoration: none; font-size: 12px; font-weight: bold; transition: opacity 0.2s;">Edit</a>
                    <form action="{{ route('produk.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini dari katalog?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background: #f44336; border: none; padding: 6px 14px; border-radius: 6px; color: white; cursor: pointer; font-size: 12px; font-weight: bold; transition: opacity 0.2s;">Hapus</button>
                    </form>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" style="text-align: center; padding: 40px; color: var(--sub-teks); font-style: italic;">
            🏁 Tidak ada produk merchandise ditemukan yang cocok dengan kriteria pencarian.
        </td>
    </tr>
@endif
