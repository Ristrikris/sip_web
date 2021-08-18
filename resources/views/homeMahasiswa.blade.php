<!-- Menghubungkan Ke View Master Template -->
@extends('layout.masterMhs')
<!-- isi bagian konten -->
@section('konten')
<section class="content-header">
    <h3><b>Identitas Mahasiswa</b></h3>
</section>
<div class="row">
    <div class="col-md-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                @if(auth()->user()->photo)
                <br><img src="{{ auth()->user()->photo }}" alt="photo" height="150" width="150" class="rounded-circle"><br><br>
                @endif
                <table>
                    <tbody>
                        <tr>
                            <td><b>Nama : </b></td>
                            <td> {{ auth()->user()->name }} </td>
                        </tr>
                        @foreach($nim as $nim_mhs)
                        <tr>
                            <td><b>NIM : </b></td>
                            <td>{{$nim_mhs->nim}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td><b>E-Mail : </b></td>
                            <td> {{ auth()->user()->email }} </td>
                        </tr>
                    </tbody>
                </table><br>
            </div>
        </div>
    </div>
</div>
</div>
@endsection