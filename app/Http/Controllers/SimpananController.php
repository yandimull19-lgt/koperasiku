<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Anggota;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    public function index()
    {
        $simpanan = Simpanan::with('anggota')->latest()->paginate(10);
        return view('simpanan.index', compact('simpanan'));
    }

    public function create()
    {
        $anggota = Anggota::all();
        return view('simpanan.create', compact('anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis' => 'required|in:pokok,wajib,sukarela',
            'nominal' => 'required|numeric|min:1000',
            'tanggal_transaksi' => 'required|date',
        ]);

        Simpanan::create([
            'anggota_id' => $request->anggota_id,
            'jenis' => $request->jenis,
            'nominal' => $request->nominal,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'status' => 'disetujui',
        ]);

        return redirect()->route('simpanan.index')->with('success', 'Data simpanan berhasil ditambahkan.');
    }
}