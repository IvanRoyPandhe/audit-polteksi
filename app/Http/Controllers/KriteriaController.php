<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\IndikatorKinerja;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $query = Kriteria::with('indikatorKinerja', 'unit');
        
        // Admin sees all, staff only sees their unit
        if (auth()->user()->role_id != 1) {
            $query->forUnit(auth()->user()->unit_id);
        }
        
        $kriterias = $query->paginate(10);
        return view('kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        $query = IndikatorKinerja::query();
        
        // Filter indikator by unit for non-admin
        if (auth()->user()->role_id != 1) {
            $query->forUnit(auth()->user()->unit_id);
        }
        
        $indikators = $query->get();
        return view('kriteria.create', compact('indikators'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'indikator_id' => 'nullable|exists:indikator_kinerja,indikator_id',
            'nama_kriteria' => 'required|max:150',
            'bobot' => 'nullable|numeric',
            'deskripsi' => 'nullable'
        ]);

        $data = $request->all();
        // Auto-assign unit_id for non-admin
        if (auth()->user()->role_id != 1) {
            $data['unit_id'] = auth()->user()->unit_id;
        }
        
        Kriteria::create($data);
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan');
    }

    public function edit(Kriteria $kriterium)
    {
        // Check unit access for non-admin
        if (auth()->user()->role_id != 1 && $kriterium->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $query = IndikatorKinerja::query();
        if (auth()->user()->role_id != 1) {
            $query->forUnit(auth()->user()->unit_id);
        }
        
        $indikators = $query->get();
        return view('kriteria.edit', compact('kriterium', 'indikators'));
    }

    public function update(Request $request, Kriteria $kriterium)
    {
        // Check unit access for non-admin
        if (auth()->user()->role_id != 1 && $kriterium->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $request->validate([
            'indikator_id' => 'nullable|exists:indikator_kinerja,indikator_id',
            'nama_kriteria' => 'required|max:150',
            'bobot' => 'nullable|numeric',
            'deskripsi' => 'nullable'
        ]);

        $kriterium->update($request->all());
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diupdate');
    }

    public function destroy(Kriteria $kriterium)
    {
        // Check unit access for non-admin
        if (auth()->user()->role_id != 1 && $kriterium->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $kriterium->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus');
    }
}