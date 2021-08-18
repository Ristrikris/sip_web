<!-- Menghubungkan dengan view template master -->
@extends('layout.masterAdmin')

<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Form Tambah KHS</b></h4>
    </section>
    <br> 
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                <form action="/sip/tambah_khs" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <tr>
                    <label for="formGroupExampleInput">NIM :</label>
                    </tr>
                    <tr>
                    @foreach($nim as $n)
                    <input type="number" readonly value='{{$n->nim}}' class="form-control" name="nim" id="nim" style="width: 15%" placeholder="Semester" >
                    @endforeach
                    </tr>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">KHS :</label>
                    <input type="file" class="form-control-file" id="hasil_khs" name="hasil_khs" required="required">
                    <i style="color:#db1a1a">*Dokumen <b>WAJIB</b> berekstensi <b>.PDF</b></i>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Semester :</label>
                    <input type="text" class="form-control" name="semester" id="semester" style="width: 10%" placeholder="Semester" >
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