<!-- Menghubungkan dengan view template master -->
@extends('layout.masterDsn')

<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Daftar Anak Bimbingan</b></h4>
    </section>
    <br> 
    <div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h7><b>Nama Dosen : </b></h7>
                    @foreach($namaDosen as $ndsn)
                    {{$ndsn->namaDosen}}
                    @endforeach
                    <br>
                    <h7><b>NIDN : </b></h7>
                    @foreach($nidnLogin as $nidn)
                    {{$nidn->nidn}}
                    @endforeach<br><br>
                    <table class="table table-striped table-hover table-responsive">
                        <thead class="thead-dark">
                            <tr align="center">
                                <th scope="col"><center>#</th>                                
                                <th scope="col"><center>NIM</th>
                                <th scope="col" ><center>Nama</th>
                                <th scope="col"><center>Email</th>
                                <th scope="col"><center>Action</th>
                            </tr>
                        </thead>
                        @foreach($mahasiswa as $no => $m)
                        <tbody>
                            <tr>
                                <th scope="row">@php echo ++$no+($mahasiswa->currentPage()-1)*$mahasiswa->perPage() @endphp</th>
                                <td>{{$m->nim}}</td>
                                <td>{{$m->namaMhs}}</td>
                                <td>{{$m->emailMhs}}</td>
                                <td>
                                <a href="{{ URL::to('/') }}/sip/opentranskrip/{{$m->nim}}" class="btn btn-primary">Lihat Transkrip</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @php echo $mahasiswa->links() @endphp
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection