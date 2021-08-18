<!-- Menghubungkan dengan view template master -->
@extends('layout.masterDsn')

<!-- isi bagian konten -->
@section('konten')
    <section class="content-header">
        <h4><b>Form Edit Perwalian</b></h4>
    </section>
    <br> 
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                @foreach($jadwalUmum as $j)
                <form action="/sip/edit_perwalian/{{$j->id_jadwal}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                @foreach($nidnLogin as $nidn)
                    <input type="hidden" value="{{$nidn->nidn}}" class="form-control" name="nidn" id="nidn" style="width: 25%" placeholder="Masukan NIDN" readonly>
                @endforeach
                </div>
                <div class="form-group">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Tanggal Perwalian : </label>
                    <input type="date" value="{{$j->tanggalPerwalian}}" class="form-control" name="tanggalPerwalian" id="tanggalPerwalian" style="width: 25%">
                </div>
                <div class="form-group">
                        <label for="exampleFormControlInput1">Jam Perwalian : </label>
                        <input type="time" value="{{$j->jamPerwalian}}"  class="form-control" name="jamPerwalian" id="jamPerwalian" style="width: 25%">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Keterangan :</label>
                    <input type="text" value="{{$j->keterangan}}"  class="form-control" name="keterangan" id="keterangan" style="width: 50%" placeholder="Masukan Keterangan" >
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