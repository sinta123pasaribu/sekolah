<?php
namespace App\Http\Controllers;

use App\Models\JadwalBelajar;
use Illuminate\Http\Request;

class JadwalBelajarController extends Controller
{
    public function index()
    {
        $data = JadwalBelajar::all();
        return view('jadwal.belajar_index', compact('data'));
    }

    public function create()
    {
        return view('jadwal.belajar_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'kelas' => 'required',
            'mata_pelajaran' => 'required',
            'guru' => 'required',
        ]);

        JadwalBelajar::create($request->all());
        return redirect()->route('jadwal-belajar.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data = JadwalBelajar::findOrFail($id);
        return view('jadwal.belajar_edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = JadwalBelajar::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('jadwal-belajar.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = JadwalBelajar::findOrFail($id);
        $data->delete();

        return redirect()->route('jadwal-belajar.index')->with('success', 'Data berhasil dihapus');
    }
}
