<?php
  
namespace App\Exports;
  
use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
  
class BukuExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Buku::select("nama", "tahun_terbit", "id_penulis", "id_penerbit", "id_kategori", "sinopsis", "jumlah", "sampul")->get();
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Nama Buku", "Tahun Terbit", "Penulis", "Penerbit", "Kategori", "Sinopsis", "Jumlah", "Sampul"];
    }
}