<?php

namespace App\Http\Controllers;

use App\Models\TindakLanjut;
use App\Models\AuditTemuan;
use Illuminate\Http\Request;

class TindakLanjutController extends Controller
{
    public function index()
    {
        $tindakLanjuts = TindakLanjut::with(['temuan', 'penanggungJawab'])->paginate(10);
        return view('tindak-lanjut.index', compact('tindakLanjuts'));
    }

    public function create()
    {
        $temuans = AuditTemuan::all();
        return view('tindak-lanjut.create', compact('temuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'temuan_id' => 'required|exists:audit_temuan,temuan_id',
            'rencana_perbaikan' => 'required',
            'tanggal_target' => 'required|date',
            'status_tindak' => 'required|max:20'
        ]);

        $data = $request->all();
        $data['penanggung_jawab'] = auth()->id();
        
        TindakLanjut::create($data);
        return redirect()->route('tindak-lanjut.index')->with('success', 'Tindak lanjut berhasil ditambahkan');
    }

    public function edit(TindakLanjut $tindakLanjut)
    {
        $temuans = AuditTemuan::all();
        return view('tindak-lanjut.edit', compact('tindakLanjut', 'temuans'));
    }

    public function update(Request $request, TindakLanjut $tindakLanjut)
    {
        $request->validate([
            'temuan_id' => 'required|exists:audit_temuan,temuan_id',
            'rencana_perbaikan' => 'required',
            'tanggal_target' => 'required|date',
            'status_tindak' => 'required|max:20'
        ]);

        $tindakLanjut->update($request->all());
        return redirect()->route('tindak-lanjut.index')->with('success', 'Tindak lanjut berhasil diupdate');
    }

    public function destroy(TindakLanjut $tindakLanjut)
    {
        $tindakLanjut->delete();
        return redirect()->route('tindak-lanjut.index')->with('success', 'Tindak lanjut berhasil dihapus');
    }
}