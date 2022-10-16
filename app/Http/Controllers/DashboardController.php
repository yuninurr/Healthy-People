<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Frontpage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function landingpage()
    {
        $berita_terkini = DB::table('berita')->orderByDesc('created_at')->take(3)->get();
        $frontpage = Frontpage::first();
        return view('landingpage', compact('berita_terkini', 'frontpage'));
    }
    public function dashboard()
    {
        $header = (object) [
            'title' => 'Dashboard',
            'kategori' => 'Dashboard',
            'aksi' => 'Dashboard'
        ];
        return view('dashboard', compact('header'));
    }

    public function edit()
    {

        $frontpage = Frontpage::first();
        if ($frontpage) {
            $header = (object) [
                'title' => 'Edit Frontpage',
                'kategori' => 'Frontpage',
                'aksi' => 'Edit'
            ];
            return view('frontpage.edit', compact('frontpage', 'header'));
        } else {
            $header = (object) [
                'title' => 'Isi Frontpage',
                'kategori' => 'Frontpage',
                'aksi' => 'Isi'
            ];
            return view('frontpage.create', compact('header'));
        }
    }
    public function update(Request $request)
    {
        $header = (object) [
            'title' => 'Edit Frontpage',
            'kategori' => 'Frontpage',
            'aksi' => 'Edit'
        ];

        $frontpage = Frontpage::first();
        if ($frontpage != null) {
            $frontpage->syarat_vaksin = $request->syarat_vaksin;
            $frontpage->save();
        } else {
            $frontpage = new Frontpage();
            $frontpage->syarat_vaksin = $request->syarat_vaksin;
            $frontpage->save();
        }
        $frontpage = Frontpage::findOrFail(1);
        return redirect('frontpage')->with('sukses', 'Data Berhasil disimpan');
    }
}
