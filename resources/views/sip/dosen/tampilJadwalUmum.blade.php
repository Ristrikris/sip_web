<!-- Menghubungkan dengan view template master -->
@extends('layout.masterDsn')

<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Daftar Jadwal Perwalian Umum</b></h4>
    </section>
    <br> 
    <div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <a class="btn btn-primary" href="/sip/tambahPerwalianUmum" role="button">Tambah [+]</a><br><br>
                    <table class="table table-striped table-hover table-responsive">
                        <thead class="thead-dark">
                            <tr align="center">
                                <th scope="col"><center>No.</th>                            
                                <th scope="col"><center>Tanggal Perwalian</th>
                                <th scope="col"><center>Jam Perwalian</th>
                                <th scope="col"><center>Keterangan</th>
                                <th scope="col" colspan="4"><center>Action</th>
                            </tr>
                        </thead>
                        @foreach($jadwalUmum as $no => $j)
                        <tbody>
                            <tr>
                                <th scope="row">@php echo ++$no+($jadwalUmum->currentPage()-1)*$jadwalUmum->perPage() @endphp</th>
                                <td>{{$j->tanggalPerwalian}}</td>
                                <td>{{$j->jamPerwalian}}</td>
                                <td>{{$j->keterangan}}</td>
                                <td>
                                <a href="/sip/editPerwalian/{{$j->id_jadwal}}" class="btn btn-primary">Edit</a>
                                </td>
                                <!-- <td>
                                <a href="/sip/delete_perwalian/{{$j->id_jadwal}}" class="btn btn-danger">Delete</a>
                                </td> -->
                                <td>
                                <a href="/sip/lihatPeserta/{{$j->id_jadwal}}" class="btn btn-info">Lihat Mahasiswa</a>
                                </td>
                                <td>
                                <a href="/sip/selesai/{{$j->id_jadwal}}" class="btn btn-warning">Perwalian Selesai</a>
                                </td>
                                <td>
                                <a href="/sip/report/{{$j->id_jadwal}}" class="btn btn-primary">Report</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @php echo $jadwalUmum->links() @endphp
                </div>
                <div class="box-header with-border">
                <h4><b>Daftar Jadwal Perwalian Umum Selesai</b></h4>
                    <table class="table table-striped table-hover table-responsive">
                        <thead class="thead-dark">
                            <tr align="center">
                                <th scope="col"><center>No.</th>                            
                                <th scope="col"><center>Tanggal Perwalian</th>
                                <th scope="col"><center>Jam Perwalian</th>
                                <th scope="col" colspan="1"><center>Action</th>
                            </tr>
                        </thead>
                        @foreach($jadwalUmumSelesai as $no => $j)
                        <tbody>
                            <tr>
                                <th scope="row">@php echo ++$no+($jadwalUmumSelesai->currentPage()-1)*$jadwalUmumSelesai->perPage() @endphp</th>
                                <td>{{$j->tanggalPerwalian}}</td>
                                <td>{{$j->jamPerwalian}}</td>
                                <td>
                                <a href="/sip/report/{{$j->id_jadwal}}" class="btn btn-primary">Report</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @php echo $jadwalUmumSelesai->links() @endphp
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection