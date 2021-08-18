<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class UsersExport implements FromCollection
{   
    use Exportable;
    protected $id;

    function __construct($id){
        $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = DB::table('peserta')
        ->join('mahasiswa', 'mahasiswa.nim', '=', 'peserta.nim')
        ->join('perwalian', 'perwalian.id_jadwal', '=', 'peserta.id_jadwal')
        ->join('dosen', 'dosen.nidn', '=', 'perwalian.nidn')
        ->select(DB::raw('perwalian.tanggalPerwalian,perwalian.jamPerwalian,perwalian.tanggalSetup,perwalian.jamSetup,perwalian.keterangan,peserta.nim,mahasiswa.namaMhs,peserta.catatan,dosen.namaDosen'))
        ->where('peserta.id_jadwal', $this->id)
        ->get()->toArray();

        $data_array[] = array('Tanggal Perwalian', 'Jam Perwalian', 'Tanggal Pembuatan', 'Jam Pembuatan', 'NIM', 'Nama Mahasiswa', 'Catatan', 'Dosen', 'Keterangan');

        foreach($data as $d){
            $data_array[] = array(
                'Tanggal Perwalian' => $d->tanggalPerwalian,
                'Jam Perwalian' => $d->jamPerwalian,
                'Tanggal Pembuatan' => $d->tanggalSetup,
                'Jam Pembuatan' => $d->jamSetup,
                'NIM' => $d->nim,
                'Nama Mahasiswa' => $d->namaMhs,
                'Catatan' => $d->catatan,
                'Dosen' => $d->namaDosen,
                'Keterangan' => $d->keterangan
            );
        }
        return collect($data_array);
    }

    // public function headings(): array
    // {
    //     return [
    //         'Tanggal Perwalian',
    //         'Jam Perwalian',
    //         'Tanggal Setup',
    //         'jam Setup',
    //         'Keterangan',
    //         'NIM',
    //         'Nama Mahasiswa',
    //         'Catatan',
    //         'Nama Dosen'
    //     ];
    // }
}
