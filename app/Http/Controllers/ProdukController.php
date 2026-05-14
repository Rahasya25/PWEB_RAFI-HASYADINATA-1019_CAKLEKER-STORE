<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::where('user_id', auth()->id())->latest()->paginate(10);
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk'   => 'required|unique:produks,kode_produk',
            'nama_produk'   => 'required',
            'kategori'      => 'required',
            'stok_produk'   => 'required|integer|min:0',
            'harga_produk'  => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'foto_produk'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('foto_produk')) {
            $data['foto_produk'] = $request->file('foto_produk')->store('foto_produk', 'public');
        }

        Produk::create($data);
        return redirect()->route('produk.index')->with('success', 'Produk ditambahkan');
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
        $request->validate([
            'kode_produk'   => 'required|unique:produks,kode_produk,' . $produk->id,
            'nama_produk'   => 'required',
            'kategori'      => 'required',
            'stok_produk'   => 'required|integer|min:0',
            'harga_produk'  => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
            'foto_produk'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->except('foto_produk');
        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk) Storage::disk('public')->delete($produk->foto_produk);
            $data['foto_produk'] = $request->file('foto_produk')->store('foto_produk', 'public');
        }

        $produk->update($data);
        return redirect()->route('produk.index')->with('success', 'Produk diupdate');
    }

    public function destroy(Produk $produk)
    {
        if ($produk->foto_produk) Storage::disk('public')->delete($produk->foto_produk);
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk dihapus');
    }
}
