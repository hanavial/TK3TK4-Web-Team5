<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::with('barangs')->orderBy(Barang::select('nama')->whereColumn('barangs.id','laporans.barang_id'))->get();

        return view('laporan.index',compact('laporan'));
    }

    public function grafik()
    {
        $data = Laporan::with('barangs')->orderBy(Barang::select('nama')->whereColumn('barangs.id','laporans.barang_id'))->get();

        //Data untuk Grafik
        $nama_barang = [];
        $jumlah = [];
        $net = [];
        $gross = [];

        foreach ($data as $dt) {
            $nama_barang[] = $dt->barangs->nama;
            $jumlah[] = $dt->jumlah;
            $net[] = ($dt->barangs->harga_jual - $dt->barangs->harga_beli) * $dt->jumlah;
            $gross[] = $dt->barangs->harga_jual * $dt->jumlah;
        }

        return view('laporan.grafik',compact('data','nama_barang','jumlah','net','gross'));
    }
}
