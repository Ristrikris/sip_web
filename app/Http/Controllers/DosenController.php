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
use App\Exports\MttRegistrationsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class DosenController extends Controller
{

//-----------------------------------------------------------------------------------------------------------Umum
    public function tampilPerwalianUmum(){
        $myString = auth()->user()->email;
        $namaLogin = auth()->user()->name;
        $namaDosen = DB::table('dosen')->select('namaDosen')->where('emailDosen', $myString)->get();
        $nidnLogin = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        $jadwalUmum = DB::table('perwalian')
        ->join('dosen', 'dosen.nidn', '=', 'perwalian.nidn')
        ->where('status', 'proses')
        ->where('kategori', 'umum')
        ->where('dosen.emailDosen', $myString)
        ->paginate(5);
        $jadwalUmumSelesai = DB::table('perwalian')
        ->join('dosen', 'dosen.nidn', '=', 'perwalian.nidn')
        ->where('dosen.emailDosen', $myString)
        ->where('status', 'selesai')
        ->where('kategori', 'umum')->paginate(5);
        return view('sip.dosen.tampilJadwalUmum', ['jadwalUmum'=>$jadwalUmum, 'namaDosen'=>$namaDosen, 'nidnLogin'=>$nidnLogin, 'jadwalUmumSelesai'=>$jadwalUmumSelesai]);
    }

    public function formPerwalianUmum(){
        $myString = auth()->user()->email;
        $nidn = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        return view('sip.dosen.tambahJadwalUmum', ['nidn'=>$nidn]);
    }

    public function tambahPerwalianUmum(Request $request){
        $tanggalSekarang = Carbon\Carbon::now();
        $waktuSekarang = Carbon\Carbon::now();
        DB::table('perwalian')->insert([
            'nidn' => $request->nidn,
            'kategori' => 'umum',
            'keterangan' => $request->keterangan,
            'tanggalPerwalian' => $request->tanggalPerwalian,
            'jamPerwalian' => $request->jamPerwalian,
            'tanggalSetup' => $tanggalSekarang,
            'jamSetup' => $waktuSekarang
        ]);
        return redirect('/sip/perwalianUmum')->with(['success', 'Jadwal Berhasil Ditambah']);
    }

    public function lihatMahasiswa(){
        $khs = DB::table('khs')->select('semester')->get();
        $myString = auth()->user()->email;
        $namaLogin = auth()->user()->name;
        $namaDosen = DB::table('dosen')->select('namaDosen')->where('emailDosen', $myString)->get();
        $nidnLogin = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        
        $mahasiswa = DB::table('mahasiswa')
        ->join('dosen', 'dosen.nidn', '=', 'mahasiswa.nidn')
        ->select(DB::raw('mahasiswa.nim,mahasiswa.namaMhs,mahasiswa.prodi,mahasiswa.angkatan,mahasiswa.emailMhs'))
        ->where('dosen.emailDosen', $myString)
        ->orderBy('mahasiswa.nim')
        ->paginate(5);
        return view('sip.dosen.lihatMahasiswa', ['khs'=>$khs, 'namaDosen'=>$namaDosen, 'nidnLogin'=>$nidnLogin, 'mahasiswa'=>$mahasiswa]);

    }

    public function formEdit($id){
        $myString = auth()->user()->email;
        $nidnLogin = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        $jadwalUmum = DB::table('perwalian')->where('id_jadwal', $id)->get();
        return view('sip.dosen.editjadwalUmum', ['jadwalUmum' => $jadwalUmum, 'nidnLogin' => $nidnLogin]);
    }

    public function simpanEdit($id, Request $request){
        $tanggalSekarang = Carbon\Carbon::now();
        $waktuSekarang = Carbon\Carbon::now();
        $jadwalUmum = DB::table('perwalian')->where('id_jadwal', $id)->update([
            'nidn' => $request->nidn,
            'kategori' => 'umum',
            'keterangan' => $request->keterangan,
            'tanggalPerwalian' => $request->tanggalPerwalian,
            'jamPerwalian' => $request->jamPerwalian,
            'tanggalSetup' => $tanggalSekarang,
            'jamSetup' => $waktuSekarang
        ]);
        return redirect('/sip/perwalianUmum')->with(['success', 'Data Berhasil di update']);
    }

    // public function deletePerwalian($id){
    //     $jadwalUmum = DB::table('perwalian')->where('id_jadwal', $id);
    //     $jadwalUmum->delete();
    //     return redirect('/sip/perwalianUmum')->with(['success', 'Data Berhasil di hapus']);
    // }
    
    public function formCatatan($id){
        $jadwalUmum = DB::table('perwalian')->where('id_jadwal', $id)->get();
        return view('sip.dosen.catatan', ['jadwalUmum' => $jadwalUmum]);
    }

    // public function simpanCatatan(Request $request){
    //     DB::table('catatan')->insert([
    //         'nim' => $request->nim,
    //         'id_jadwal' => $request->id_jadwal,
    //         'catatanMhs' => $request->catatanMhs
    //     ]);
    //     return redirect('/sip/perwalianUmum');
    // }

    // public function formEditCatatan($id){
    //     $catatan = DB::table('catatan')->where('id_jadwal', $id)->get();
    //     return view('sip.dosen.editCatatan', ['catatan' => $catatan]);
    // }

    // public function simpanEditCatatan($id, Request $request){
    //     DB::table('catatan')->where('id_catatan', $id)->update([
    //         'nim' => $request->nim,
    //         'id_jadwal' => $request->id_jadwal,
    //         'catatanMhs' => $request->catatanMhs
    //     ]);
    //     return redirect('/sip/perwalianUmum');
    // }

    public function lihatKhs(){
        $myString = auth()->user()->email;
        $namaLogin = auth()->user()->name;
        $namaDosen = DB::table('dosen')->select('namaDosen')->where('emailDosen', $myString)->get();
        $nidnLogin = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        $mahasiswa = DB::table('mahasiswa')
        ->join('dosen', 'dosen.nidn', '=', 'mahasiswa.nidn')
        ->select(DB::raw('mahasiswa.nim,mahasiswa.namaMhs,mahasiswa.prodi,mahasiswa.angkatan,mahasiswa.emailMhs'))
        ->where('dosen.emailDosen', $myString)
        ->orderBy('mahasiswa.nim')
        ->paginate(5);
        return view('sip.dosen.lihatKhs', ['namaDosen'=> $namaDosen, 'nidnLogin' => $nidnLogin, 'mahasiswa' => $mahasiswa]);
    }

    public function perwalianSelesai($id){
        $jadwalUmum = DB::table('perwalian')->where('id_jadwal', $id)->update([
            'status' => 'selesai'
        ]);
        return redirect('/sip/perwalianUmum');
    }

    public function lihatPeserta($id){
        $infoPerwalian = DB::table('perwalian')->where('id_jadwal', $id)->get();
        $id_jadwal = DB::table('perwalian')->select('id_jadwal')->where('id_jadwal', $id)->get();
        $data = DB::table('peserta')
        ->join('perwalian', 'perwalian.id_jadwal', '=', 'peserta.id_jadwal')
        ->join('mahasiswa', 'mahasiswa.nim', '=', 'peserta.nim')
        ->select(DB::raw('peserta.id_peserta,peserta.nim,peserta.id_jadwal,mahasiswa.namaMhs,mahasiswa.angkatan'))
        ->where('perwalian.id_jadwal', $id)
        ->paginate(5);

        return view('sip.dosen.lihatPeserta', ['dataMhs'=>$data, 'infoPerwalian'=>$infoPerwalian, 'id_jadwal'=>$id_jadwal]);
    }

    public function tambahPeserta($id){
        $myString = auth()->user()->email;
        $nim = DB::table('mahasiswa')
        ->join('dosen', 'dosen.nidn', '=', 'mahasiswa.nidn')
        ->select(DB::raw('mahasiswa.nim'))
        ->where('dosen.emailDosen', $myString)
        ->get()->toArray();

        foreach($nim as $mhs){
            DB::table('peserta')->insert(
                [
                    'id_jadwal' => $id,
                    'nim' => $mhs->nim
                ]
                );
        }
        return redirect('/sip/perwalianUmum');
        
    }

    public function tambahCatatan($id){
        $isiCatatan = DB::table('peserta')->where('id_peserta', $id)->get();
        return view('sip.dosen.catatan', ['isiCatatan' => $isiCatatan]);
    }

    public function simpanCatatan($id, Request $request){
        DB::table('peserta')->where('id_peserta', $id)->update([
            'catatan' => $request->catatanMhs
        ]);
        return redirect('/sip/perwalianUmum');
    }

    public function report($id){
        return Excel::download(new UsersExport($id), 'report.xlsx');
    }

//--------------------------------------------------------------------------------------------------------Mandiri
    public function tampilPerwalianMandiri(){
        $myString = auth()->user()->email;
        $namaLogin = auth()->user()->name;
        $namaDosen = DB::table('dosen')->select('namaDosen')->where('emailDosen', $myString)->get();
        $nidnLogin = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        $jadwalUmum = DB::table('perwalian')
        ->join('dosen', 'dosen.nidn', '=', 'perwalian.nidn')
        ->where('status', 'proses')
        ->where('kategori', 'mandiri')
        ->where('dosen.emailDosen', $myString)
        ->paginate(5);
        $jadwalUmumSelesai = DB::table('perwalian')
        ->join('dosen', 'dosen.nidn', '=', 'perwalian.nidn')
        ->where('status', 'selesai')
        ->where('kategori', 'mandiri')
        ->where('dosen.emailDosen', $myString)
        ->paginate(5);
        return view('sip.dosen.tampilJadwalMandiri', ['jadwalUmum'=>$jadwalUmum, 'namaDosen'=>$namaDosen, 'nidnLogin'=>$nidnLogin, 'jadwalUmumSelesai'=>$jadwalUmumSelesai]);
    }

    public function formPerwalianMandiri(){
        $myString = auth()->user()->email;
        $nidn = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        return view('sip.dosen.tambahJadwalMandiri', ['nidn'=>$nidn]);
    }

    public function tambahPerwalianMandiri(Request $request){
        $tanggalSekarang = Carbon\Carbon::now();
        $waktuSekarang = Carbon\Carbon::now();
        DB::table('perwalian')->insert([
            'nidn' => $request->nidnMandiri,
            'kategori' => 'mandiri',
            'keterangan' => $request->keteranganMandiri,
            'tanggalPerwalian' => $request->tanggalPerwalianMandiri,
            'jamPerwalian' => $request->jamPerwalianMandiri,
            'tanggalSetup' => $tanggalSekarang,
            'jamSetup' => $waktuSekarang
        ]);
        return redirect('/sip/perwalianMandiri')->with(['success', 'Jadwal Berhasil Ditambah']);
    }

    public function formEditMandiri($id){
        $myString = auth()->user()->email;
        $nidnLogin = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        $jadwalUmum = DB::table('perwalian')->where('id_jadwal', $id)->get();
        return view('sip.dosen.editJadwalMandiri', ['jadwalUmum' => $jadwalUmum, 'nidnLogin' => $nidnLogin]);
    }

    public function simpanEditMandiri($id, Request $request){
        $tanggalSekarang = Carbon\Carbon::now();
        $waktuSekarang = Carbon\Carbon::now();
        $jadwalUmum = DB::table('perwalian')->where('id_jadwal', $id)->update([
            'nidn' => $request->nidnMandiri,
            'kategori' => 'mandiri',
            'keterangan' => $request->keteranganMandiri,
            'tanggalPerwalian' => $request->tanggalPerwalianMandiri,
            'jamPerwalian' => $request->jamPerwalianMandiri,
            'tanggalSetup' => $tanggalSekarang,
            'jamSetup' => $waktuSekarang
        ]);
        return redirect('/sip/perwalianMandiri')->with(['success', 'Data Berhasil di update']);
    }

    public function formCatatanMandiri($id){
        $jadwalUmum = DB::table('perwalian')->where('id_jadwal', $id)->get();
        return view('#', ['jadwalUmum' => $jadwalUmum]);
    }

    public function perwalianSelesaiMandiri($id){
        $jadwalUmum = DB::table('perwalian')->where('id_jadwal', $id)->update([
            'status' => 'selesai'
        ]);
        return redirect('#');
    }

    public function lihatPesertaMandiri($id){
        $infoPerwalian = DB::table('perwalian')->where('id_jadwal', $id)->get();
        $id_jadwal = DB::table('perwalian')->select('id_jadwal')->where('id_jadwal', $id)->get();
        $data = DB::table('peserta')
        ->join('perwalian', 'perwalian.id_jadwal', '=', 'peserta.id_jadwal')
        ->join('mahasiswa', 'mahasiswa.nim', '=', 'peserta.nim')
        ->select(DB::raw('peserta.id_peserta,peserta.nim,peserta.id_jadwal,mahasiswa.namaMhs,mahasiswa.angkatan'))
        ->where('perwalian.id_jadwal', $id)
        ->paginate(5);

        return view('sip.dosen.lihatPesertaMandiri', ['dataMhs'=>$data, 'infoPerwalian'=>$infoPerwalian, 'id_jadwal'=>$id_jadwal]);
    }

    public function tambahPesertaMandiri($id, Request $request){
        DB::table('peserta')->insert([
            'id_jadwal' => $id,
            'nim' => $request->nimMandiri
        ]);
        return redirect('/sip/perwalianMandiri');
    }

    public function tambahCatatanMandiri($id){
        $isiCatatan = DB::table('peserta')->where('id_peserta', $id)->get();
        return view('sip.dosen.catatanMandiri', ['isiCatatan' => $isiCatatan]);
    }

    public function simpanCatatanMandiri($id, Request $request){
        DB::table('peserta')->where('id_peserta', $id)->update([
            'catatan' => $request->catatanMhs
        ]);
        return redirect('/sip/perwalianMandiri');
    }

    public function reportMandiri($id){
        return Excel::download(new UsersExport($id), 'report.xlsx');
    }

    public function perwalianMandiriSelesai($id){
        $jadwalUmum = DB::table('perwalian')->where('id_jadwal', $id)->update([
            'status' => 'selesai'
        ]);
        return redirect('/sip/perwalianMandiri');
    }
//-------------------------------------------------------------------------------------------pengajuan
    public function listPengajuan(){
        $myString = auth()->user()->email;
        $pengajuanProses = DB::table('pengajuan')
        ->join('mahasiswa', 'mahasiswa.nim', '=', 'pengajuan.nim')
        ->join('dosen', 'dosen.nidn', '=', 'mahasiswa.nidn')
        ->select(DB::raw('pengajuan.id_pengajuan,mahasiswa.namaMhs, pengajuan.nim,pengajuan.keterangan,pengajuan.status'))
        ->where('dosen.emailDosen', $myString)
        ->where('pengajuan.status', '=', 'proses')
        ->paginate(5);
        $pengajuanTerima = DB::table('pengajuan')
        ->join('mahasiswa', 'mahasiswa.nim', '=', 'pengajuan.nim')
        ->join('dosen', 'dosen.nidn', '=', 'mahasiswa.nidn')
        ->select(DB::raw('pengajuan.id_pengajuan, pengajuan.nim,pengajuan.keterangan,pengajuan.status,mahasiswa.namaMhs'))
        ->where('dosen.emailDosen', $myString)
        ->where('pengajuan.status', '=', 'terima')
        ->paginate(5);
        $pengajuanTolak = DB::table('pengajuan')
        ->join('mahasiswa', 'mahasiswa.nim', '=', 'pengajuan.nim')
        ->join('dosen', 'dosen.nidn', '=', 'mahasiswa.nidn')
        ->select(DB::raw('pengajuan.id_pengajuan, pengajuan.nim,mahasiswa.namaMhs,pengajuan.keterangan,pengajuan.status'))
        ->where('dosen.emailDosen', $myString)
        ->where('pengajuan.status', '=', 'tolak')
        ->paginate(5);
        return view('sip.dosen.lihatPengajuan', ['pengajuanProses'=>$pengajuanProses, 'pengajuanTerima'=>$pengajuanTerima, 'pengajuanTolak'=>$pengajuanTolak]);
    }

    public function terimaPengajuan($id){
        DB::table('pengajuan')->where('id_pengajuan', $id)->update([
            'status' => 'terima'
        ]);
        return redirect('/sip/lihatPengajuan');
    }

    public function tolakPengajuan($id){
        DB::table('pengajuan')->where('id_pengajuan', $id)->update([
            'status' => 'tolak'
        ]);
        return redirect('/sip/lihatPengajuan');
    }
}
