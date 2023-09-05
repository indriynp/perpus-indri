<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allBuku = Buku::all();

        return view('pages.admin.buku.index', [
            'allBuku' => $allBuku,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();

        return view('pages.admin.buku.create', [
            'kategoris' => $kategoris
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
            'sampul' => 'image|file',
        ]);

         if($request->file('sampul')){
            $validateData['sampul'] = $request->file('sampul')->store('buku-img');
        }

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
        return view('pages.admin.buku.show', [
            'title' => 'Show',
            'buku' => $buku,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Buku::findOrFail($id);
        $kategoris = Kategori::all();

        return view('pages.admin.buku.edit', [
            'item' => $item,
            'kategoris' => $kategoris,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Buku $buku, Request $request)
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


        if($request->file('sampul')){
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['sampul'] = $request->file('sampul')->store('buku-img');
        }

        $buku->update([
            'nama' => $request->nama,
            'tahun_terbit' => $request->tahun_terbit,
            'id_penulis' => $request->id_penulis,
            'id_penerbit' => $request->id_penerbit,
            'id_kategori' => $request->id_kategori,
            'sinopsis' => $request->sinopsis,
            'sampul' => $request->sampul,
        ]);

        return redirect()->route('buku_index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        if ($buku->sampul) {
            Storage::delete($buku->sampul);
        }
        Buku::destroy($buku->id);

        return redirect('/buku');
    }
}
