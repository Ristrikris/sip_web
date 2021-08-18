<!-- Menghubungkan dengan view template master -->
@extends('layout.masterAdmin')

<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Daftar Mahasiswa</b></h4>
    </section>
    <br> 
    <div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h7><b>Nama Admin : </b></h7>
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
                                <th scope="col" ><center>Prodi</th>
                                <th scope="col" ><center>Semester</th>
                                <th scope="col" colspan="3"><center>Action</th>
                            </tr>
                        </thead>
                        @foreach($mahasiswa as $no => $m)
                        <tbody>
                            <tr>
                                <th scope="row">@php echo ++$no+($mahasiswa->currentPage()-1)*$mahasiswa->perPage() @endphp</th>
                                <td>{{$m->nim}}</td>
                                <td>{{$m->namaMhs}}</td>
                                <td>{{$m->prodi}}</td>
                                <td>
                                    <form action="/sip/openKhs/{{$m->nim}}" method="get">
                                        @csrf
                                        <div class="form-group">
                                        <input type="text" class="form-control" name="semester" id="semester"  placeholder="Masukan Semester" >
                                        </div>
                                    
                                </td>
                                <td>
                                        <input type="submit" class="btn btn-primary" value="Lihat">
                                    </form>
                                </td>
                                <td>
                                <a class="btn btn-primary" href="{{ URL::to('/') }}/sip/tambahKhs/{{$m->nim}}" role="button">[+] KHS</a><br><br>
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