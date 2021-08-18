<!-- Menghubungkan dengan view template master -->
@extends('layout.masterAdmin')

<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Daftar Dosen</b></h4>
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
                    <a class="btn btn-primary" href="{{ URL::to('/') }}/sip/tambahDosen" role="button">Dosen [+]</a><br><br>
                    <table class="table table-striped table-hover table-responsive">
                        <thead class="thead-dark">
                            <tr align="center">
                                <th scope="col"><center>#</th>                                
                                <th scope="col"><center>NIDN</th>
                                <th scope="col"><center>Nama</th>
                                <th scope="col"><center>Nomor Telepon</th>
                                <th scope="col"><center>Email</th>
                                <th scope="col"><center>Status Dosen</th>
                                <th scope="col" colspan="2"><center>Action</th>
                            </tr>
                        </thead>
                        @foreach($dosen as $no => $d)
                        <tbody>
                            <tr>
                                <th scope="row">@php echo ++$no+($dosen->currentPage()-1)*$dosen->perPage() @endphp</th>
                                <td>{{$d->nidn}}</td>
                                <td>{{$d->namaDosen}}</td>
                                <td>{{$d->noTelpDosen}}</td>
                                <td>{{$d->emailDosen}}</td>
                                <td>{{$d->statusDsn}}</td>
                                <td>
                                <a href="{{ URL::to('/') }}/sip/editDosen/{{$d->nidn}}" class="btn btn-success">Edit</a>
                                </td>
                                <td>
                                <a href="{{ URL::to('/') }}/sip/delete_dosen/{{$d->nidn}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @php echo $dosen->links() @endphp
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection