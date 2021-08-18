<!DOCTYPE html>
<html>

<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Responsive Meta Tag-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	
	<!--JAVA SCRIPT UTK MEMBUAT NAVBAR ACTIVE-->
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js' type='text/javascript'></script>
	
	<!-- Favicon utk Logo di Browser-->
	<link rel="shortcut icon" href="{{ URL::to('/') }}/logo/sikp.png">
	<!-- Untuk Judul di Browser-->
	<title>SIP(SISTEM INFORMASI PRAKTEK)</title>
    <style type="text/css">
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		html,
		body {
			margin: 0;
			padding: 0;
			height: 100%;
		}

		body {
			background-color: #e1e8f0;
			/*kasi warna background*/
			margin: 10px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #000000;
			/*kasi warna tulisan*/
		}

		a {
			color: #000000;
			background-color: transparent;
			font-weight: normal;
		}

		h1 {
			color: #000000;
			background-color: transparent;
			border-bottom: 1px solid #D0D0D0;
			font-size: 19px;
			font-weight: normal;
			margin: 0 0 14px 0;
			padding: 14px 15px 10px 15px;
		}

		code {
			font-family: Consolas, Monaco, Courier New, Courier, monospace;
			font-size: 12px;
			background-color: #f5f7f7;
			border: 1px solid #D0D0D0;
			color: #000000;
			display: block;
			margin: 10px 0 10px 0;
			padding: 10px 10px 10px 10px;
		}

		#body {
			margin: 0 15px 0 15px;
		}

		p.footer {
			text-align: right;
			font-size: 11px;
			border-top: 1px solid #D0D0D0;
			line-height: 32px;
			padding: 0 10px 0 10px;
			margin: 20px 0 0 0;
		}

		#container {
			/*margin: 5px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;*/
			min-height: 100%;
			position: relative;
		}

		.jumbotron {
			background-color: #f5f7f7;
			/*kasi warna background*/
			margin: 10px 0 10px 0;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #000000;
			/*kasi warna tulisan*/
		}

		#footer {
			height: 50px;
			padding-left: 10px;
			line-height: 50px;
			background: #333;
			color: #fff;
			position: absolute;
			bottom: 0px;
			width: 100%;
			/*biar memenuhi layar*/
		}

		#content {
			padding: 10px;
			padding-bottom: 60px;
			/*sama atau lebih besar dari tinggi footer*/
		}

		#copyright {
			bottom: 0;
			width: 100%;
			position: fixed;
			height: 50px;
			line-height: 50px;
			background: #3c3a3a;
			color: #fff;
			padding-left: 10px;
		}

		.header {
			background: #0cf;
			padding: 10px;
		}

		.content {
			padding: 10px;
		}
	</style>
</head>
<body>
	<!-- Header -->
	<header>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<img src="{{ URL::to('/') }}/logo/sikp.png" width="30" height="30" class="d-inline-block align-top" alt="">
			<a class="navbar-brand"><b>SIP</b></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="nav navbar-nav navbar-right" href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
					<li><a href="login">Logout
							<span class="glyphicon glyphicon-log-out"></a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</li>
				</ul>
			</div>
		</nav>
	</header>
	<!-- Bagian Content -->
	<div class="jumbotron jumbotron-fluid">
		<!-- bagian konten blog -->
        <div class="container-fluid">
            <!--@yield('konten')-->
            <section class="content-header">
                <h3><b>Identitas Mahasiswa</b></h3>
            </section>
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            @if(auth()->user()->photo)
                            <br><img src="{{ auth()->user()->photo }}" alt="photo" height="150" width="150" class="rounded-circle"><br><br>
                            @endif
                            <form method="post" action="/home_mahasiswa">
                            @csrf
                                <div class="form-group row">
                                    <label class="col-sm">Nama</label> :
                                    <div class="col-sm-10">
                                        {{ auth()->user()->name }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm">E-Mail</label> :
                                    <div class="col-sm-10">
                                        {{ auth()->user()->email }}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm col-form-label">NIM</label> 
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword" name="nim" style="width:100px" require>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </form>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
	</div>
	</div>
	<hr />
	</div>
	</div>
	</div>
	<!-- Bagian Footer -->
	<footer class="main-footer" align="center">
		<strong>Copyright &copy; 2021 <a href="#">PTERPAN 2021</a> feat <a>R L</a>.</strong> All rights reserved.
	</footer>
</body>
</html>