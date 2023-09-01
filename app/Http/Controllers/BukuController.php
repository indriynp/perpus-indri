<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.buku.index', [
            'title' => 'Buku',
            'buku' => Buku::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.buku.create', [
            'title' => 'Tambah buku',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'id_penulis' => 'required',
            'tahun_terbit' => 'required',
            'id_penerbit' => 'required',
            'id_kategori' => 'required',
            'sinopsis' => 'required',
            'sampul' => 'required',
        ]);

        Buku::create([
            'nama' => $request->nama,
            'tahun_terbit' => $request->tahun_terbit,
            'id_penulis' => $request->id_penulis,
            'id_penerbit' => $request->id_penerbit,
            'id_kategori' => $request->id_kategori,
            'sinopsis' => $request->sinopsis,
            'sampul' => $request->sampul,

        ]);

        return Redirect::route('buku_index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        return view('pages.admin.buku.edit', [
            'title' => 'Edit',
            'buku' => $buku,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $rules = [
            'nama' => 'required',
            'id_penulis' => 'required',
            'tahun_terbit' => 'required',
            'id_penerbit' => 'required',
            'id_kategori' => 'required',
            'sinopsis' => 'required',
            'sampul' => 'required',
        ];

        $validateData = $request->validate($rules);

        Buku::where('id', $buku->id)->update($validateData);

        return redirect('/buku')->with('success', 'Berhasil merubah data buku!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        Buku::destroy($buku->id);

        return redirect('/buku')->with('success', 'Berhasil menghapus data buku!');
    }
}
