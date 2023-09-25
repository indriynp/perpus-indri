<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use PDF;

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
       $penerbits = Penerbit::all();
       $penulis = Penulis::all();

        return view('pages.admin.buku.create', [
            'kategoris' => $kategoris,
            'penerbits' => $penerbits,
            'penulis' => $penulis,
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
            'jumlah' => 'required',
            'sampul' => 'image|file',
        ]);

        $file = $request->file('sampul');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        Buku::create([
            'nama' => $request->nama,
            'tahun_terbit' => $request->tahun_terbit,
            'id_penulis' => $request->id_penulis,
            'id_penerbit' => $request->id_penerbit,
            'id_kategori' => $request->id_kategori,
            'sinopsis' => $request->sinopsis,
            'jumlah' => $request->jumlah,
            'sampul' => $path

        ]);

        return Redirect::route('buku_index')->with('toast_success','Data Berhasil di Tambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Buku::findOrFail($id);

        return view('pages.admin.buku.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Buku::findOrFail($id);
        $kategoris = Kategori::all();
        $penerbits = Penerbit::all();
        $penulis = Penulis::all();

        return view('pages.admin.buku.edit', [
            'item' => $item,
            'kategoris' => $kategoris,
            'penerbits' => $penerbits,
            'penulis' => $penulis,
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
            'jumlah' => 'required',
            'sampul' => 'required',
        ]);

        $file = $request->file('sampul');
        $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();

        Storage::disk('local')->put('public/' . $path, file_get_contents($file));

        $buku->update([
            'nama' => $request->nama,
            'tahun_terbit' => $request->tahun_terbit,
            'id_penulis' => $request->id_penulis,
            'id_penerbit' => $request->id_penerbit,
            'id_kategori' => $request->id_kategori,
            'sinopsis' => $request->sinopsis,
            'jumlah' => $request->jumlah,
            'sampul' => $path,
        ]);

        return redirect()->route('buku_index')->with('toast_success','Data Berhasil di Rubah!');
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

        return redirect('/buku')->with('toast_success','Data Berhasil di Hapus!');
    }

    public function generatePDF()
    {
        $bukus = Buku::get();
  
        $data = [
            'bukus' => $bukus,
        ]; 
            
        $pdf = PDF::loadView('pages.admin.buku.myPDF', $data);
     
        return $pdf->stream();
    }

    public function search(Request $request) {
        if($request->has('search')) {
            $allBuku = Buku::where('nama','LIKE','%'.$request->search.'%')->get();
        }
        else {
            $allBuku = Buku::all();
        }
       return view('pages.admin.buku.index', [
            'allBuku' => $allBuku,
        ]);
    }
}
