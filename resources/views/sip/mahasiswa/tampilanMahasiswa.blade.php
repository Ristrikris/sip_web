<!-- Menghubungkan dengan view template master -->
@extends('layout.masterMhs')
<!-- isi bagian konten -->
@section('konten')
    <br><br>
    <div class="row">
        <div class="col-md-6">
        <section class="content-header">
        <h3><b>Selamat Datang</b></h3>
        @foreach($dataMhs as $dm)
            <h2><b>{{$dm->namaMhs}}</b></h2>
            <h4>{{$dm->nim}}</h4>
        @endforeach
    </section>
    <br> 
    <div>
        @foreach($dataDosen as $ds)
        <label>Dosen : &nbsp;</label><label>{{$ds->namaDosen}}</label><br>
        <label>Email Dosen : &nbsp;</label><label>{{$ds->emailDosen}}</label>
        @endforeach
    </div>
                <!-- @foreach($dataMhs as $m)
                <form action="/sip/mahasiswaTranskrip/{{$m->nim}}" method="get">
                    <input type="submit" class="btn btn-primary" value="Lihat Transkrip">
                </form>
                @endforeach
                &nbsp;
                <td>
                @foreach($dataMhs as $m)
                <form action="/sip/mahasiswaTranskrip/{{$m->nim}}" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" name="semesterMandiri" id="semesterMandiri"  placeholder="Masukan Semester" style="width: 23%">
                    </div>
                </td>
                <td>
                    <input type="submit" class="btn btn-primary" value="Lihat KHS">
                </form>
                @endforeach
                </td>    -->
        </div>
        <br><br>
        <div class="col-md-6">
            <p class="fs-1"><b>PENGUMUMAN PERWALIAN</b></p><br>
            @foreach($pengumuman as $p)
                <div>
                <label>Tanggal Perwalian : &nbsp;</label><label>{{$p->tanggalPerwalian}}</label><br>
                <label>Jam Perwalian : &nbsp;</label><label>{{$p->jamPerwalian}}</label><br>
                <label>Keterangan Perwalian : &nbsp;</label><label>{{$p->keterangan}}</label><br>
                <div>
                ---------------------------------------------------------------------------------------
            @endforeach
        </div>
    </div>
    </div>
@endsection