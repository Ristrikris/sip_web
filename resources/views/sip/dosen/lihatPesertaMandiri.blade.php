<!-- Menghubungkan dengan view template master -->
@extends('layout.masterDsn')

<!-- isi bagian konten -->
@section('konten')
    <h7><b>Tanggal Perwalian :  </b></h7>
        @foreach($infoPerwalian as $ip)
            {{$ip->tanggalPerwalian}}
        @endforeach
    <br>
    <h7><b>jam Perwalian : </b></h7>
        @foreach($infoPerwalian as $ip)
            {{$ip->jamPerwalian}}
        @endforeach<br><br>
    <section class="content-header">
        <h4><b></b></h4>
    </section>
    <br>
    <div class="row">
        <div class="col-md-6">
        @foreach($infoPerwalian as $ip)
            <form method="post" action="/sip/tambahPesertaMandiri/{{$ip->id_jadwal}}">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-row">
                        <div class="form-group col-sm">
                            <label for="formGroupExampleInput">NIM :</label>
                            <input type="text" class="form-control" name="nimMandiri" id="nimMandiri" style="width: 25%" >  
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">
                            Tambah 
                        </button>
                    </div>
                </div>
            </form>
        @endforeach
        </div>
        <div class="col-md-6">
            <h4><b>Daftar Peserta Perwalian Mandiri</b></h4>
            <hr />         
            <table class="table table-striped table-hover table-responsive">
                <thead>
                        <tr align="center">
                            <th scope="col"><center>No.</th>                            
                            <th scope="col"><center>Nama</th>
                            <th scope="col"><center>NIM</th>
                            <th scope="col" colspan="1"><center>Action</th>
                        </tr>
                </thead>
                @foreach($dataMhs as $no => $dm)
                            <tbody>
                                <tr>
                                    <th scope="row">@php echo ++$no+($dataMhs->currentPage()-1)*$dataMhs->perPage() @endphp</th>
                                    <td>{{$dm->namaMhs}}</td>
                                    <td>{{$dm->nim}}</td>
                                    <td>
                                        <a href="/sip/tambahCatatanMandiri/{{$dm->id_peserta}}" class="btn btn-primary">Catatan</a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        @php echo $dataMhs->links() @endphp
            </table>
        <div>
    </div>
    </div>
    </div>
    </div>
@endsection