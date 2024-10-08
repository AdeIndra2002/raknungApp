<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\GambarPembelian;
use App\Models\Pembelian;
use App\Models\Pengajuan;
use App\Models\Supplier;
use App\Models\User;
use App\Notifications\PembelianRejected;
use App\Notifications\PembelianVerified;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pembelian = Pembelian::orderBy('id', 'desc')->paginate(5);
        $pengajuan = Pengajuan::all();
        $divisi = Divisi::all();
        return view('pembelian.index', compact('pembelian', 'pengajuan', 'divisi'));
    }

    public function cetakPembelian(Request $request)
    {
        // Retrieve inputs
        $selected_status = $request->input('status');
        $divisiId = $request->input('division');

        // Filter Pembelian based on selected status
        $pembelianQuery = Pembelian::query();

        if ($selected_status) {
            $pembelianQuery->where('status', $selected_status);
        }

        // Get Pembelian IDs that are associated with the selected divisiId through Pengajuan
        if ($divisiId) {
            $pengajuanIds = Pengajuan::where('divisi_id', $divisiId)->pluck('id');
            $pembelianQuery->whereIn('pengajuan_id', $pengajuanIds);
        }

        // Get Pembelian records
        $pembelian = $pembelianQuery->orderBy('id', 'desc')->get();

        // Get all divisi for the view
        $divisi = Divisi::all();

        // Determine divisi name or default to 'semua divisi'
        $divisiName = $divisiId ? Divisi::find($divisiId)->nama_divisi : 'semua divisi';
        $statusNamae = $selected_status ? $selected_status : 'semua status';

        // Generate PDF
        $pdf = Pdf::loadView('pembelian.lapdiv', compact('pembelian', 'divisi', 'selected_status', 'divisiId', 'divisiName', 'statusNamae'));

        // Create file name with selected divisi and status
        $fileName = 'laporan_pembelian_' . $divisiName . '_' . $statusNamae . '.pdf';

        return $pdf->stream($fileName);
    }

    public function cetakWaktu(Request $request)
    {
        $query = Pembelian::query();

        // Filter berdasarkan waktu
        if ($request->has('tanggal') && $request->has('periode')) {
            $tanggal = $request->input('tanggal');
            $periode = $request->input('periode');

            $tanggal = \Carbon\Carbon::parse($tanggal);

            switch ($periode) {
                case 'hari':
                    $query->whereDate('created_at', $tanggal->format('Y-m-d'));
                    break;
                case 'minggu':
                    $startOfWeek = $tanggal->startOfWeek()->format('Y-m-d');
                    $endOfWeek = $tanggal->endOfWeek()->format('Y-m-d');
                    $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                    break;
                case 'bulan':
                    $query->whereMonth('created_at', $tanggal->month)
                        ->whereYear('created_at', $tanggal->year);
                    break;
                case 'tahun':
                    $query->whereYear('created_at', $tanggal->year);
                    break;
            }
        }

        $pembelian = $query->orderBy('id', 'desc')->get();
        $divisi = Divisi::all();

        // Nama file PDF berdasarkan periode
        $fileName = 'laporan_pembelian_' . $request->input('periode') . '.pdf';

        // Generate PDF
        $pdf = Pdf::loadView('pembelian.lapwaktu', compact('pembelian', 'divisi', 'fileName', 'periode'));

        return $pdf->stream($fileName);
    }

    public function cetakStatus(Request $request)
    {
        $selected_status = $request->input('status');

        // Filter pengajuan berdasarkan status yang dipilih
        $pembelian = Pembelian::when($selected_status, function ($query, $selected_status) {
            $query->where('status', $selected_status);
        })->orderBy('id', 'desc')->get();

        // Tentukan nama status yang dipilih atau default ke 'semua_status'
        $statusNamae = $selected_status ? $selected_status : 'semua_status';

        // Generate PDF

        // Buat nama file dengan nama status yang dipilih
        $fileName = 'laporan_pembelian_' . $statusNamae . '.pdf';
        $pdf = Pdf::loadView('pembelian.lapstat', compact('pembelian', 'selected_status', 'fileName'));

        return $pdf->stream($fileName);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Anda bisa mengirimkan data yang diperlukan ke view jika dibutuhkan, seperti data pengajuan atau supplier.
        $pengajuans = Pengajuan::where('status', 'Diterima')->get();
        $suppliers = Supplier::all();
        return view('pembelian.create', compact('pengajuans', 'suppliers'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pengajuan_id' => 'required|exists:pengajuans,id|unique:pengajuans,id',
            'total_harga' => 'required|numeric',
            'gambar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'supplier_id' => 'required|array',
            'supplier_id.*' => 'exists:suppliers,id',
        ]);

        // Simpan data pembelian
        $pembelian = Pembelian::create([
            'pengajuan_id' => $request->pengajuan_id,
            'total_harga' => $request->total_harga,
            'status' => 'Proses',
            'verif_by' => $request->input('verif_by'),
        ]);

        // Simpan gambar dan data terkait di tabel gambar_pembelians
        if ($request->hasFile('gambar')) {
            $images = $request->file('gambar');
            $suppliers = $request->input('supplier_id', []);

            foreach ($images as $index => $image) {
                $imagePath = $image->store('public/images');
                $imageName = basename($imagePath);

                // Jika ada supplier_id yang sesuai dengan index gambar, simpan data gambar
                $gambarPembelian = GambarPembelian::create([
                    'pembelian_id' => $pembelian->id,
                    'supplier_id' => $suppliers[$index] ?? null,
                    'gambar' => $imageName,
                ]);
            }
        }

        return redirect()->route('pembelian.index')->with('success', 'Pembelian created successfully');
    }

    public function verify(string $id)
    {
        DB::beginTransaction();

        try {
            // Find the report by ID
            $verif = Pembelian::findOrFail($id);

            // Update the status and verifier
            $verif->status = 'Selesai';
            $verif->verif_by = Auth::user()->id;

            if ($verif->save()) {
                // Notify the user who assigned the report
                $user = User::where('name', 'Staff')->first();
                if ($user) {
                    $user->notify(new PembelianVerified($verif));
                }

                // Commit the transaction if all operations were successful
                DB::commit();
                return redirect()->route('pembelian.index')->with('success', 'pembelian berhasil diselesaikan');
            } else {
                // Rollback if saving the report failed
                DB::rollBack();
                return redirect()->route('pembelian.index')->with('danger', 'pembelian gagal diselesaikan');
            }
        } catch (\Exception $e) {
            // Rollback if an exception occurs
            DB::rollBack();
            return redirect()
                ->route('pembelian.index')
                ->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function rejected(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            // Find the report by ID
            $verif = Pembelian::findOrFail($id);

            // Update the status and verifier
            $verif->status = 'Gagal';
            $verif->note = $request->note;
            $verif->verif_by = Auth::user()->id;

            if ($verif->save()) {
                // Notify the user who assigned the report
                $user = User::where('name', 'Staff')->first();
                if ($user) {
                    $user->notify(new PembelianRejected($verif));
                }

                // Commit the transaction if all operations were successful
                DB::commit();
                return redirect()->route('pembelian.index')->with('success', 'Proses berhasil');
            } else {
                // Rollback if saving the report failed
                DB::rollBack();
                return redirect()->route('pembelian.index')->with('danger', 'Proses gagal');
            }
        } catch (\Exception $e) {
            // Rollback if an exception occurs
            DB::rollBack();
            return redirect()
                ->route('pembelian.index')
                ->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pembelian = Pembelian::with('GambarPembelian')->findOrFail($id);
        $pengajuan  = Pengajuan::all();
        $supplier = Supplier::all();

        return view('pembelian.show', compact('pembelian', 'pengajuan', 'supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     */
    // Ensure you are passing the correct data to the view
    public function edit(string $id)
    {
        $pembelian = Pembelian::with('GambarPembelian')->findOrFail($id);
        $pengajuans = Pengajuan::where('status', 'Diterima')->get();
        $suppliers = Supplier::all();
        return view('pembelian.edit', compact('pembelian', 'pengajuans', 'suppliers'));
    }


    /**
     * Update the specified resource in storage.
     */
    // 
    public function update(Request $request, Pembelian $pembelian)
    {
        $validated = $request->validate([
            'pengajuan_id' => 'required|exists:pengajuans,id',
            'total_harga' => 'required|numeric',
            'gambar.*' => 'nullable|image|max:2048',
            'supplier_id.*' => 'nullable|exists:suppliers,id',
        ]);

        // Perbarui data pembelian
        $pembelian->update($validated);

        // Tangani upload gambar
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $index => $image) {
                $imagePath = $image->store('images', 'public'); // Store image path in public/images

                // Ensure we handle the supplier_id
                $supplierId = $validated['supplier_id'][$index] ?? null;

                $pembelian->gambarPembelian()->create([
                    'gambar' => basename($imagePath), // Store only the basename of the image path
                    'supplier_id' => $supplierId
                ]);
            }
        }

        Log::info('Updating pembelian:', $validated);

        return redirect()->route('pembelian.index')->with('success', 'Pembelian updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembelian = Pembelian::findOrFail($id);
        $pembelian->delete();
        Log::info('Deleting pembelian:', ['id' => $id]);
        return redirect()->route('pembelian.index')->with('success', 'Pembelian deleted successfully.');
    }
}
