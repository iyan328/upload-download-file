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
if($_SESSION['hak_akses']!="koordinator"){
die("Anda bukan koordinator");//jika bukan admin jangan lanjut
}
?>
<?php
	include "koneksi.php";
	
	$sql = "SELECT * FROM koordinator WHERE username='$nm'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$nama1 = $data['nama'];
	?>
	<?php
	include "koneksi.php";
	if(isset($_GET['kode'])){
		$kode = $_GET['kode'];
	} else {
		echo "<script>alert('Data Belum Dipilih');document.location='pendaftaranmagang.php'</script>";
	}
	$sql = "SELECT * FROM magang WHERE nim='$kode'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$nim = $data['nim'];
	$perusahaan= $data['perusahaan'];
	$tgl_masuk= $data['tgl_masuk'];
	$tgl_keluar= $data['tgl_keluar'];
	$jalur= $data['jalur'];
	$sql1 = "SELECT * FROM perusahaan WHERE perusahaan='$perusahaan'";
	$kueri1 = mysql_query($sql1);
	$data1 = mysql_fetch_array($kueri1);
	$ket = $data1['keterangan'];
	$kuota = $data1['kuota'];
	$sql2 = "SELECT * FROM mahasiswa WHERE nim='$kode'";
	$kueri2 = mysql_query($sql2);
	$data2 = mysql_fetch_array($kueri2);
	$nama = $data2['nama'];
	$kelas = $data2['kelas'];
	?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Page Koordinator</title>

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
                <a class="navbar-brand" href="../koordinator/homek.php">Dosen Koordinator</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
			
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nama1?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <!-- <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li> -->
                        <li>
                            <a href="../koordinator/setting.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../koordinator/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="../koordinator/homek.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#akun"><i class="fa fa-fw fa-th-list"></i> Akun <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="akun" class="collapse">
                            <li>
                                <a href="../koordinator/akunmhs.php"><i class="fa fa-fw fa-user"></i>Mahasiswa</a>
                            </li>
                            <li>
                                <a href="../koordinator/akundosenp.php"><i class="fa fa-fw fa-user"></i>Dosen Pembimbing</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#mg"><i class="fa fa-fw fa-th-list"></i> Magang <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="mg" class="collapse">
                            <li>
                                <a href="../koordinator/perusahaan.php"><i class="fa fa-fw fa-info"></i>Lowongan Magang</a>
                            </li>
                            <li>
                                <a href="../upload-download-files/pendaftaranmagang.php"><i class="fa fa-fw fa-info"></i>Pendaftaran</a>
                            </li>
							<li>
                                <a href="../koordinator/lihatdosen.php"><i class="fa fa-fw fa-edit"></i>Dosen Pembimbing</a>
                            </li>
                            <li>
                                <a href="../koordinator/nilai.php"><i class="fa fa-fw fa-pencil"></i>Nilai</a>
                            </li>
							<li>
                                <a href="../koordinator/umpanbalik.php"><i class="fa fa-fw fa-check"></i>Umpan Balik Mahasiswa</a>
                            </li>
							<li>
                                <a href="../koordinator/umpanbalik_i.php"><i class="fa fa-fw fa-check"></i>Umpan Balik Industri</a>
                            </li>
							<li>
                                <a href="../upload-download-files/surat_m.php"><i class="fa fa-fw fa-tag"></i>Surat Magang</a>
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
                            Dashboard <small><?php echo $nama1?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="../koordinator/homek.php"> Dashboard </a>
                            </li>
							<li class="active">
                                <i class="fa fa-info"></i> Pendaftaran
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-4">
                                   


<form action="" method="post">
							
			<div class="form-group">
                <label>Nim</label>
				<input name="nim" type ="text" class="form-control" id="nim" value = "<?php echo $nim?>" readonly>
            </div>
			<div class="form-group">
                <label>Nama</label>
				<input name="nama" type ="text" class="form-control" id="nama" value = "<?php echo $nama?>" readonly/>
            </div>
			<div class="form-group">
                <label>Kelas</label>
				<input name="kelas" type ="text" class="form-control" id="kelas" value = "<?php echo $kelas?>" readonly/>
            </div>
			<div class="form-group">
                <label>Perusahaan</label>
				<input name="perusahaan" type ="text" class="form-control" id="perusahaan" value = "<?php echo $perusahaan?>" readonly/>
            </div>
			
			<div class="form-group">
                <label>Kuota</label>
				<input name="kuota" type ="text" class="form-control" id="kuota" value = "<?php echo $kuota?>" readonly/>
            </div>
			
			<div class="form-group">
                <label>Keterangan</label>
				<input name="ket" type ="text" class="form-control" id="ket" value = "<?php echo $ket?>" readonly/>
            </div>
			
            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input name="tgl_masuk" type="text" class="form-control" id="tgl_masuk" value = "<?php echo $tgl_masuk?>" readonly/>
            </div>
			
			<div class="form-group">
                <label>Tanggal Keluar</label>
                <input name="tgl_keluar" type="text" class="form-control" id="tgl_keluar" value = "<?php echo $tgl_keluar?>" readonly/>
            </div>

            <div class="form-group">
                <label>Jalur</label>
                <input name="jalur" type="text" class="form-control" id="jalur" value="kerjasama" value = "<?php echo $jalur?>" readonly/>
            </div>
			
			<div class="form-group">
                <label>CV</label> <p>
                <?php echo '<a href="'.$data['filecv'].'">'.$data['cv'].'</a>' ?>
            </div>
			
			<div class="form-group">
                <label>Transkip Nilai</label> <p>
                <?php echo '<a href="'.$data['filetranskip'].'">'.$data['transkip'].'</a>' ?>
            </div>
			
			<div class="form-group">
                <label>Catatan</label>
				<textarea name="cat" class="form-control"></textarea>
            </div>

            <input name="terima" type="submit" id="terima" class="btn btn-default" value="Verifikasi"/>
			<input name="tolak" type="submit" id="tolak" class="btn btn-default" value="Tolak"/>

    </form>
					</div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

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
<?php

			include('config.php');
			if(isset($_POST['terima'])){
						$in = mysql_query("UPDATE magang set verifikasi = 'Sudah', keterangan=NULL where nim = $nim");
						if($in){
							echo "<script>document.location='pendaftaranmagang.php'</script>";
						}else{
							echo "<script> alert('Seleksi Gagal');document.location='seleksim.php'</script>";
						}				
			}
			
			if(isset($_POST['tolak'])){
				$cat=$_POST['cat'];
						$in = mysql_query("UPDATE magang set verifikasi = 'Gagal', keterangan='$cat' where nim = $nim");
						if($in){
							echo "<script> document.location='pendaftaranmagang.php'</script>";
						}else{
							echo "<script> alert('Seleksi Gagal');document.location='seleksim.php'</script>";
						}				
			}
			?>
