<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sparepart extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sparepart',
        'stok',
        'harga',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
