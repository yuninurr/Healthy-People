<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $header = (object) [
            'title' => 'Edit Profil',
            'kategori' => 'Profil',
            'aksi' => 'Edit'
        ];
        $provinsi = Provinsi::all();
        $user  = User::where('id', auth()->user()->id)->get()->first();
        return view('profil.index', compact('header', 'user', 'provinsi'));
    }
    public function simpan_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'tanggal_lahir' => 'required',
            'provinsi' => 'required',
            'no_telp' => 'required',
            'alamat_lengkap' => 'required',
        ]);
        $profil = User::findOrFail(auth()->user()->id);
        $profil->name = $request->name;
        $profil->nik = $request->nik;
        $profil->tanggal_lahir = $request->tanggal_lahir;
        $profil->provinsi_id = $request->provinsi;
        $profil->no_telp = $request->no_telp;
        $profil->alamat_lengkap = $request->alamat_lengkap;
        $profil->save();
        return redirect('profil')->with('edit', 'Data Berhasil disimpan');
    }
}
