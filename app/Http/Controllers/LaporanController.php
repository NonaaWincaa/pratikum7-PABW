<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::latest()->paginate(10);
        return view('laporbanjir.index', compact('laporan'));
    }

    public function create()
    {
        return view('laporbanjir.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'lokasi' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'tinggi_air' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'foto.max' => 'Ukuran foto maksimal 2 MB.',
            'foto.mimes' => 'Format foto harus jpg, jpeg, atau png.'
        ]);

        $validated['foto'] = $request->file('foto')->store('foto_laporan', 'public');
        
        Laporan::create($validated);

        return redirect()->route('laporan.index')->with('success', 'Data laporan berhasil ditambahkan.');
    }

    public function show(Laporan $laporan)
    {
        return view('laporbanjir.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        return view('laporbanjir.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $validated = $request->validate([
            'nama_pelapor' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'lokasi' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'tinggi_air' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'status' => 'required|in:Menunggu,Diproses,Selesai',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if (Storage::disk('public')->exists($laporan->foto)) {
                Storage::disk('public')->delete($laporan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_laporan', 'public');
        }

        $laporan->update($validated);

        return redirect()->route('laporan.index')->with('success', 'Data laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        // Hapus file foto terkait
        if (Storage::disk('public')->exists($laporan->foto)) {
            Storage::disk('public')->delete($laporan->foto);
        }
        
        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan palsu berhasil dihapus.');
    }
}