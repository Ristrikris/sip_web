<!-- Menghubungkan dengan view template master -->
@extends('layout.masterDsn')

<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Form Tambah Perwalian Umum</b></h4>
    </section>
    <br> 
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                <form action="/sip/tambah_perwalianUmum" method="post">
                @csrf
                <div class="form-group">
                @foreach($nidn as $nidn_login)
                    <input type="hidden" value="{{$nidn_login->nidn}}" class="form-control" name="nidn" id="nidn" style="width: 25%" placeholder="Masukan NIDN" readonly>
                @endforeach
                </div>
                <!-- <div class="form-group">
    
                </div> -->
                <div class="form-group">
                    <label for="exampleFormControlInput1">Tanggal Perwalian : </label>
                    <input type="date" class="form-control" name="tanggalPerwalian" id="tanggalPerwalian" style="width: 25%">
                </div>
                <div class="form-group">
                        <label for="exampleFormControlInput1">Jam Perwalian : </label>
                        <input type="time" class="form-control" name="jamPerwalian" id="jamPerwalian" style="width: 25%">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Keterangan :</label>
                    <input type="text"  class="form-control" name="keterangan" id="keterangan" style="width: 50%" placeholder="Masukan Keterangan" >
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