<?php

namespace App\Http\Controllers;

use App\Models\GambarPembelian;
use App\Models\GambarPenerimaan;
use App\Models\Pembelian;
use App\Models\Penerimaan;
use App\Models\Pengajuan;
use App\Models\PengajuanBarang;
use App\Models\Supplier;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PenerimaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penerimaan = Penerimaan::orderBy('id', 'desc')->paginate(5);
        $pembelian = Pembelian::all();
        return view('penerimaan.index', compact('penerimaan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pembelian = Pembelian::where('status', 'Selesai')->get();
        return view('penerimaan.create', compact('pembelian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pembelian_id' => 'required|exists:pembelians,id',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $penerimaan = Penerimaan::create([
            'pembelian_id' => $request->pembelian_id,
        ]);

        if ($request->hasFile('gambar')) {
            $images = $request->file('gambar');

            foreach ($images as $image) {
                $imagePath = $image->store('public/images');
                $imageName = basename($imagePath);

                $gambarPenerimaan = GambarPenerimaan::create([
                    'penerimaan_id' => $penerimaan->id,
                    'gambar' => $imageName,
                ]);
            }
        }
        return redirect()->route('penerimaan.index')->with('success', 'Data penerimaan berhasil di tambahkan.');
    }

    public function cetakPenerimaan(Request $request)
    {
        $penerimaan = Penerimaan::with('pembelian.pengajuan', 'pembelian.pengajuan.divisi', 'gambarPenerimaan', 'pembelian.gambarPembelian', 'pembelian.pengajuan.pengajuanBarang');

        // Siapkan data untuk PDF
        $pdf = Pdf::loadView('penerimaan.cetak', compact('penerimaan'));

        // Kembalikan PDF sebagai respons
        return $pdf->stream('laporan_penerimaan.pdf');
    }


    public function generate($id)
    {

        $penerimaan = Penerimaan::with('GambarPenerimaan', 'pembelian')->findOrFail($id); // Mengambil data pengajuan berdasarkan ID
        $gambarPenerimaan = GambarPenerimaan::where('penerimaan_id', $penerimaan->id)->get();
        $gambarPembelian = GambarPembelian::where('pembelian_id', $penerimaan->pembelian->id)->get();
        $pengajuanBarang = PengajuanBarang::where('pengajuan_id', $penerimaan->pembelian->pengajuan->id)->get();
        $user = User::where('id', 4)->value('name');

        $pdf = Pdf::loadView('penerimaan.lampiran', compact('user', 'penerimaan', 'gambarPenerimaan', 'gambarPembelian', 'pengajuanBarang'));
        return $pdf->stream('lampiran_penerimaan.pdf');
    }

    public function cetakSemu()
    {
        // Fetch all penerimaan data with relationships
        $penerimaan = Penerimaan::with('pembelian.pengajuan', 'pembelian.pengajuan.divisi')->get();
        $user = User::where('id', 4)->value('name');
        // Generate the PDF
        $pdf = Pdf::loadView('penerimaan.cetakSemua', compact('penerimaan', 'user'));

        // Return the PDF for download
        return $pdf->stream('laporan_semua_penerimaan.pdf');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $penerimaan = Penerimaan::with('GambarPenerimaan')->findOrFail($id);
        $pembelian = Pembelian::all();
        return view('penerimaan.show', compact('penerimaan', 'pembelian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $penerimaan = Penerimaan::with('GambarPenerimaan', 'pembelian',)->findOrFail($id);
        $pembelian = Pembelian::where('status', 'Selesai')->get();
        return view('penerimaan.edit', compact('penerimaan', 'pembelian'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penerimaan $penerimaan)
    {
        $validated = $request->validate([
            'pembelian_id' => 'required|exists:pembelians,id',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $penerimaan->update($validated);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $image) {
                $imagePath = $image->store('images', 'public');

                $penerimaan->gambarPenerimaan()->create([
                    'gambar' => basename($imagePath),
                ]);
            }
        }

        return redirect()->route('penerimaan.index')->with('success', 'Data penerimaan berhasil di ubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penerimaan = Penerimaan::with('GambarPenerimaan')->findOrFail($id);
        $penerimaan->delete();
        return redirect()->route('penerimaan.index')->with('success', 'Data penerimaan berhasil di hapus.');
    }
}
