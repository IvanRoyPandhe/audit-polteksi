<?php

namespace App\Http\Controllers;

use App\Models\IndikatorKinerja;
use App\Models\StandarMutu;
use Illuminate\Http\Request;

class IndikatorKinerjaController extends Controller
{
    public function index()
    {
        $query = IndikatorKinerja::with('standar', 'unit');
        
        // Admin sees all, staff only sees their unit
        if (auth()->user()->role_id != 1) {
            $query->forUnit(auth()->user()->unit_id);
        }
        
        $indikators = $query->paginate(10);
        return view('indikator-kinerja.index', compact('indikators'));
    }

    public function create()
    {
        $query = StandarMutu::query();
        
        // Filter standar by unit for non-admin
        if (auth()->user()->role_id != 1) {
            $query->forUnit(auth()->user()->unit_id);
        }
        
        $standars = $query->get();
        return view('indikator-kinerja.create', compact('standars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'standar_id' => 'required|exists:standar_mutu,standar_id',
            'nama_indikator' => 'required|max:150',
            'target' => 'required|numeric',
            'status' => 'required|max:30'
        ]);

        $data = $request->all();
        // Auto-assign unit_id for non-admin
        if (auth()->user()->role_id != 1) {
            $data['unit_id'] = auth()->user()->unit_id;
        }
        
        IndikatorKinerja::create($data);
        return redirect()->route('indikator-kinerja.index')->with('success', 'Indikator kinerja berhasil ditambahkan');
    }

    public function edit(IndikatorKinerja $indikatorKinerja)
    {
        // Check unit access for non-admin
        if (auth()->user()->role_id != 1 && $indikatorKinerja->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $query = StandarMutu::query();
        if (auth()->user()->role_id != 1) {
            $query->forUnit(auth()->user()->unit_id);
        }
        
        $standars = $query->get();
        return view('indikator-kinerja.edit', compact('indikatorKinerja', 'standars'));
    }

    public function update(Request $request, IndikatorKinerja $indikatorKinerja)
    {
        // Check unit access for non-admin
        if (auth()->user()->role_id != 1 && $indikatorKinerja->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $request->validate([
            'standar_id' => 'required|exists:standar_mutu,standar_id',
            'nama_indikator' => 'required|max:150',
            'target' => 'required|numeric',
            'status' => 'required|max:30'
        ]);

        $indikatorKinerja->update($request->all());
        return redirect()->route('indikator-kinerja.index')->with('success', 'Indikator kinerja berhasil diupdate');
    }

    public function destroy(IndikatorKinerja $indikatorKinerja)
    {
        // Check unit access for non-admin
        if (auth()->user()->role_id != 1 && $indikatorKinerja->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $indikatorKinerja->delete();
        return redirect()->route('indikator-kinerja.index')->with('success', 'Indikator kinerja berhasil dihapus');
    }
}