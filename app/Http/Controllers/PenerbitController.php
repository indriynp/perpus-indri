<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Redirect;
use PDF;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penerbit = Penerbit::all();

        return view('pages.admin.penerbit.index', [
            'penerbit' => $penerbit,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.penerbit.create', [
            'title' => 'Tambah penerbit',
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

        Penerbit::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
        ]);

        return Redirect::route('penerbit_index')->with('toast_success','Data Berhasil di Tambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Penerbit::findOrFail($id);

        return view('pages.admin.penerbit.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Penerbit::findOrFail($id);

         return view('pages.admin.penerbit.edit', [
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penerbit $penerbit)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
            'email' => 'required',
        ]);

        $penerbit->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,

        ]);

        return Redirect::route('penerbit_index')->with('toast_success','Data Berhasil di Rubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerbit $penerbit)
    {
         Penerbit::destroy($penerbit->id);

        return redirect('/penerbit')->with('toast_success','Data Berhasil di Hapus!');
    }
    public function generatePDF()
    {
        $penerbit = Penerbit::get();
  
        $data = [
            'penerbit' => $penerbit,
        ]; 
            
        $pdf = PDF::loadView('pages.admin.penerbit.myPDF', $data);
     
        return $pdf->stream();
    }

    public function search(Request $request) {
        if($request->has('search')) {
            $penerbit = Penerbit::where('nama','LIKE','%'.$request->search.'%')
            ->orWhere('email','LIKE','%'.$request->search.'%')->get();
        }
        else {
            $penerbit = Penerbit::all();
        }
       return view('pages.admin.penerbit.index', [
            'penerbit' => $penerbit,
        ]);
    }

    public function exportPenerbitToExcel()
    {
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Nama Penerbit');
        $sheet->setCellValue('B1', 'Alamat');
        $sheet->setCellValue('C1', 'Telepon');
        $sheet->setCellValue('D1', 'Email');

    // Mengambil data penerbit dari model Penerbit
        $penerbit = Penerbit::all();

        $row = 2;
        foreach ($penerbit as $terbit) {
            $sheet->setCellValue('A' . $row, $terbit->nama);
            $sheet->setCellValue('B' . $row, $terbit->alamat);
            $sheet->setCellValue('C' . $row, $terbit->telepon);
            $sheet->setCellValue('D' . $row, $terbit->email);
            $row++;
        }
        
    // Menyimpan Spreadsheet ke dalam file Excel
        $writer = new Xlsx($spreadsheet);
        $filename = 'data_penerbit.xlsx';
        $writer->save($filename);

    // Mengirim file Excel sebagai respons HTTP
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}
