<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = "transaksis";
    protected $fillable = [
        'kode',
        'barang_id',
        'user_id',
        'jumlah',
        'keterangan',
        'status',
    ];

    public function barangs()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
