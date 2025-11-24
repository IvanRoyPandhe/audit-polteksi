<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use Illuminate\Http\Request;

class AuditTrailController extends Controller
{
    public function index()
    {
        $auditTrails = AuditTrail::with('user')->orderBy('waktu', 'desc')->paginate(20);
        return view('audit-trail.index', compact('auditTrails'));
    }
}