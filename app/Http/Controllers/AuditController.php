<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use App\Models\Validasi;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
        $query = Audit::with(['validasi', 'auditor']);
        
        // Search
        if ($search = request('search')) {
            $query->where('periode', 'like', "%{$search}%");
        }
        
        // Filter by status
        if ($status = request('status')) {
            $query->where('status_audit', $status);
        }
        
        $audits = $query->latest('tanggal_audit')->paginate(request('per_page', 10));
        
        return view('audit.index', compact('audits'));
    }

    public function create()
    {
        $validasis = Validasi::all();
        return view('audit.create', compact('validasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'validasi_id' => 'required|exists:validasi,validasi_id',
            'tanggal_audit' => 'required|date',
            'status_audit' => 'required|max:20',
            'periode' => 'required|max:20'
        ]);

        $data = $request->all();
        $data['auditor_id'] = auth()->id();
        
        Audit::create($data);
        return redirect()->route('audit.index')->with('success', 'Audit berhasil ditambahkan');
    }

    public function edit(Audit $audit)
    {
        $validasis = Validasi::all();
        return view('audit.edit', compact('audit', 'validasis'));
    }

    public function update(Request $request, Audit $audit)
    {
        $request->validate([
            'validasi_id' => 'required|exists:validasi,validasi_id',
            'tanggal_audit' => 'required|date',
            'status_audit' => 'required|max:20',
            'periode' => 'required|max:20'
        ]);

        $audit->update($request->all());
        return redirect()->route('audit.index')->with('success', 'Audit berhasil diupdate');
    }

    public function destroy(Audit $audit)
    {
        $audit->delete();
        return redirect()->route('audit.index')->with('success', 'Audit berhasil dihapus');
    }
}