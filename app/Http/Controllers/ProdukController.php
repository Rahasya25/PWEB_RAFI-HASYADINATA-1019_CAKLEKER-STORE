<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::latest()->paginate(10);
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_produk'   => 'required|string|max:50|unique:produks,kode_produk',
            'nama_produk'   => 'required|string|max:255',
            'kategori'      => 'required|string|max:100',
            'stok_produk'   => 'required|integer|min:0',
            'harga_produk'  => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'foto_produk'   => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('foto_produk')) {
            $validated['foto_produk'] = $request->file('foto_produk')->store('foto_produk', 'public');
        }

        Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Produk $produk)
    {
        return view('produk.show', compact('produk'));
    }

    public function edit(Produk $produk)
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'kode_produk'   => 'required|string|max:50|unique:produks,kode_produk,' . $produk->id,
            'nama_produk'   => 'required|string|max:255',
            'kategori'      => 'required|string|max:100',
            'stok_produk'   => 'required|integer|min:0',
            'harga_produk'  => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'foto_produk'   => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
            $validated['foto_produk'] = $request->file('foto_produk')->store('foto_produk', 'public');
        }

        $produk->update($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->foto_produk) {
            Storage::disk('public')->delete($produk->foto_produk);
        }
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
