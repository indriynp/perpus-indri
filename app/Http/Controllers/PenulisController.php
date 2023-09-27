<?php

namespace App\Http\Controllers;

use App\Models\Penulis;
use App\Models\Buku;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Redirect;
use PDF;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penulis = Penulis::all();

        return view('pages.admin.penulis.index', [
            'penulis' => $penulis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.penulis.create', [
            'title' => 'Tambah penulis',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        Penulis::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,

        ]);

        return Redirect::route('penulis_index')->with('toast_success','Data Berhasil di Tambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Penulis::findOrFail($id);

        return view('pages.admin.penulis.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Penulis::findOrFail($id);

         return view('pages.admin.penulis.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penulis $penulis)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        $penulis->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,

        ]);

        return Redirect::route('penulis_index')->with('toast_success','Data Berhasil di Rubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penulis $penulis)
    {
       Penulis::destroy($penulis->id);

        return redirect('/penulis')->with('toast_success','Data Berhasil di Hapus!');
    }

    public function generatePDF()
    {
        $penulis = Penulis::get();
  
        $data = [
            'penulis' => $penulis,
        ]; 
            
        $pdf = PDF::loadView('pages.admin.penulis.myPDF', $data);
     
        return $pdf->stream();
    }

    public function search(Request $request) {
        if($request->has('search')) {
            $penulis = Penulis::where('nama','LIKE','%'.$request->search.'%')
            ->orWhere('email','LIKE','%'.$request->search.'%')->get();
        }
        else {
            $penulis = Penulis::all();
        }
       return view('pages.admin.penulis.index', [
            'penulis' => $penulis,
        ]);
    }

    public function exportPenulisToExcel()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nama Penulis');
        $sheet->setCellValue('B1', 'Alamat');
        $sheet->setCellValue('C1', 'Telepon');
        $sheet->setCellValue('D1', 'Email');

    // Mengambil data penulis dari model Penulis
        $penulis = Penulis::all();

        $row = 2;
        foreach ($penulis as $pen) {
            $sheet->setCellValue('A' . $row, $pen->nama);
            $sheet->setCellValue('B' . $row, $pen->alamat);
            $sheet->setCellValue('C' . $row, $pen->telepon);
            $sheet->setCellValue('D' . $row, $pen->email);
            $row++;
        }
        
    // Menyimpan Spreadsheet ke dalam file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_penulis.xlsx';
        $writer->save($filename);

    // Mengirim file Excel sebagai respons HTTP
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
