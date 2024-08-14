<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Divisi;
use App\Models\Pengajuan;
use App\Models\PengajuanBarang;
use App\Notifications\PengajuanRejected;
use App\Notifications\PengajuanVerified;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuan = Pengajuan::orderBy('id', 'desc')->paginate(5);
        $divisi = Divisi::all();
        $barang = Barang::all();
        return view('pengajuan.index', compact('pengajuan', 'divisi', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisi = Divisi::all();
        $barang = Barang::all();
        return view('pengajuan.create', compact('divisi', 'barang'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
            'divisi_id' => 'required|integer|exists:divisis,id',
        ]);

        DB::beginTransaction();

        try {
            $pengajuan = Pengajuan::create([
                'nama_pengaju' => $request->nama_pengaju,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'divisi_id' => $request->divisi_id,
                'no_surat' => $this->nomor_surat(),
                'assign_by' => Auth::user()->id,
            ]);

            foreach ($request->barang_id as $index => $barang_id) {
                PengajuanBarang::create([
                    'pengajuan_id' => $pengajuan->id,
                    'barang_id' => $barang_id,
                    'jumlah' => $request->jumlah[$index],
                ]);
            }


            DB::commit();

            return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('pengajuan.index')->with('danger', 'Terjadi kesalahan saat menambahkan pengajuan.');
        }
    }

    public function nomor_surat()
    {
        $increment = Pengajuan::count() + 1;
        $bulan = \Carbon\Carbon::now()->month;
        $bulan_romawi = $this->convertToRoman($bulan);
        $tahun = date('Y');
        $nomor = sprintf('%03d/SP/%s/%d', $increment, $bulan_romawi, $tahun);
        return $nomor;
    }

    /**
     * Convert number to roman
     */
    private function convertToRoman($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public function verify(string $id)
    {
        DB::beginTransaction();

        try {
            // Find the report by ID
            $verif = Pengajuan::findOrFail($id);

            // Update the status and verifier
            $verif->status = 'Diterima';
            $verif->verif_by = Auth::user()->id;

            if ($verif->save()) {
                // Notify the user who assigned the report
                $user = $verif->assignedBy;
                if ($user) {
                    $user->notify(new PengajuanVerified($verif));
                }

                // Commit the transaction if all operations were successful
                DB::commit();
                return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil diverifikasi');
            } else {
                // Rollback if saving the report failed
                DB::rollBack();
                return redirect()->route('pengajuan.index')->with('danger', 'Pengajuan gagal diverifikasi');
            }
        } catch (\Exception $e) {
            // Rollback if an exception occurs
            DB::rollBack();
            return redirect()
                ->route('pengajuan.index')
                ->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function rejected(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            // Find the report by ID
            $verif = Pengajuan::findOrFail($id);

            // Update the status and verifier
            $verif->status = 'Ditolak';
            $verif->note = $request->note;
            $verif->verif_by = Auth::user()->id;

            if ($verif->save()) {
                // Notify the user who assigned the report
                $user = $verif->assignedBy;
                if ($user) {
                    $user->notify(new PengajuanRejected($verif));
                }

                // Commit the transaction if all operations were successful
                DB::commit();
                return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil ditolak');
            } else {
                // Rollback if saving the report failed
                DB::rollBack();
                return redirect()->route('pengajuan.index')->with('danger', 'Pengajuan gagal ditolak');
            }
        } catch (\Exception $e) {
            // Rollback if an exception occurs
            DB::rollBack();
            return redirect()
                ->route('pengajuan.index')
                ->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengajuan = Pengajuan::with('pengajuanBarang')->findOrFail($id);
        $divisi = Divisi::all();
        return view('pengajuan.show', compact('pengajuan', 'divisi'));
    }

    public function cetakWaktu(Request $request)
    {
        $query = Pengajuan::query();

        // Filter berdasarkan waktu
        if ($request->has('tanggal') && $request->has('periode')) {
            $tanggal = $request->input('tanggal');
            $periode = $request->input('periode');

            $tanggal = \Carbon\Carbon::parse($tanggal);

            switch ($periode) {
                case 'hari':
                    $query->whereDate('tanggal_pengajuan', $tanggal->format('Y-m-d'));
                    break;
                case 'minggu':
                    $startOfWeek = $tanggal->startOfWeek()->format('Y-m-d');
                    $endOfWeek = $tanggal->endOfWeek()->format('Y-m-d');
                    $query->whereBetween('tanggal_pengajuan', [$startOfWeek, $endOfWeek]);
                    break;
                case 'bulan':
                    $query->whereMonth('tanggal_pengajuan', $tanggal->month)
                        ->whereYear('tanggal_pengajuan', $tanggal->year);
                    break;
                case 'tahun':
                    $query->whereYear('tanggal_pengajuan', $tanggal->year);
                    break;
            }
        }

        $pengajuan = $query->orderBy('id', 'desc')->get();
        $divisi = Divisi::all();

        // Nama file PDF berdasarkan periode
        $fileName = 'laporan_pengajuan_' . $request->input('periode') . '.pdf';

        // Generate PDF
        $pdf = Pdf::loadView('pengajuan.lapwaktu', compact('pengajuan', 'divisi'));

        return $pdf->stream($fileName);
    }



    public function generate($id)
    {
        $pengajuan = Pengajuan::findOrFail($id); // Mengambil data pengajuan berdasarkan ID
        $divisi = Divisi::all();
        $pengajuanBarang = PengajuanBarang::where('pengajuan_id', $pengajuan->id)->get();

        $pdf = PDF::loadView('pengajuan.surat', compact('pengajuan', 'divisi', 'pengajuanBarang'));
        return $pdf->stream('surat_pengajuan_' . $pengajuan->no_surat . '.pdf');
    }

    public function cetakPengajuan(Request $request)
    {
        $pengajuan = Pengajuan::orderBy('id', 'desc')->get();
        $divisi = Divisi::all();
        $selected_division = $request->input('selected_division');
        $divisiId = $request->input('division');

        // Filter pengajuan berdasarkan divisi yang dipilih
        $pengajuan = Pengajuan::when($divisiId, function ($query, $divisiId) {
            $query->whereHas('divisi', function ($query) use ($divisiId) {
                $query->where('id', $divisiId);
            });
        })->orderBy('id', 'desc')->get();

        // Tentukan nama divisi yang dipilih atau default ke 'semua divisi'
        $divisiName = $divisiId ? Divisi::find($divisiId)->nama_divisi : 'semua_divisi';

        // Generate PDF
        $pdf = Pdf::loadView('pengajuan.lapdiv', compact('pengajuan', 'divisi', 'selected_division'));

        // Buat nama file dengan nama divisi yang dipilih
        $fileName = 'laporan_pengajuan_' . $divisiName . '.pdf';

        return $pdf->stream($fileName);
    }

    public function cetakStatus(Request $request)
    {
        $selected_status = $request->input('status');

        // Filter pengajuan berdasarkan status yang dipilih
        $pengajuan = Pengajuan::when($selected_status, function ($query, $selected_status) {
            $query->where('status', $selected_status);
        })->orderBy('id', 'desc')->get();

        // Tentukan nama status yang dipilih atau default ke 'semua_status'
        $statusNamae = $selected_status ? $selected_status : 'semua_status';

        // Generate PDF
        $pdf = Pdf::loadView('pengajuan.lapstat', compact('pengajuan', 'selected_status'));

        // Buat nama file dengan nama status yang dipilih
        $fileName = 'laporan_pengajuan_' . $statusNamae . '.pdf';

        return $pdf->stream($fileName);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pengajuan = Pengajuan::with('pengajuanBarang')->findOrFail($id);
        $divisi = Divisi::all();
        $barang = Barang::all();
        return view('pengajuan.edit', compact('pengajuan', 'divisi', 'barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'required|integer|min:1',
            'divisi_id' => 'required|integer|exists:divisis,id',
        ]);

        DB::beginTransaction();

        try {
            $pengajuan = Pengajuan::findOrFail($id);
            $pengajuan->update([
                'nama_pengaju' => $request->nama_pengaju,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'divisi_id' => $request->divisi_id,
                'assign_by' => Auth::user()->id,  // Assuming the assign_by field should be updated too
            ]);

            // Delete existing related PengajuanBarang entries
            PengajuanBarang::where('pengajuan_id', $pengajuan->id)->delete();

            // Add new related PengajuanBarang entries
            foreach ($request->barang_id as $index => $barang_id) {
                PengajuanBarang::create([
                    'pengajuan_id' => $pengajuan->id,
                    'barang_id' => $barang_id,
                    'jumlah' => $request->jumlah[$index],
                ]);
            }

            DB::commit();

            return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('pengajuan.index')->with('danger', 'Terjadi kesalahan saat memperbarui pengajuan.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengajuan = Pengajuan::find($id);
        $pengajuan->delete();
        return redirect()->route('pengajuan.index', compact('pengajuan'))->with('success', 'Data Pengajuan berhasil di hapus.');
    }
}
