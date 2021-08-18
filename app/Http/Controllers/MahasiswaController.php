<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Symfony\Component\Console\Input\Input;
use App\Post;
use Illuminate\Support\Str;
use \App\sip;
use Carbon;

class MahasiswaController extends Controller
{
    public function tampilanMahasiswa(){
        $myString = auth()->user()->email;
        $dataMhs = DB::table('mahasiswa')->where('emailMhs', $myString)->get();
        $dataDosen = DB::table('dosen')
        ->join('mahasiswa', 'mahasiswa.nidn', '=', 'dosen.nidn')
        ->select(DB::raw('dosen.namaDosen,dosen.nidn,dosen.emailDosen'))
        ->where('mahasiswa.emailMhs', $myString)
        ->get();
        $pengumuman = DB::table('perwalian')
        ->join('peserta', 'peserta.id_jadwal', '=', 'perwalian.id_jadwal')
        ->join('mahasiswa', 'mahasiswa.nim', 'peserta.nim')
        ->select(DB::raw('perwalian.tanggalPerwalian,perwalian.jamPerwalian,perwalian.keterangan,perwalian.kategori,peserta.nim,mahasiswa.namaMhs'))
        ->where('mahasiswa.emailMhs', $myString)
        ->where('perwalian.status', '=', 'proses')
        ->get();
        return view('sip.mahasiswa.tampilanMahasiswa', ['dataMhs'=>$dataMhs, 'dataDosen'=>$dataDosen, 'pengumuman'=>$pengumuman]);
    }

    // public function openTranskripMandiri($id){
    //     $path = public_path('transkripNilai/' . $id . '.pdf');
    //     header("Content-type: application/pdf");
    //     header("Content-Length: " . filesize($path));
    //     readfile($path);
    // }

    // public function openKhsMandiri($id, Request $request){
    //     $semester = $request->semesterMandiri;
    //     $path = public_path('khs/' . $id . '_' . $semester .'.pdf');
    //     header("Content-type: application/pdf");
    //     header("Content-Length: " . filesize($path));
    //     readfile($path);
    // }

    public function tampilpengajuan(){
        $myString = auth()->user()->email;
        $nim = DB::table('mahasiswa')->where('emailMhs', $myString)->get();
        $dataPengajuan = DB::table('pengajuan')
        ->join('mahasiswa', 'mahasiswa.nim', '=', 'pengajuan.nim')
        ->select(DB::raw('pengajuan.nim,pengajuan.keterangan,pengajuan.status'))
        ->where('mahasiswa.emailMhs', $myString)
        ->paginate(5);
        return view('sip.mahasiswa.tampilPengajuan', ['dataPengajuan' => $dataPengajuan, 'nim'=>$nim]);   
    }

    public function simpanpengajuan(Request $request){
        $tanggalSekarang = Carbon\Carbon::now();
        $waktuSekarang = Carbon\Carbon::now();
        DB::table('pengajuan')->insert([
            'nim' => $request->nimPengajuan,
            'keterangan' => $request->keteranganPengajuan,
            'tanggalSetup' => $tanggalSekarang,
            'jamSetup' => $waktuSekarang,
            'status' => 'proses'
        ]);
        return redirect('/sip/pengajuan');
    }
    
}
