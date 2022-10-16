<?php

namespace App\Http\Controllers;

use App\Models\JenisVaksin;
use Illuminate\Http\Request;

class JenisVaksinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = (object) [
            'title' => 'Daftar Jenis Vaksin',
            'kategori' => 'Jenis Vaksin',
            'aksi' => 'Daftar'
        ];
        $jenis_vaksin = JenisVaksin::all();
        return view('jenis_vaksin.index', compact('jenis_vaksin', 'header'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header = (object) [
            'title' => 'Tambah Jenis Vaksin',
            'kategori' => 'Jenis Vaksin',
            'aksi' => 'Tambah'
        ];
        return view('jenis_vaksin.create', compact('header'));
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
            'nama' => 'required',
            'status' => 'required'
        ]);
        $jenis_vaksin = new JenisVaksin();
        $jenis_vaksin->nama = $request->nama;
        $jenis_vaksin->status = $request->status;
        $jenis_vaksin->save();

        return redirect('jenis_vaksin')->with('tambah', 'Jenis vaksin ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisVaksin  $jenis_vaksin
     * @return \Illuminate\Http\Response
     */
    public function show(JenisVaksin $jenis_vaksin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisVaksin  $jenis_vaksin
     * @return \Illuminate\Http\Response
     */
    public function edit(JenisVaksin $jenis_vaksin)
    {
        $header = (object) [
            'title' => 'Daftar Jenis Vaksin',
            'kategori' => 'Jenis Vaksin',
            'aksi' => 'Daftar'
        ];
        return view('jenis_vaksin.edit', compact('jenis_vaksin', 'header'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JenisVaksin  $jenis_vaksin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JenisVaksin $jenis_vaksin)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required'
        ]);
        $jenis_vaksin->nama = $request->nama;
        $jenis_vaksin->status = $request->status;
        $jenis_vaksin->save();
        return redirect('jenis_vaksin')->with('edit', 'Jenis vaksin berubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisVaksin  $jenis_vaksin
     * @return \Illuminate\Http\Response
     */
    public function destroy(JenisVaksin $jenis_vaksin)
    {
        //
    }
}
