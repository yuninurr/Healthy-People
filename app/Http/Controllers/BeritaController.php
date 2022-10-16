<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = (object) [
            'title' => 'Daftar Berita',
            'kategori' => 'Berita',
            'aksi' => 'Daftar'
        ];
        $berita = Berita::all();
        return view('berita.index', compact('header', 'berita'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $header = (object) [
            'title' => 'Daftar Berita',
            'kategori' => 'Berita',
            'aksi' => 'Daftar'
        ];
        return view('berita.create', compact('header'));
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
            'judul' => 'required|unique:berita',
            'deskripsi' => 'required',
            'foto' => 'image|max:1024',
            'kategori' => 'required'
        ]);
        $slug = Str::slug($request->judul);
        $slug = Str::lower($slug);
        $berita = new Berita();
        $berita->judul = $request->judul;
        $berita->slug = $slug;
        $berita->deskripsi = $request->deskripsi;
        $berita->kategori = $request->kategori;
        if ($request->file('foto')) {
            $berita->foto = $request->file('foto')->store('berita');
        }
        $berita->save();
        return redirect('berita')->with('tambah', 'Data Berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function show(Berita $beritum)
    {
        $berita = $beritum;

        $header = (object) [
            'title' => 'Detail Berita',
            'kategori' => 'Berita',
            'aksi' => 'Detail'
        ];
        return view('berita.show', compact('header', 'berita'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function edit(Berita $beritum)
    {
        $berita = $beritum;

        $header = (object) [
            'title' => 'Edit Berita',
            'kategori' => 'Berita',
            'aksi' => 'Edit'
        ];
        return view('berita.edit', compact('header', 'berita'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Berita $beritum)
    {
        $berita = $beritum;
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|max:1024',
            'kategori' => 'required'
        ]);

        $slug = Str::slug($request->judul);
        $slug = Str::lower($slug);
        $berita->judul = $request->judul;
        $berita->slug = $slug;
        $berita->deskripsi = $request->deskripsi;
        $berita->kategori = $request->kategori;
        if ($request->file('foto')) {
            if ($request->oldGambar) {
                Storage::delete($request->oldGambar);
            }
            $berita->foto = $request->file('foto')->store('berita');
        }
        $berita->save();
        return redirect('berita')->with('edit', 'Data Berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Berita  $berita
     * @return \Illuminate\Http\Response
     */
    public function destroy(Berita $beritum)
    {
        $berita = $beritum;
        $berita->delete();
        return redirect('berita')->with('hapus', 'Data berhasi dihapus');
    }

    public function berita_detail($slug)
    {
        $berita = Berita::where('slug', $slug)->first();
        $berita_terkini = DB::table('berita')->orderByDesc('created_at')->take(3)->get();
        return view('blog.index', compact('berita', 'berita_terkini'));
    }
    public function koleksi_berita()
    {
        $semua_berita = Berita::all();
        $berita_terkini = DB::table('berita')->orderByDesc('created_at')->take(3)->get();
        return view('blog.koleksi', compact('semua_berita', 'berita_terkini'));
    }
}
