<!-- Menghubungkan dengan view template master -->
@extends('layout.masterAdmin')

<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Form Tambah Mahasiswa</b></h4>
    </section>
    <br> 
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                <form action="/sip/tambah_mahasiswa" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="formGroupExampleInput">NIM :</label>
                    <input type="number" class="form-control" name="nim" id="nim" style="width: 25%" placeholder="Masukan NIM" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nama Mahasiswa :</label>
                    <input type="text" class="form-control" name="namaMhs" id="namaMhs" style="width: 25%" placeholder="Masukan Nama Mahasiswa" >
                </div>
                <div class="form-group">
                    <tr>
                    <label for="formGroupExampleInput">Dosen Wali :</label>
                    </tr>
                    <tr>
                    <select class="custom-select" name="dosenWali" id="dosenWali" style="width: 25%">
                    @foreach($dosenWali as $d)    
                        <option value="{{$d->nidn}}">{{$d->namaDosen}}</option>
                    @endforeach            
                    </select>
                    </tr>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Prodi :</label>
                    <input type="text" class="form-control" name="prodi" id="prodi" style="width: 25%" placeholder="Masukan Prodi Mahasiswa" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Nomor Telepon :</label>
                    <input type="text" class="form-control" name="noTelpMhs" id="noTelpMhs" style="width: 30%" placeholder="Masukan Nomor Telepon Mahasiswa" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Email :</label>
                    <input type="text" class="form-control" name="emailMhs" id="emailMhs" style="width: 25%" placeholder="Masukan Email Mahasiswa" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Angkatan :</label>
                    <input type="text" class="form-control" name="angkatan" id="angkatan" style="width: 25%" placeholder="Masukan Angkatan Mahasiswa" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Alamat :</label>
                    <input type="text" class="form-control" name="alamatMhs" id="alamatMhs" style="width: 25%" placeholder="Masukan Alamat Mahasiswa" >
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Transkrip Nilai :</label>
                    <input type="file" class="form-control-file" id="hasil_transkrip" name="hasil_transkrip" required="required">
                    <i style="color:#db1a1a">*Dokumen <b>WAJIB</b> berekstensi <b>.PDF</b></i>
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