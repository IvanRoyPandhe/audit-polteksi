<?php

namespace App\Http\Controllers;

use App\Models\DataKinerja;
use App\Models\IndikatorKinerja;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class DataKinerjaController extends Controller
{
    public function index()
    {
        $query = DataKinerja::with(['indikator', 'kriteria', 'user.unit']);
        
        // Staff only sees their own unit's data
        if (auth()->user()->role_id == 4) {
            $query->whereHas('user', function($q) {
                $q->where('unit_id', auth()->user()->unit_id);
            });
        }
        
        // Search
        if ($search = request('search')) {
            $query->where(function($q) use ($search) {
                $q->where('periode', 'like', "%{$search}%")
                  ->orWhereHas('indikator', function($q) use ($search) {
                      $q->where('nama_indikator', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filter by status
        if ($status = request('status')) {
            $query->where('status', $status);
        }
        
        // Filter by periode
        if ($periode = request('periode')) {
            $query->where('periode', $periode);
        }
        
        $dataKinerja = $query->latest('kinerja_id')->paginate(request('per_page', 10));
        
        return view('data-kinerja.index', compact('dataKinerja'));
    }

    public function create()
    {
        $indikatorQuery = IndikatorKinerja::query();
        $kriteriaQuery = Kriteria::query();
        
        // Filter by unit for staff
        if (auth()->user()->role_id == 4) {
            $indikatorQuery->forUnit(auth()->user()->unit_id);
            $kriteriaQuery->forUnit(auth()->user()->unit_id);
        }
        
        $indikators = $indikatorQuery->get();
        $kriterias = $kriteriaQuery->get();
        return view('data-kinerja.create', compact('indikators', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'indikator_id' => 'required|exists:indikator_kinerja,indikator_id',
            'kriteria_id' => 'required|exists:kriteria,kriteria_id',
            'periode' => 'required|max:20',
            'capaian' => 'required|numeric',
            'status' => 'required|max:30'
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        
        DataKinerja::create($data);
        return redirect()->route('data-kinerja.index')->with('success', 'Data kinerja berhasil ditambahkan');
    }

    public function edit(DataKinerja $dataKinerja)
    {
        // Staff can only edit their own unit's data
        if (auth()->user()->role_id == 4 && $dataKinerja->user->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $indikatorQuery = IndikatorKinerja::query();
        $kriteriaQuery = Kriteria::query();
        
        if (auth()->user()->role_id == 4) {
            $indikatorQuery->forUnit(auth()->user()->unit_id);
            $kriteriaQuery->forUnit(auth()->user()->unit_id);
        }
        
        $indikators = $indikatorQuery->get();
        $kriterias = $kriteriaQuery->get();
        return view('data-kinerja.edit', compact('dataKinerja', 'indikators', 'kriterias'));
    }

    public function update(Request $request, DataKinerja $dataKinerja)
    {
        // Staff can only edit their own unit's data
        if (auth()->user()->role_id == 4 && $dataKinerja->user->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $request->validate([
            'indikator_id' => 'required|exists:indikator_kinerja,indikator_id',
            'kriteria_id' => 'required|exists:kriteria,kriteria_id',
            'periode' => 'required|max:20',
            'capaian' => 'required|numeric',
            'status' => 'required|max:30'
        ]);

        $dataKinerja->update($request->all());
        return redirect()->route('data-kinerja.index')->with('success', 'Data kinerja berhasil diupdate');
    }

    public function destroy(DataKinerja $dataKinerja)
    {
        // Staff can only delete their own unit's data
        if (auth()->user()->role_id == 4 && $dataKinerja->user->unit_id != auth()->user()->unit_id) {
            abort(403, 'Anda tidak memiliki akses ke data unit lain');
        }
        
        $dataKinerja->delete();
        return redirect()->route('data-kinerja.index')->with('success', 'Data kinerja berhasil dihapus');
    }
}