<?php
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['username'])){
die("Anda belum login");//jika belum login jangan lanjut..
}
else{
	$nm = $_SESSION['username'];
}

//cek level user
if($_SESSION['hak_akses']!="perusahaan"){
die("Anda bukan Perusahaan");//jika bukan admin jangan lanjut
}
?>
<?php
	include "koneksi.php";
	
	$sql = "SELECT * FROM perusahaan WHERE username='$nm'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$perusahaan = $data['perusahaan'];
	$alamat= $data['alamat'];
	$no_hp= $data['no_hp'];
	$kuota = $data['kuota'];
	?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Page Perusahaan</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../perusahaan/perusahaan.php">Perusahaan</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
			
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $perusahaan?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../perusahaan/profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="../perusahaan/setting.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../perusahaan/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="../perusahaan/perusahaan.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="active">
                        <a href="javascript:;" data-toggle="collapse" data-target="#magang"><i class="fa fa-fw fa-th-list"></i> Magang <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="magang" class="collapse" >
                            <li>
                                <a href="../perusahaan/request.php"><i class="fa fa-fw fa-envelope"></i>Request Magang</a>
                            </li>
							<li>
                                <a href="pendaftaran.php"><i class="fa fa-fw fa-info"></i>Pendaftaran</a>
                            </li>
                            <li>
                                <a href="sp.php"><i class="fa fa-fw fa-tag"></i>Surat Pengantar</a>
                            </li>
							<li>
                                <a href="../perusahaan/umpanbalik.php"><i class="fa fa-fw fa-check"></i>Umpan Balik</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Pendaftaran <small><?php echo $perusahaan?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
								<i class="fa fa-dashboard"></i>  <a href="../perusahaan/perusahaan.php">Dashboard</a>
                            </li>
							<li class="active">
                                <i class="fa fa-info"></i> Pendaftaran
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
					<div class="col-lg-12">
                        <!-- <h2>Bordered with Striped Rows</h2> -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <!--<th>Perusahaan</th>
                                        <th>Jalur</th>
										<th>Status</th>-->
										<th>Seleksi</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
										include "koneksi.php";	
										$sql1 = "SELECT * FROM magang where perusahaan = '$perusahaan' and verifikasi='Sudah'";
										$kueri1 = mysql_query($sql1);
										$no=1;
										while($data1 = mysql_fetch_array($kueri1)){
											$nim = $data1['nim'];
											$selek = $data1['s_seleksi'];
											$sql_sp = "SELECT * FROM sp WHERE nim='$nim'";
											$cek_sp = mysql_query($sql_sp);
											$data_sp = mysql_fetch_array($cek_sp);
											
											
											//if($selek=="Diterima" || $selek=="Belum di Seleksi"){
												if($data_sp['nim']!="" && $data_sp['s_pudir']=="Disetujui"){
												$sql2 = "SELECT * FROM mhs WHERE nim='$nim'";
											$kueri2 = mysql_query($sql2);
											$data2 = mysql_fetch_array($kueri2);
											//$nama = $data1['nama'];
									?>
											<tr>
											<td><?php echo $no ?></td>
											<td><?php echo $data2['nama']?></td>
											<!--<td><?php echo $data1['perusahaan']?></td>
											<td><?php echo $data1['jalur']?></td>
											<td><?php echo $data1['s_seleksi']?></td>-->
										<?php
											if($data1['s_seleksi'] == 'Belum di Seleksi'){
										?>
												<td> <a href="seleksi.php?kode=<?php echo $data2['nim']?>">Seleksi</a></td>
										<?php } else {
												echo '<td></td>';
											}
										?>
											</tr>
										<?php
												$no++;}
										
											}
											?>
                                </tbody>
                            </table>
                        </div>
					</div>
				</div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
