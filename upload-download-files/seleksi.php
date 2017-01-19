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

	$sql4 = "SELECT * FROM perusahaan WHERE username='$nm'";
	$kueri4 = mysql_query($sql4);
	$data4 = mysql_fetch_array($kueri4);
	$perusahaan = $data4['perusahaan'];
	$alamat= $data4['alamat'];
	$no_hp= $data4['no_hp'];
	$kuota = $data4['kuota'];
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
                                <a href="pendaftaran.php"><i class="fa fa-fw fa-info"></i>Pendaftaran</a>
                            </li>
                            <li>
                                <a href="sp.php"><i class="fa fa-fw fa-tag"></i>Surat Pengantar</a>
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
                            Seleksi Pendaftaran <small><?php echo $perusahaan?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
								<i class="fa fa-dashboard"></i>  <a href="../perusahaan/perusahaan.php">Dashboard</a>
                            </li>
							<li>
								<i class="fa fa-info"></i>  <a href="pendaftaran.php">Pendaftaran</a>
                            </li>
							<li class="active">
                                <i class="fa fa-pencil"></i> Seleksi Pendaftaran
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="" method="post">
							<div class="form-group">
								<label>Nama</label>
								<input name="nama" type = "text" class="form-control" value = "<?php echo $nama?>" readonly>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>Tanggal Masuk</label>
								<input name="tgl_masuk" type = "text" class="form-control" value = "<?php echo $tgl_masuk?>" readonly>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>Tanggal Keluar</label>
								<input name="tgl_keluar" type = "text" class="form-control" value = "<?php echo $tgl_keluar?>" readonly>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>CV</label>
								<p><?php echo '<a href="'.$data['filecv'].'">'.$data['cv'].'</a>' ?>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>Transkip Nilai</label>
								<p><?php echo '<a href="'.$data['filetranskip'].'">'.$data['transkip'].'</a>' ?>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<button name="terima" type="submit" class="btn btn-default">Terima</button>
							<button name="tolak" type="submit" class="btn btn-default">Tolak</button>
						</form>
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

<?php
			include('config.php');
			if(isset($_POST['terima'])){
						$in = mysql_query("UPDATE magang set s_seleksi = 'Diterima' where nim = $nim");
						if($in){
							echo "<script> alert('Seleksi Berhasil');document.location='pendaftaran.php'</script>";
						}else{
							echo "<script> alert('Seleksi Gagal');document.location='pendaftaran.php'</script>";
						}				
			}
			
			if(isset($_POST['tolak'])){
						$in = mysql_query("UPDATE magang set s_seleksi = 'Ditolak' where nim = $nim");
						if($in){
							echo "<script> alert('Seleksi Berhasil');document.location='pendaftaran.php'</script>";
						}else{
							echo "<script> alert('Seleksi Gagal');document.location='pendaftaran.php'</script>";
						}				
			}
			?>

