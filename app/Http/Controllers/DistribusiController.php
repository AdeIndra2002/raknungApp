<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use App\Models\Divisi;
use App\Models\Pembelian;
use App\Models\Pengajuan;
use App\Models\User;
use App\Notifications\DistribusiVerified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DistribusiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengajuan = Pengajuan::with('pembelian')->where('status', 'Diterima')->orderBy('id', 'desc')->paginate(5);
        $divisi = Divisi::all();
        $distribusi = Distribusi::all();

        // Hitung jumlah berdasarkan status
        $jumlahDiterima = Pengajuan::where('status', 'Diterima')->count();
        $jumlahProses = Pembelian::where('status', 'Proses')->count();
        $jumlahSelesaiPembelian = Pembelian::where('status', 'Selesai')->count();
        $jumlahGagal = Pembelian::where('status', 'Gagal')->count();
        $jumlahSelesaiDistribusi = Distribusi::where('status', 'Selesai')->count();

        return view('distribusi.index', compact('pengajuan', 'divisi', 'distribusi', 'jumlahDiterima', 'jumlahProses', 'jumlahSelesaiPembelian', 'jumlahGagal', 'jumlahSelesaiDistribusi'));
    }


    public function verify(Request $request)
    {
        DB::beginTransaction();

        try {
            // Create a new Distribusi record
            $distribusi = new Distribusi();
            $distribusi->pengajuan_id = $request->input('pengajuan_id');
            $distribusi->status = 'Selesai'; // Set status to 'Selesai'
            $distribusi->verif_by = Auth::user()->id; // Set the verifier

            if ($distribusi->save()) {
                // Notify the user who assigned the report
                $user = User::where('name', 'admin')->first();
                if ($user) {
                    $user->notify(new DistribusiVerified($distribusi));
                }

                // Commit the transaction if all operations were successful
                DB::commit();
                return redirect()->route('distribusi.index')->with('success', 'Distribusi berhasil disimpan');
            } else {
                // Rollback if saving the record failed
                DB::rollBack();
                return redirect()->route('distribusi.index')->with('danger', 'Distribusi gagal disimpan');
            }
        } catch (\Exception $e) {
            // Rollback if an exception occurs
            DB::rollBack();
            return redirect()
                ->route('distribusi.index')
                ->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Validate the incoming request
            $request->validate([
                'pengajuan_id' => 'required|exists:pengajuans,id', // Ensure pengajuan_id exists
            ]);

            // Create a new Distribusi record
            $distribusi = new Distribusi();
            $distribusi->pengajuan_id = $request->input('pengajuan_id');
            $distribusi->status = 'Selesai'; // Set status to 'Selesai'
            $distribusi->verif_by = Auth::user()->id; // Set the verifier

            if ($distribusi->save()) {
                // Notify the user who assigned the report
                $user = User::where('name', 'admin')->first();
                if ($user) {
                    $user->notify(new DistribusiVerified($distribusi));
                }

                // Commit the transaction if all operations were successful
                DB::commit();
                return redirect()->route('distribusi.index')->with('success', 'Distribusi berhasil disimpan');
            } else {
                // Rollback if saving the record failed
                DB::rollBack();
                return redirect()->route('distribusi.index')->with('danger', 'Distribusi gagal disimpan');
            }
        } catch (\Exception $e) {
            // Rollback if an exception occurs
            DB::rollBack();
            return redirect()
                ->route('distribusi.index')
                ->with('danger', 'Terjadi kesalahan: ' . $e->getMessage());
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
