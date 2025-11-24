<?php

namespace App\Http\Controllers;

use App\Models\StandarMutu;
use Illuminate\Http\Request;

class StandarMutuController extends Controller
{
    public function index()
    {
        $query = StandarMutu::with('unit');
        
        // Admin sees all, staff only sees their unit
        if (auth()->user()->role_id != 1) {
            $query->forUnit(auth()->user()->unit_id);
        }
        
        $standars = $query->paginate(10);
        return view('standar-mutu.index', compact('standars'));
    }

    public function create()
    {
        return view('standar-mutu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_standar' => 'required|max:100',
            'kategori' => 'required|max:50',
            'deskripsi' => 'nullable'
        ]);

        $data = $request->all();
        // Auto-assign unit_id for non-admin
        if (auth()->user()->role_id != 1) {
            $data['unit_id'] = auth()->user()->unit_id;
        }
        
        StandarMutu::create($data);
        return redirect()->route('standar-mutu.index')->with('success', 'Standar mutu berhasil ditambahkan');
    }

    public function edit(StandarMutu $standarMutu)
    {
        // Check unit access for non-admin
        if (auth()->user()->role_id != 1 && $standarMutu->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        return view('standar-mutu.edit', compact('standarMutu'));
    }

    public function update(Request $request, StandarMutu $standarMutu)
    {
        // Check unit access for non-admin
        if (auth()->user()->role_id != 1 && $standarMutu->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $request->validate([
            'nama_standar' => 'required|max:100',
            'kategori' => 'required|max:50',
            'deskripsi' => 'nullable'
        ]);

        $standarMutu->update($request->all());
        return redirect()->route('standar-mutu.index')->with('success', 'Standar mutu berhasil diupdate');
    }

    public function destroy(StandarMutu $standarMutu)
    {
        // Check unit access for non-admin
        if (auth()->user()->role_id != 1 && $standarMutu->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $standarMutu->delete();
        return redirect()->route('standar-mutu.index')->with('success', 'Standar mutu berhasil dihapus');
    }
}