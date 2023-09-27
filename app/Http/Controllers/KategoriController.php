<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Redirect;
use PDF;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.admin.kategori.index', [
            'title' => 'Kategori',
            'kategori' => Kategori::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.kategori.create', [
            'title' => 'Tambah kategori',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            
        ]);

        Kategori::create([
            'nama' => $request->nama,
            

        ]);

        return Redirect::route('kategori_index')->with('toast_success','Data Berhasil di Tambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Kategori::findOrFail($id);

        return view('pages.admin.kategori.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Kategori::findOrFail($id);

         return view('pages.admin.kategori.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Kategori $kategori, Request $request)
    {
        $request->validate([
            'nama' => 'required',
            
             
        ]);

        $kategori->update([
            'nama' => $request->nama,
            
            
            
        ]);

        return redirect()->route('kategori_index')->with('toast_success','Data Berhasil di Rubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        Kategori::destroy($kategori->id);

        return redirect('/kategori')->with('toast_success','Data Berhasil di Hapus!');
    }

    public function generatePDF()
    {
        $kategoris = Kategori::get();
  
        $data = [
            'kategoris' => $kategoris,
        ]; 
            
        $pdf = PDF::loadView('pages.admin.kategori.myPDF', $data);
     
        return $pdf->stream();
    }

    public function search(Request $request) {
        if($request->has('search')) {
            $kategori = Kategori::where('nama','LIKE','%'.$request->search.'%')->get();
        }
        else {
            $kategori = Kategori::all();
        }
       return view('pages.admin.kategori.index', [
            'kategori' => $kategori,
        ]);
    }

    public function exportKategoriToExcel()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nama Kategori');

    // Mengambil data Kategori dari model Kategori
        $kategoris = Kategori::all();

        $row = 2;
        foreach ($kategoris as $kategori) {
            $sheet->setCellValue('A' . $row, $kategori->nama);
            $row++;
        }
        
    // Menyimpan Spreadsheet ke dalam file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_kategori.xlsx';
        $writer->save($filename);

    // Mengirim file Excel sebagai respons HTTP
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}