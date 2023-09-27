<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
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

    public function exportBukusToExcel()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nama Buku');
        $sheet->setCellValue('B1', 'Tahun Terbit');
        $sheet->setCellValue('C1', 'Penulis');
        $sheet->setCellValue('D1', 'Penerbit');
        $sheet->setCellValue('E1', 'Kategori');
        $sheet->setCellValue('F1', 'Sinopsis');
        $sheet->setCellValue('G1', 'Jumlah');
        $sheet->setCellValue('H1', 'Sampul');

    // Mengambil data buku dari model Buku
        $bukus = Buku::with('penulis')->get();
        $bukus = Buku::with('penerbit')->get();
        $bukus = Buku::with('kategori')->get();

        $row = 2;
        foreach ($bukus as $buku) {
            $sheet->setCellValue('A' . $row, $buku->nama);
            $sheet->setCellValue('B' . $row, $buku->tahun_terbit);
            $sheet->setCellValue('C' . $row, $buku->penulis->nama);
            $sheet->setCellValue('D' . $row, $buku->penerbit->nama);
            $sheet->setCellValue('E' . $row, $buku->kategori->nama);
            $sheet->setCellValue('F' . $row, $buku->sinopsis);
            $sheet->setCellValue('G' . $row, $buku->jumlah);
    // Menambahkan gambar dalam sel Excel
            $drawing = new Drawing();
            $drawing->setName('Sampul');
            $drawing->setDescription('Sampul Buku');
            $drawing->setPath(public_path('storage/'.$buku->sampul));
            $drawing->setCoordinates('H' . $row);
            $drawing->setHeight(100);
            $drawing->setWidth(100);
            $drawing->setWorksheet($sheet);
            $row++;
        }
        
    // Menyimpan Spreadsheet ke dalam file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_buku.xlsx';
        $writer->save($filename);

    // Mengirim file Excel sebagai respons HTTP
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
