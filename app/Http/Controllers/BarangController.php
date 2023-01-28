<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::orderBy('created_at', 'DESC')->get();
        return view('barang.index',compact('barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required'],
            'jenis' => ['required', 'string', 'max:255'],
            'stock' => ['required'],
            'harga_beli' => ['required'],
            'harga_jual' => ['required'],
            'foto' => ['required', 'mimes:jpeg,jpg,bmp,png,gif,svg'],
        ]);

        $datetime = Carbon::now();
        $file = $request->file('foto');
        $file_name = $datetime->format("Y-m-d-H-i-s").'-'.$file->getClientOriginalName();
        $file->storeAs('public/foto',$file_name);
        $file_photo = $file_name;

        Barang::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'jenis' => $request->jenis,
            'stock' => $request->stock,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'foto' => $file_photo,
        ]);

        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin.barang.index');
        } elseif (auth()->guard('staff')->user()) {
            return redirect()->route('staff.barang.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.show',compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit',compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required'],
            'jenis' => ['required', 'string', 'max:255'],
            'stock' => ['required'],
            'harga_beli' => ['required'],
            'harga_jual' => ['required'],
            'foto' => ['required', 'mimes:jpeg,jpg,bmp,png,gif,svg'],
        ]);

        $datetime = Carbon::now();
        $file = $request->file('foto');
        $file_name = $datetime->format("Y-m-d-H-i-s").'-'.$file->getClientOriginalName();
        $file->storeAs('public/foto',$file_name);
        $file_photo = $file_name;
        Storage::delete('public/foto/' . $barang->foto);

        $barang->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'jenis' => $request->jenis,
            'stock' => $request->stock,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'foto' => $file_photo,
        ]);

        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin.barang.index');
        } elseif (auth()->guard('staff')->user()) {
            return redirect()->route('staff.barang.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        Storage::delete('public/foto/' . $barang->foto);
        $barang->delete();

        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin.barang.index');
        } elseif (auth()->guard('staff')->user()) {
            return redirect()->route('staff.barang.index');
        }
    }
}
