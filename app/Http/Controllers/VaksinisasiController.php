<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\JenisVaksin;
use App\Models\LokasiVaksin;
use App\Models\Provinsi;
use App\Models\User;
use App\Models\Vaksinisasi;
use Illuminate\Http\Request;

class VaksinisasiController extends Controller
{
    public function index()
    {
        $header = (object) [
            'title' => 'Daftar Riwayat Vaksin',
            'kategori' => 'Riwayat Vaksin',
            'aksi' => 'Daftar'
        ];
        $vaksinisasi = Vaksinisasi::where('user_id', auth()->user()->id)->get();
        return view('riwayat.index', compact('header', 'vaksinisasi'));
    }
    public function vaksinisasi_booth()
    {
        $header = (object) [
            'title' => 'Daftar Semua Vaksinisasi',
            'kategori' => 'Semua Vaksinisasi',
            'aksi' => 'Daftar'
        ];
        $vaksinisasi = Vaksinisasi::where('rumah', 0)->get();
        return view('vaksinisasi.vaksinisasi_booth', compact('header', 'vaksinisasi'));
    }
    public function vaksinisasi_rumah()
    {
        $header = (object) [
            'title' => 'Daftar Vaksinisasi Rumah',
            'kategori' => 'Vaksinisasi Rumah',
            'aksi' => 'Daftar'
        ];
        $vaksinisasi = Vaksinisasi::where('rumah', 1)->get();
        return view('vaksinisasi.vaksinisasi_rumah', compact('header', 'vaksinisasi'));
    }
    public function pemberitahuan_vaksin()
    {
        $header = (object) [
            'title' => 'Daftar Pemberitahuan vaksin',
            'kategori' => 'Pemberitahuan Vaksin',
            'aksi' => 'Daftar'
        ];
        $vaksinisasi = Vaksinisasi::where('rumah', 1)->get();
        $users = User::where('role', 'user')->get();

        return view('vaksinisasi.pemberitahuan_email', compact('header', 'vaksinisasi', 'users'));
    }
    public function daftar_vaksin()
    {
        $header = (object) [
            'title' => 'Pendaftaran Vaksinisasi',
            'kategori' => 'Vaksinisasi',
            'aksi' => 'Pendaftaran'
        ];
        $provinsi = Provinsi::all();
        $jenis_vaksin = JenisVaksin::where('status', 1)->get();
        $lokasi_vaksin = LokasiVaksin::where('status', 1)->get();
        return view('pendaftaran.index', compact('header', 'provinsi', 'jenis_vaksin', 'lokasi_vaksin'));
    }
    public function simpan_daftar_vaksin(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'jenis_vaksin' => 'required',
            'rumah' => 'required',
            'gelombang_vaksin' => 'required',
        ]);
        $vaksin_saya = Vaksinisasi::where('user_id', '=', auth()->user()->id)->where('status', '!=', '2')->count();
        if ($vaksin_saya != 0) {
            return redirect('riwayat')->with('terdaftar', 'Anda sudah mendaftar');
        }



        $vaksinisasi = new Vaksinisasi();
        $vaksinisasi->user_id = auth()->user()->id;
        $vaksinisasi->tanggal = $request->tanggal;
        $vaksinisasi->jenis_vaksin_id = $request->jenis_vaksin;
        $vaksinisasi->gelombang_vaksin = $request->gelombang_vaksin;
        $vaksinisasi->rumah = $request->rumah;
        $vaksinisasi->status = 0;
        if ($request->rumah == 1) {
            $vaksinisasi->provinsi_id = auth()->user()->provinsi_id;
            $vaksinisasi->alamat_lengkap = auth()->user()->alamat_lengkap;
        } else {
            $vaksinisasi->provinsi_id = $request->provinsi;
            $vaksinisasi->lokasi_vaksin_id = $request->lokasi_vaksin;

            //* CEK ANTRIAN VAKSIN
            $antrian = Vaksinisasi::where(['tanggal' => $request->tanggal, 'lokasi_vaksin_id' => $request->lokasi_vaksin])->count();
            $vaksinisasi->no_antrian = $antrian + 1;
        }


        $vaksinisasi->save();

        return redirect('riwayat')->with('daftar', 'Pendaftaran berhasil');
    }
    public function set_dokter($id)
    {
        $header = (object) [
            'title' => 'Detail Vaksinisasi Rumah',
            'kategori' => 'Vaksinisasi Rumah',
            'aksi' => 'Detail'
        ];
        $vaksinisasi = Vaksinisasi::where('id', $id)->first();
        $dokter = Dokter::where(['provinsi_id' => $vaksinisasi->provinsi_id, 'status' => 1])->get();
        return view('vaksinisasi.detail_vaksinisasi_rumah', compact('header', 'vaksinisasi', 'dokter'));
    }
    public function simpan_set_dokter(Request $request)
    {
        $request->validate([
            'dokter' => 'required',
            'id' => 'required'
        ]);
        $vaksinisasi = Vaksinisasi::where('id', $request->id)->first();
        $vaksinisasi->dokter_id = $request->dokter;
        $vaksinisasi->status = 1;
        $vaksinisasi->save();
        return redirect('vaksinisasi-rumah')->with('edit', 'Data Berhasil disimpan');
    }
    public function detail_vaksinisasi_booth($id)
    {
        $header = (object) [
            'title' => 'Detail Vaksinisasi Booth',
            'kategori' => 'Vaksinisasi Booth',
            'aksi' => 'Detail'
        ];
        $vaksinisasi = Vaksinisasi::where('id', $id)->first();
        return view('vaksinisasi.detail_vaksinisasi_booth', compact('header', 'vaksinisasi'));
    }
    public function simpan_verifikasi(Request $request)
    {
        $vaksinisasi = Vaksinisasi::where('id', $request->id)->first();
        $vaksinisasi->status = $request->status;
        $vaksinisasi->save();

        //* SIMPAN TANGGAL VAKSIN TERAKHIR PADA TABEL USER

        $user = User::where('id', $vaksinisasi->user_id)->first();
        $user->vaksin_terakhir = $vaksinisasi->tanggal;
        $user->save();

        if ($vaksinisasi->rumah == 0) {
            return redirect('vaksinisasi-booth')->with('verifikasi', 'Verifikasi Berhasil');
        } else {
            return redirect('vaksinisasi-rumah')->with('verifikasi', 'Verifikasi Berhasil');
        }
    }
}
