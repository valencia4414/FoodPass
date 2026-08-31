<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HarvestLedgerController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        return view('harvest_ledger.harvest_ledger', compact('usuario'));
    }
}
