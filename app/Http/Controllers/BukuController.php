<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('admin.index', compact('buku'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
        ]);

        Buku::create($request->all());

        return redirect()->route('admin.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }
    public function edit($bukuID)
    {
        $buku = Buku::findOrFail($bukuID);
        return view('admin.edit', compact('buku'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update([
            'judul'     => $request->judul,
            'penulis'     => $request->penulis,
            'penerbit'     => $request->penerbit,
            'tahun_terbit'     => $request->tahun_terbit,
        ]);

        return redirect()->route('admin.index')->with('success', 'Buku berhasil diubah!');
    }

    public function destroy($bukuID)
    {
        $buku=Buku::findOrFail($bukuID);
        $buku->delete();

        return redirect()->route('admin.index')->with(['success' => 'Buku Berhasil Dihapus!']);
    }
}
