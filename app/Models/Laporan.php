<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = "laporans";
    protected $fillable = [
        'barang_id',
        'jumlah',
    ];

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
