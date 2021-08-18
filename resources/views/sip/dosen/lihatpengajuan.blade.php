<!-- Menghubungkan dengan view template master -->
@extends('layout.masterDsn')

<!-- isi bagian konten -->
@section('konten')
    <br> 
    <div class="row">
        <div class="col-md-6">
            <h4><b>List Pengajuan Perwalian</b></h4><br>
            <table class="table table-striped table-hover table-responsive">
                <thead class="thead-dark">
                    <tr align="center">
                        <th scope="col"><center>No.</th>                            
                        <th scope="col"><center>NIM</th>
                        <th scope="col"><center>NAMA</th>
                        <th scope="col"><center>Keterangan</th>
                        <th scope="col" colspan="2"><center>Action</th>
                    </tr>
                </thead>
                @foreach($pengajuanProses as $no=>$pp)
                <tbody>
                    <tr>
                        <th scope="row">@php echo ++$no+($pengajuanProses->currentPage()-1)*$pengajuanProses->perPage() @endphp</th>
                        <td>{{$pp->nim}}</td>
                        <td>{{$pp->namaMhs}}</td>
                        <td>{{$pp->keterangan}}</td>
                        <td>
                            <a href="/sip/terimaPengajuan/{{$pp->id_pengajuan}}" class="btn btn-primary">Terima</a>
                        </td>
                        <td>
                            <a href="/sip/tolakPengajuan/{{$pp->id_pengajuan}}" class="btn btn-danger">Tolak</a>  
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            @php echo $pengajuanProses->links() @endphp
        </div>

        <div class="col-md-6">
           <h4><b>List Perwalian Diterima</b></h4><br>
            <table class="table table-striped table-hover table-responsive">
                <thead class="thead-dark">
                    <tr align="center">
                        <th scope="col"><center>No.</th>                            
                        <th scope="col"><center>NIM</th>
                        <th scope="col"><center>NAMA</th>
                        <th scope="col"><center>Keterangan</th>
                        <th scope="col"><center>Status</th>
                    </tr>
                </thead>
                @foreach($pengajuanTerima as $no=>$pp)
                <tbody>
                    <tr>
                        <th scope="row">@php echo ++$no+($pengajuanProses->currentPage()-1)*$pengajuanProses->perPage() @endphp</th>
                        <td>{{$pp->nim}}</td>
                        <td>{{$pp->namaMhs}}</td>
                        <td>{{$pp->keterangan}}</td>
                        <td>{{$pp->status}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            @php echo $pengajuanTerima->links() @endphp
        <div>
    </div>
    </div>
    </div>
@endsection