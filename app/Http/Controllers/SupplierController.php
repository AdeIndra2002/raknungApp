<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::orderBy('id', 'asc')->paginate(5);
        return view('supplier.index', compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|unique:suppliers,nama_supplier',
            'no_hp' => 'required',
        ]);
        $supplier = Supplier::create($request->all());
        return redirect()->route('supplier.index', compact('supplier'))->with('success', 'Data supplier berhasil di tambahkan.');
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
        $supplier = Supplier::find($id);
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'no_hp' => 'required',
        ]);

        $supplier = Supplier::find($id);
        $supplier->update($request->all());
        return redirect()->route('supplier.index', compact('supplier'))->with('success', 'Data supplier berhasil di ubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
