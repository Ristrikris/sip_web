<!-- Menghubungkan dengan view template master -->
@extends('layout.masterAdmin')
<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Form Edit Dosen</b></h4>
    </section>
    <br> 
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                @foreach($dosen as $d)
                <form action="/sip/updated_dosen/{{$d->nidn}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="formGroupExampleInput">NIDN :</label>
                    <input type="number" readonly value="{{$d->nidn}}" class="form-control" name="nidn" id="nidn" style="width: 25%" placeholder="Masukan NIDN" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nama Dosen :</label>
                    <input type="text" value="{{$d->namaDosen}}" class="form-control" name="namaDosen" id="namaDosen" style="width: 40%" placeholder="Masukan nama dosen" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Email Dosen :</label>
                    <input type="text" value="{{$d->emailDosen}}" class="form-control" name="emailDosen" id="emailDosen" style="width: 40%" placeholder="Masukan email staff dosen" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nomor Telepon : </label>
                    <input type="number" value="{{$d->noTelpDosen}}" class="form-control" name="noTelpDosen" id="noTelpDosen" style="width: 25%" placeholder="Masukan nomor telepon dosen" >
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan">
                </form>
                @endforeach
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection