<?php
namespace App\Http\Controllers;

use App\Models\JadwalUjian;
use Illuminate\Http\Request;

class JadwalUjianController extends Controller
{
    public function index()
    {
        $data = JadwalUjian::all();
        return view('jadwal.ujian_index', compact('data'));
    }

    public function create()
    {
        return view('jadwal.ujian_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jam' => 'required',
            'kelas' => 'required',
            'mata_pelajaran' => 'required',
            'ruangan' => 'required',
            'pengawas' => 'required',
        ]);

        JadwalUjian::create($request->all());
        return redirect()->route('jadwal-ujian.index')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $data = JadwalUjian::findOrFail($id);
        return view('jadwal.ujian_edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = JadwalUjian::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('jadwal-ujian.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $data = JadwalUjian::findOrFail($id);
        $data->delete();

        return redirect()->route('jadwal-ujian.index')->with('success', 'Data berhasil dihapus');
    }
}
