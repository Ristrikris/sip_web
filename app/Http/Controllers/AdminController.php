<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Symfony\Component\Console\Input\Input;
use App\Post;
use Illuminate\Support\Str;
use \App\sip;

class AdminController extends Controller
{
    public function tampilDosen(){
        $myString = auth()->user()->email;
        $namaLogin = auth()->user()->name;
        $namaDosen = DB::table('dosen')->select('namaDosen')->where('emailDosen', $myString)->get();
        $nidnLogin = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        $dosen = DB::table('dosen')->paginate(5);
        return view('sip.admin.tampilDosen', ['dosen'=>$dosen, 'namaDosen'=>$namaDosen, 'nidnLogin'=>$nidnLogin]);
    }

    public function tampilMahasiswa(){
        $myString = auth()->user()->email;
        $namaLogin = auth()->user()->name;
        $namaDosen = DB::table('dosen')->select('namaDosen')->where('emailDosen', $myString)->get();
        $nidnLogin = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        $mahasiswa = DB::table('mahasiswa')
        ->join('dosen', 'dosen.nidn', '=', 'mahasiswa.nidn')
        ->select(DB::raw('mahasiswa.nim,mahasiswa.namaMhs,mahasiswa.emailMhs,dosen.namaDosen'))
        ->paginate(5);
        return view('sip.admin.tampilMahasiswa', ['mahasiswa'=>$mahasiswa, 'namaDosen'=>$namaDosen, 'nidnLogin'=>$nidnLogin]);
    }

    public function formTambahDosen(){
        return view('sip.admin.tambahDosen');
    }

    public function tambahDosen(Request $request){
        DB::table('dosen')->insert([
            'nidn' => $request->nidn,
            'namaDosen' => $request->namaDosen,
            'noTelpDosen' => $request->noTelpDosen,
            'emailDosen' => $request->emailDosen,
            'statusDsn' => 'dosen'
        ]);
        return redirect('/sip/tampilDosen')->with(['success' => 'Dosen Berhasil Ditambah']);
    }

    public function deleteDosen($id){
        $dosen = DB::table('dosen')->where('nidn', $id);
        $dosen->delete();
        return redirect('/sip/tampilDosen')->with(['success' => 'Dosen Berhasil Dihapus']);
    }

    public function editDosen($id){
        $dosen = DB::table('dosen')->where('nidn', $id)->get();
        return view('sip.admin.editDosen', ['dosen' => $dosen]);
    }

    public function updateDosen($id, Request $request){
        $dosen = DB::table('dosen')->where('nidn', $id)->update([
            'nidn' => $request->nidn,
            'namaDosen' => $request->namaDosen,
            'noTelpDosen' => $request->noTelpDosen,
            'emailDosen' => $request->emailDosen,
            'statusDsn' => 'dosen'
        ]);
        return redirect('/sip/tampilDosen')->with(['success', 'Data berhasil di edit']);
    }

    public function formTambahMahasiswa(){
        $dosenWali = DB::table('dosen')->select('nidn', 'namaDosen')->get();
        return view('sip.admin.tambahMahasiswa', ['dosenWali'=>$dosenWali]);
    }

    public function tambahMahasiswa(Request $request){
        $data = new sip;
        if ($request->file('hasil_transkrip')) {
            $file = $request->file('hasil_transkrip');
            $nim = $request->nim;
            $ext = $file->getClientOriginalExtension();
            $filename = $request->nim . "." . $file->getClientOriginalExtension();
            $path = 'transkripNilai';
            $file->move($path, $filename);
            $data->file = $filename;
        }

        DB::table('mahasiswa')->insert([
            'nim' => $request->nim,
            'namaMhs' => $request->namaMhs,
            'nidn' => $request->dosenWali,
            'prodi' => $request->prodi,
            'angkatan' => $request->angkatan,
            'noTelpMhs' => $request->noTelpMhs,
            'emailMhs' => $request->emailMhs,
            'alamatMhs' => $request->alamatMhs,
            'hasil_transkrip' => $data->file
        ]);
        return redirect('/sip/tampilMahasiswa')->with(['success', 'Data berhasil ditambahkan']);
    }

    public function editMahasiswa($id){
        $mahasiswa = DB::table('mahasiswa')->where('nim', $id)->get();
        $dosenWali = DB::table('dosen')->select('nidn', 'namaDosen')->get();
        return view('sip.admin.editMahasiswa', ['mahasiswa'=>$mahasiswa, 'dosenWali'=>$dosenWali]);
    }

    public function updateMahasiswa($id, Request $request){
        $data = new sip;
        if ($request->file('hasil_transkrip')) {
            $file = $request->file('hasil_transkrip');
            $nim = $request->nim;
            $ext = $file->getClientOriginalExtension();
            $filename = $request->nim . "." . $file->getClientOriginalExtension();
            $path = 'transkripNilai';
            $file->move($path, $filename);
            $data->file = $filename;
        }

        $mahasiswa = DB::table('mahasiswa')->where('nim', $id)->update([
            'nim' => $request->nim,
            'namaMhs' => $request->namaMhs,
            'nidn' => $request->dosenWali,
            'prodi' => $request->prodi,
            'angkatan' => $request->angkatan,
            'noTelpMhs' => $request->noTelpMhs,
            'emailMhs' => $request->emailMhs,
            'alamatMhs' => $request->alamatMhs,
            'hasil_transkrip' => $data->file
        ]);
        return redirect('/sip/tampilMahasiswa');
    }

    public function deleteMahasiswa($id){
        $mahasiswa = DB::table('mahasiswa')->where('nim', $id);
        $mahasiswa->delete();
        return redirect('/sip/tampilMahasiswa')->with(['success' => 'Mahasiswa Berhasil Dihapus']);
    }

    public function openTranskrip($id){
        $path = public_path('transkripNilai/' . $id . '.pdf');
        header("Content-type: application/pdf");
        header("Content-Length: " . filesize($path));
        readfile($path);
    }

    public function tambahKhs($id){
        $nim = DB::table('mahasiswa')->select('nim', 'namaMhs')->where('nim', $id)->get();
        return view('sip.admin.tambahKhs', ['nim' => $nim]);
    }

    public function simpanKhs(Request $request){
        $data = new sip;
        if ($request->file('hasil_khs')) {
            $file = $request->file('hasil_khs');
            $nim = $request->nim;
            $semester = $request->semester;
            $ext = $file->getClientOriginalExtension();
            $filename = $request->nim . "_" . $request->semester . "." .$file->getClientOriginalExtension();
            $path = 'khs';
            $file->move($path, $filename);
            $data->file = $filename;
        }

        DB::table('khs')->insert([
            'nim' => $request->nim,
            'hasil_khs' => $data->file,
            'semester' => $request->semester
        ]);
        return redirect('/sip/tampilKhs')->with(['success', 'KHS berhasil ditambahkan']);
    }


    public function openKhs($id, Request $request){
        $semester = $request->semester;
        $path = public_path('khs/' . $id . '_' . $semester .'.pdf');
        header("Content-type: application/pdf");
        header("Content-Length: " . filesize($path));
        readfile($path);
    }

    public function tampilanKhs(){
        $myString = auth()->user()->email;
        $namaLogin = auth()->user()->name;
        $namaDosen = DB::table('dosen')->select('namaDosen')->where('emailDosen', $myString)->get();
        $nidnLogin = DB::table('dosen')->select('nidn')->where('emailDosen', $myString)->get();
        $mahasiswa = DB::table('mahasiswa')->paginate(5);
        return view('sip.admin.tampilKhs', ['namaDosen'=> $namaDosen, 'nidnLogin' => $nidnLogin, 'mahasiswa' => $mahasiswa]);
    }

}
