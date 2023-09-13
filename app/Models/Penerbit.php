<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Penerbit extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'id_penerbit', 'id');
    }
}
