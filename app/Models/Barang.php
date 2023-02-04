<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = "barangs";
    protected $fillable = [
        'nama',
        'deskripsi',
        'jenis',
        'stock',
        'harga_beli',
        'harga_jual',
        'foto',
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function laporans()
    {
        return $this->hasOne(Laporan::class);
    }
}
