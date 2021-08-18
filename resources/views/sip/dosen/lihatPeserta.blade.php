<!-- Menghubungkan dengan view template master -->
@extends('layout.masterDsn')

<!-- isi bagian konten -->
@section('konten')
    <h7><b>Tanggal Perwalian :  </b></h7>
        @foreach($infoPerwalian as $ip)
            {{$ip->tanggalPerwalian}}
        @endforeach
    <br>
    <h7><b>jam Perwalian : </b></h7>
        @foreach($infoPerwalian as $ip)
            {{$ip->jamPerwalian}}
        @endforeach<br><br>
    <section class="content-header">
        <h4><b>Daftar Peserta Perwalian</b></h4>
    </section>
    @foreach($id_jadwal as $ij)

        <br>
            Silahkan klik tombol dibawah jika peserta belum kelihatan :
        <br>
        <a href="/sip/tambahPeserta/{{$ij->id_jadwal}}" class="btn btn-warning">Tampilkan</a><br>

    @endforeach
    <br>
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-headSer with-border">
                    <table class="table table-striped table-hover table-responsive">
                            <thead class="thead-dark">
                                <tr align="center">
                                    <th scope="col"><center>No.</th>                            
                                    <th scope="col"><center>Nama</th>
                                    <th scope="col"><center>NIM</th>
                                    <th scope="col" colspan="1"><center>Action</th>
                                </tr>
                            </thead>
                            @foreach($dataMhs as $no => $dm)
                            <tbody>
                                <tr>
                                    <th scope="row">@php echo ++$no+($dataMhs->currentPage()-1)*$dataMhs->perPage() @endphp</th>
                                    <td>{{$dm->namaMhs}}</td>
                                    <td>{{$dm->nim}}</td>
                                    <td>
                                        <a href="/sip/tambahCatatan/{{$dm->id_peserta}}" class="btn btn-primary">Catatan</a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        @php echo $dataMhs->links() @endphp
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection