<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mahasiswa;

// db
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    //index
    public function index()
    {
        $mahasiswa = mahasiswa::all();
        return view('mahasiswa.index', compact('mahasiswa'));
    }

    //create
    public function create()
    {
        return view('mahasiswa.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
        ]);

        // cara 1
        // $mahasiswa = mahasiswa::create($request->all());

        // cara 2
        // $mahasiswa = new mahasiswa();
        // $mahasiswa->nim = $request->nim;
        // $mahasiswa->nama = $request->nama;
        // $mahasiswa->email = $request->email;
        // $mahasiswa->jurusan = $request->jurusan;
        // $mahasiswa->save();

        // cara 3
        DB::table('mahasiswa')->insert([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ]);

        return redirect()->route('mahasiswa')
        ->with('success', 'Mahasiswa created successfully.');
    }

    // edit
    public function edit($id)
    {
        $mhs = mahasiswa::find($id);
        return view('mahasiswa.edit', compact('mhs'));
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'email' => 'required',
            'jurusan' => 'required',
        ]);

        $update = [
            'nim' => $request->nim,
            'nama' => $request->nama,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
        ];

        mahasiswa::whereId($id)->update($update);

        return redirect()->route('mahasiswa')
        ->with('success', 'Mahasiswa updated successfully.');
    }

    //destroy
    public function destroy($id)
    {
        $mhs = mahasiswa::find($id);
        $mhs->delete();

        return redirect()->route('mahasiswa')
        ->with('success', 'Mahasiswa deleted successfully.');
    }
    
}
