<!-- Menghubungkan dengan view template master -->
@extends('layout.masterAdmin')

<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Form Tambah Dosen</b></h4>
    </section>
    <br> 
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                <form action="/sip/tambah_dosen" method="post">
                @csrf
                <div class="form-group">
                    <label for="formGroupExampleInput">NIDN :</label>
                    <input type="number" class="form-control" name="nidn" id="nidn" style="width: 25%" placeholder="Masukan NIDN" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nama Dosen :</label>
                    <input type="text" class="form-control" name="namaDosen" id="namaDosen" style="width: 40%" placeholder="Masukan nama dosen" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Email Dosen :</label>
                    <input type="text" class="form-control" name="emailDosen" id="emailDosen" style="width: 40%" placeholder="Masukan email staff dosen" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nomor Telepon : </label>
                    <input type="number" class="form-control" name="noTelpDosen" id="noTelpDosen" style="width: 25%" placeholder="Masukan nomor telepon dosen" >
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan">
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection