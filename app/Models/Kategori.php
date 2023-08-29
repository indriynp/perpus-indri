<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Idkategori;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function idkategori(){
        return $this->belongsTo(Idkategori::class, 'idkategori');
     }
}
