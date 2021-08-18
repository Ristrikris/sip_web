<!-- Menghubungkan dengan view template master -->
@extends('layout.masterDsn')

<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Form Catatan Perwalian</b></h4>
    </section>
    <br> 
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                @foreach($catatan as $c)
                <form action="/sip/edit_catatan/{{$c->id_catatan}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="formGroupExampleInput">ID Jadwal :</label>
                    <input readonly type="text" value="{{$c->id_jadwal}}"  class="form-control" name="id_jadwal" id="id_jadwal" style="width: 25%" >
                </div>    
                <div class="form-group">
                    <label for="formGroupExampleInput">NIM :</label>
                    <input type="text" readonly value="{{$c->nim}}"  class="form-control" name="nim" id="nim" style="width: 25%" >
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Catatan :</label>
                    <input type="text" value="{{$c->catatanMhs}}" class="form-control" name="catatanMhs" id="catatanMhs" style="width: 50%" >
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