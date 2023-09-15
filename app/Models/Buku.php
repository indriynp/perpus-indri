<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Penulis;

class Buku extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku', 'id');
    }
    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit', 'id');
    }
    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'id_penulis', 'id');
    }
    public function getJumlahBuku()
    {
        $query = Buku::query();

        return $query->count();
    }
}
