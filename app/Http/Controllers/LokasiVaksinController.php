<?php

namespace App\Http\Controllers;

use App\Models\LokasiVaksin;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class LokasiVaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = (object) [
            'title' => 'Daftar Lokasi Vaksin',
            'kategori' => 'Lokasi Vaksin',
            'aksi' => 'Daftar'
        ];
        $lokasi_vaksin = LokasiVaksin::all();
        return view('lokasi.index', compact('lokasi_vaksin', 'header'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header = (object) [
            'title' => 'Tambah Lokasi Vaksin',
            'kategori' => 'Lokasi Vaksin',
            'aksi' => 'Tambah'
        ];
        $provinsi = Provinsi::all();
        return view('lokasi.create', compact('header', 'provinsi'));
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
            'provinsi' => 'required',
            'nama_tempat' => 'required',
            'alamat_lengkap' => 'required',
            'waktu_mulai' => 'required',
            'waktu_akhir' => 'required',
            'no_telp' => 'required',
            'status' => 'required'
        ]);
        $lokasi = new LokasiVaksin();
        $lokasi->provinsi_id = $request->provinsi;
        $lokasi->nama_tempat = $request->nama_tempat;
        $lokasi->alamat_lengkap = $request->alamat_lengkap;
        $lokasi->waktu_mulai = $request->waktu_mulai;
        $lokasi->waktu_akhir = $request->waktu_akhir;
        $lokasi->no_telp = $request->no_telp;
        $lokasi->status = $request->status;
        $lokasi->save();
        return redirect('lokasi')->with('tambah', 'Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LokasiVaksin  $lokasiVaksin
     * @return \Illuminate\Http\Response
     */
    public function show(LokasiVaksin $lokasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LokasiVaksin  $lokasiVaksin
     * @return \Illuminate\Http\Response
     */
    public function edit(LokasiVaksin $lokasi)
    {


        //! TIDAK BISA MENDAPATKAN LOKASI VAKSIN BERDASARKAN ID
        $header = (object) [
            'title' => 'Edit Lokasi Vaksin',
            'kategori' => 'Lokasi Vaksin',
            'aksi' => 'Edit'
        ];
        $provinsi = Provinsi::all();
        return view('lokasi.edit', compact('header', 'provinsi', 'lokasi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LokasiVaksin  $lokasiVaksin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LokasiVaksin $lokasi)
    {
        $request->validate([
            'provinsi' => 'required',
            'nama_tempat' => 'required',
            'alamat_lengkap' => 'required',
            'waktu_mulai' => 'required',
            'waktu_akhir' => 'required',
            'no_telp' => 'required',
            'status' => 'required'
        ]);

        $lokasi->provinsi_id = $request->provinsi;
        $lokasi->nama_tempat = $request->nama_tempat;
        $lokasi->alamat_lengkap = $request->alamat_lengkap;
        $lokasi->waktu_mulai = $request->waktu_mulai;
        $lokasi->waktu_akhir = $request->waktu_akhir;
        $lokasi->no_telp = $request->no_telp;
        $lokasi->status = $request->status;
        $lokasi->save();
        return redirect('lokasi')->with('edit', 'Data Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LokasiVaksin  $lokasiVaksin
     * @return \Illuminate\Http\Response
     */
    public function destroy(LokasiVaksin $lokasi)
    {
        //
    }
    public function get_lokasi_vaksin(Request $request)
    {
        $id = $request->id;
        $lokasi = LokasiVaksin::where(['provinsi_id' => $id, 'status' => 1])->get();
        foreach ($lokasi as $lok) {
            echo "<option value='$lok->id'>$lok->nama_tempat , $lok->alamat_lengkap</option>";
        }
    }
}
