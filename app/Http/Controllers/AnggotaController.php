<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::latest()->get();

        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor_anggota' => 'required|string|max:255|unique:anggotas,nomor_anggota',
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:255|unique:anggotas,nik',
            'jenis_kelamin' => 'required|string|max:20',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'tanggal_bergabung' => 'required|date',
        ]);

        Anggota::create($validated);

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }
}
