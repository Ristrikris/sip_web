<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Symfony\Component\Console\Input\Input;
use App\Post;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $myString = auth()->user()->email;
        $nim = DB::table('mahasiswa')->select('nim')
            ->where('emailMhs', $myString)
            ->get();
        $nidn = DB::table('dosen')->select('nidn')
            ->where('emailDosen', $myString)
            ->get();
        $users = DB::table('dosen')->where('emailDosen', $myString)->value('statusDsn');
        $emailDos = DB::table('dosen')->where('emailDosen', $myString)->value('emailDosen');
        $email = DB::table('mahasiswa')->where('emailMhs', $myString)->value('emailMhs');

        if ($contains = Str::contains($myString, 'si.ukdw.ac.id') && $email == "") {
            return view('logout');
        } else if ($contains = Str::contains($myString, 'si.ukdw.ac.id') && $email != "") {
            return view('homeMahasiswa', ['nim' => $nim]);
        } else if ($emailDos == "") {
            return view('logout');
        } else if ($contains = Str::contains($myString, 'gmail.com') && $users == "admin") {
            return view('homeAdmin', ['nidn' => $nidn]);
        } else if ($contains = Str::contains($myString, 'gmail.com') && $users == "dosen") {
            return view('homeDosen', ['nidn' => $nidn]);
        }
    }

    public function index_dosen()
    {
        $myString = auth()->user()->email;
        $nidn = DB::table('dosen')->select('nidn')
            ->where('emailDosen', $myString)
            ->get();
        return view('homeDosen', ['nidn' => $nidn]);
    }

    public function index_admin()
    {
        $myString = auth()->user()->email;
        $nidn = DB::table('dosen')->select('nidn')
            ->where('emailDosen', $myString)
            ->get();
        return view('homeAdmin', ['nidn' => $nidn]);
    }

    public function isiData(Request $request)
    {
        $email = auth()->user()->email;
        $nama = auth()->user()->name;
        DB::table('mahasiswa')->insert([
            'nim' => $request->nim,
            'namaMhs' => $nama,
            'emailMhs' => $email
        ]);
        return redirect()->route('homeMahasiswa');
    }

    public function log()
    {
        return view('login');
    }
}
