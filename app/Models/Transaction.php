<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'sparepart_id',
        'type',
        'quantity',
        'note'
    ];

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class);
    }
}
