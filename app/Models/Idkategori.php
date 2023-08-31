<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idkategori extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function Kategori()
    {
        return $this->hasMany(Kategori::class);
    }
}
