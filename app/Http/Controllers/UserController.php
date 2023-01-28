<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('created_at', 'DESC')->get();
        return view('user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'name' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required'],
            'alamat' => ['required'],
            'ktp' => ['required', 'mimes:jpeg,jpg,bmp,png,gif,svg'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $datetime = Carbon::now();
        $file = $request->file('ktp');
        $file_name = $datetime->format("Y-m-d-H-i-s").'-'.$file->getClientOriginalName();
        $file->storeAs('public/ktp',$file_name);
        $file_photo = $file_name;

        User::create([
            'name' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'ktp' => $file_photo,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin.user.index');
        } elseif (auth()->guard('staff')->user()) {
            return redirect()->route('staff.user.index');
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
        $user = User::findOrFail($id);
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit',compact('user'));
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
        $user = User::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required'],
            'alamat' => ['required'],
            'ktp' => ['required', 'mimes:jpeg,jpg,bmp,png,gif,svg'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        $datetime = Carbon::now();
        $file = $request->file('ktp');
        $file_name = $datetime->format("Y-m-d-H-i-s").'-'.$file->getClientOriginalName();
        $file->storeAs('public/ktp',$file_name);
        $file_photo = $file_name;
        Storage::delete('public/ktp/' . $user->ktp);

        $user->update([
            'name' => $request->name,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'ktp' => $file_photo,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin.user.index');
        } elseif (auth()->guard('staff')->user()) {
            return redirect()->route('staff.user.index');
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
        $user = User::findOrFail($id);
        Storage::delete('public/ktp/' . $user->ktp);
        $user->delete();

        if (auth()->guard('admin')->user()) {
            return redirect()->route('admin.user.index');
        } elseif (auth()->guard('staff')->user()) {
            return redirect()->route('staff.user.index');
        }
    }
}
