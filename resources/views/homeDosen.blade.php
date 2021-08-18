<!-- Menghubungkan dengan view template master -->
@extends('layout.masterDsn')

<!-- isi bagian konten -->
@section('konten')
<section class="content-header">
    <b>Identitas Dosen</b>
</section>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                @if(auth()->user()->photo)
                <br><img src="{{ auth()->user()->photo }}" alt="photo" height="150" width="150" class="rounded-circle"><br><br>
                @endif
                <form method="post" action="#">
                    <table>
                        <tbody>
                            <tr>
                                <td><b>Nama     : </b></td>
                                <td> {{ auth()->user()->name }} </td>
                            </tr>
                            @foreach($nidn as $nidn_dosen)
                            <tr>
                                <td><b>NIDN     : </b></td>
                                <td>{{$nidn_dosen->nidn}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><b>E-Mail    : </b></td>
                                <td> {{ auth()->user()->email }} </td>
                            </tr>
                        </tbody>
                    </table><br>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection