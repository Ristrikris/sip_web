<!-- Menghubungkan dengan view template master -->
@extends('layout.masterMhs')
<!-- isi bagian konten -->
@section('konten')
<br><br>
<br>
    <div class="row">
        <div class="col-md-6">
            <h4><b>Form Pengajuan Perwalian  </b></h4><br>
            <form action="/sip/simpanPengajuan" method="post" enctype="multipart/form-data">
                @csrf
                @foreach($nim as $n)
                <div class="form-group">
                    <label for="formGroupExampleInput">NIM :</label>
                    <input type="text" readonly value='{{$n->nim}}' class="form-control" name="nimPengajuan" id="nimPengajuan" style="width: 25%" placeholder="Masukan NIM" >
                </div>
                @endforeach
                <div class="form-group">
                    <label for="formGroupExampleInput">Keterangan Pengajuan :</label>
                    <input type="text" class="form-control" name="keteranganPengajuan" id="keteranganPengajuan" style="width: 75%" placeholder="Masukan Keterangan" >
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan">
            </form>
        </div>
        <div class="col-md-6">
            <h4><b>Status Pengajuan Perwalian</b></h4><br>
            <table class="table table-striped table-hover table-responsive">
                <thead class="thead-dark">
                    <tr align="center">
                        <th scope="col"><center>No.</th>                            
                        <th scope="col"><center>Keterangan Perwalian</th>
                        <th scope="col"><center>Status</th>
                    </tr>
                </thead>
                @foreach($dataPengajuan as $no=>$d)
                <tbody>
                    <tr>
                        <th scope="row">@php echo ++$no+($dataPengajuan->currentPage()-1)*$dataPengajuan->perPage() @endphp</th>
                        <td>{{$d->keterangan}}</td>
                        <td>{{$d->status}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        <div>
    </div>
    </div>
    </div>
    </div>
@endsection