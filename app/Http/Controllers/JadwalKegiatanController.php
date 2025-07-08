<?php
namespace App\Http\Controllers;

use App\Models\JadwalKegiatan;
use Illuminate\Http\Request;

class JadwalKegiatanController extends Controller
{
    public function index()
    {
        $data = JadwalKegiatan::all();
        return view('jadwal.kegiatan_index', compact('data'));
    }

    public function create()
    {
        return view('jadwal.kegiatan_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nama_kegiatan' => 'required',
            'lokasi' => 'required',
            'jam' => 'required',
        ]);

        JadwalKegiatan::create($request->all());
        return redirect()->route('jadwal-kegiatan.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data = JadwalKegiatan::findOrFail($id);
        return view('jadwal.kegiatan_edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = JadwalKegiatan::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('jadwal-kegiatan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = JadwalKegiatan::findOrFail($id);
        $data->delete();

        return redirect()->route('jadwal-kegiatan.index')->with('success', 'Data berhasil dihapus');
    }
}
