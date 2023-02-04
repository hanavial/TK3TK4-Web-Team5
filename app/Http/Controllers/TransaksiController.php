<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\Laporan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        if (auth()->guard('web')->user()) {
            $transaksi = Transaksi::where('user_id', auth()->guard('web')->user()->id)->orderBy('created_at', 'DESC')->get();
        } else {
            $transaksi = Transaksi::orderBy('created_at', 'DESC')->get();
        }
        return view('transaksi.index',compact('transaksi'));
    }

    public function create($id)
    {
        $get_row = Transaksi::orderBy('id', 'DESC')->get();
        $row_count = $get_row->count();
        $last_id = $get_row->first();

        $kode = "T00001";

        if ($row_count > 0) {
            if ($last_id->id < 9) {
                    $kode = "T0000".''.($last_id->id + 1);
            } else if ($last_id->id < 99) {
                    $kode = "T000".''.($last_id->id + 1);
            } else if ($last_id->id < 999) {
                    $kode = "T00".''.($last_id->id + 1);
            } else if ($last_id->id < 9999) {
                    $kode = "T0".''.($last_id->id + 1);
            } else {
                    $kode = "T".''.($last_id->id + 1);
            }
        }

        $user_id = auth()->guard('web')->user()->id;

        $barang = Barang::findOrFail($id);
        $user = User::findOrFail($user_id);

        return view('transaksi.create', compact('kode','barang','user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => ['required',],
            'keterangan' => ['required'],
        ]);

        Transaksi::create([
            'kode' => $request->kode,
            'barang_id' => $request->barang_id,
            'user_id' => $request->user_id,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'status' => 'Menunggu Konfirmasi',
        ]);

        return redirect()->route('user.transaksi.index');
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.show',compact('transaksi'));
    }

    public function confirm(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $laporan_by_barangid = Laporan::where('barang_id', $transaksi->barangs->id)->first();
        $laporan = Laporan::orderBy('id', 'DESC')->get();
        $row_count = $laporan->count();

        $transaksi->update([
            'status' => 'Terkonfirmasi'
        ]);

        $transaksi->barangs->where('id', $transaksi->barangs->id)->update(['stock' => ($transaksi->barangs->stock - $transaksi->jumlah)]);

        if($row_count == 0) {
            Laporan::create([
                'barang_id' => $transaksi->barangs->id,
                'jumlah' => $transaksi->jumlah,
            ]);
        } elseif ($row_count > 0) {
            if(!$laporan_by_barangid) {
                Laporan::create([
                    'barang_id' => $transaksi->barangs->id,
                    'jumlah' => $transaksi->jumlah,
                ]);
            } else {
                $laporan_by_barangid->where('barang_id', $transaksi->barangs->id)->update(['jumlah' => ($laporan_by_barangid->jumlah + $transaksi->jumlah)]);
            }
        }

        return redirect()->route('staff.transaksi.index');
    }

    public function reject(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => 'Ditolak'
        ]);

        return redirect()->route('staff.transaksi.index');
    }

    public function cancel(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->update([
            'status' => 'Dibatalkan Pembeli'
        ]);

        return redirect()->route('user.transaksi.index');
    }
}
