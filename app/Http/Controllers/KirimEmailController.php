<?php

namespace App\Http\Controllers;

use App\Mail\KirimEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KirimEmailController extends Controller
{
    public function index($id)
    {
        $user = User::where('id', $id)->first();
        Mail::to($user->email)->send(new KirimEmail());

        //* UPDATE TANGGAL EMAIL TERKIRIM PADA TABEL USER
        $user->email_terkirim = now();
        $user->save();


        return redirect('pemberitahuan-vaksin')->with('terkirim', 'email berhasil terkirim');
    }
    public function email()
    {
        return view('kirimemail');
    }
}
