<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barang = Barang::orderBy('id', 'desc')->paginate(5);
        $kategoris = kategori::all();
        return view('barang.index', compact('barang', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = kategori::all();
        return view('barang.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang' => 'required|unique:barangs,barang',
            'stok' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',  // Validasi apakah id kategori ada di tabel kategoris
        ]);

        $barang = Barang::create([
            'barang' => $request->barang,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('barang.index', compact('barang'))->with('success', 'Data Barang berhasil di tambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $barang = Barang::with('kategori')->find($id);
        $kategoris = kategori::all();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'barang' => 'required',
            'stok' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',  // Validasi apakah id kategori ada di tabel kategoris
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'barang' => $request->barang,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data Barang berhasil di ubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Data Barang berhasil di hapus.');
    }
}
