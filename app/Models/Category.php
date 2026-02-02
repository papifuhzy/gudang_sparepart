<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // 1 kategori punya banyak sparepart
    public function spareparts()
    {
        return $this->hasMany(Sparepart::class);
    }
}
