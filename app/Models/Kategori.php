<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'id_kategori', 'id');
    }
    public function getDaftarBuku()
    {
       return Buku::where('id_kategori', '=', $this->id)
            ->get();
    }
    public function getJumlahBuku()
    {
        $query = Buku::query();

        $query->where('id_kategori', '=', $this->id);

        return $query->count();
    }
}
