<?php

namespace App\Http\Controllers;

use App\Models\Validasi;
use App\Models\DataKinerja;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    public function index()
    {
        $query = Validasi::with(['kinerja', 'validator']);
        
        // Search
        if ($search = request('search')) {
            $query->whereHas('kinerja', function($q) use ($search) {
                $q->where('periode', 'like', "%{$search}%");
            });
        }
        
        // Filter by status
        if ($status = request('status')) {
            $query->where('status_validasi', $status);
        }
        
        $validasis = $query->latest('validasi_id')->paginate(request('per_page', 10));
        
        return view('validasi.index', compact('validasis'));
    }

    public function create()
    {
        $dataKinerjas = DataKinerja::all();
        return view('validasi.create', compact('dataKinerjas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kinerja_id' => 'required|exists:data_kinerja,kinerja_id',
            'tanggal_validasi' => 'required|date',
            'status_validasi' => 'required|max:20',
            'catatan' => 'nullable'
        ]);

        $data = $request->all();
        $data['validator_id'] = auth()->id();
        
        Validasi::create($data);
        return redirect()->route('validasi.index')->with('success', 'Validasi berhasil ditambahkan');
    }

    public function edit(Validasi $validasi)
    {
        $dataKinerjas = DataKinerja::all();
        return view('validasi.edit', compact('validasi', 'dataKinerjas'));
    }

    public function update(Request $request, Validasi $validasi)
    {
        $request->validate([
            'kinerja_id' => 'required|exists:data_kinerja,kinerja_id',
            'tanggal_validasi' => 'required|date',
            'status_validasi' => 'required|max:20',
            'catatan' => 'nullable'
        ]);

        $validasi->update($request->all());
        return redirect()->route('validasi.index')->with('success', 'Validasi berhasil diupdate');
    }

    public function destroy(Validasi $validasi)
    {
        $validasi->delete();
        return redirect()->route('validasi.index')->with('success', 'Validasi berhasil dihapus');
    }
}