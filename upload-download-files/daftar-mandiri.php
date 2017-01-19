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
if($_SESSION['hak_akses']!="mahasiswa"){
die("Anda bukan Mahasiswa");//jika bukan admin jangan lanjut
}
?>
<?php
	include "koneksi.php";
	
	$sql = "SELECT * FROM mhs WHERE username='$nm'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$nama = $data['nama'];
	$nim = $data['nim'];
	$pro = $data['prodi'];
	?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Page Mahasiswa</title>

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
                <a class="navbar-brand" href="../mhs/mahasiswa.php">Mahasiswa</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
			
			
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $nama?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <!-- <li>
                            <a href="profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li> -->
                        <li>
                            <a href="../mhs/setting.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../mhs/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="../mhs/mahasiswa.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li   class="active">
                        <a href="javascript:;" data-toggle="collapse" data-target="#dm"><i class="fa fa-fw fa-th-list"></i> Daftar Magang <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="dm" class="collapse">
                            <li>
                                <a href="daftar-mandiri.php"><i class="fa fa-fw fa-pencil"></i>Jalur Mandiri</a>
                            </li>
                            <li>
                                <a href="../mhs/kerjasama.php"><i class="fa fa-fw fa-pencil"></i>Jalur Kerjasama</a>
                            </li>
                        </ul>
                    </li>
					<li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#info"><i class="fa fa-fw fa-th-list"></i> Info <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="info" class="collapse">
                            <li>
                                <a href="../mhs/lowongan.php"><i class="fa fa-fw fa-info"></i>Lowongan Magang</a>
                            </li>
                            <li>
                                <a href="../mhs/pendaftaran.php"><i class="fa fa-fw fa-info"></i>Pendaftaran</a>
                            </li>
                        </ul>
                    </li>
					<?php
						include "koneksi.php";
	
								$sql4 = "SELECT * FROM magang WHERE nim='$nim'";
								$kueri4 = mysql_query($sql4);
								$data4 = mysql_fetch_array($kueri4);
								$seleksi1=$data4['s_seleksi'];
								$sql5 = "SELECT * FROM umpanbalik WHERE nim='$nim'";
								$kueri5 = mysql_query($sql5);
								$data5 = mysql_fetch_array($kueri5);
								$nim5=$data5['nim'];
								
								if($seleksi1=="Diterima"){
									?>
									<li>
										<a href="javascript:;" data-toggle="collapse" data-target="#m"><i class="fa fa-fw fa-th-list"></i> Magang <i class="fa fa-fw fa-caret-down"></i></a>
										<ul id="m" class="collapse">
											<li>
												<a href="../upload-download-files/upload-log.php"><i class="fa fa-fw fa-file"></i>Logbook</a>
											</li>
											<li>
												<a href="../upload-download-files/upload-job.php"><i class="fa fa-fw fa-file"></i>Jobdesk</a>
											</li>
											<li>
												<a href="../upload-download-files/upload-absen.php"><i class="fa fa-fw fa-file"></i>Absensi</a>
											</li>
											<?php
												if($nim5==""){
													?>
											<li>
												<a href="../mhs/umpanbalik.php"><i class="fa fa-fw fa-check"></i>Umpan Balik</a>
											</li>
													<?php
												} else{
											?>
											<li>
												<a href="#"><i class="fa fa-fw fa-check"></i>Umpan Balik</a>
											</li>
												<?php } ?>
										</ul>
									</li>
									<?php
								}
					?>
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
                            Daftar Magang <small><?php echo $nama?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="../mhs/mahasiswa.php"> Dashboard </a>
                            </li>
							<li>
                                <i class="fa fa-pencil"></i> <a href="../mhs/mahasiswa.php"> Jalur Mandiri </a>
                            </li>
							<li class="active">
                                <i class="fa fa-edit"></i> Daftar Magang
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-4">
                        <form role="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-group">
                                <label for="disabledSelect">Nim</label>
                                <input name="nim" class="form-control" id="disabledInput" type="text" value = "<?php echo $nim?>" readonly>
                            </div>
							<div class="form-group">
                                <label for="disabledSelect">Prodi</label>
                                <input name="prodi" class="form-control" id="disabledInput" type="text" value = "<?php echo $pro?>" readonly>
                            </div>
							<div class="form-group">
                                <label for="disabledSelect">Perusahaan</label>
                                <input name="perusahaan" class="form-control" id="disabledInput" type="text" required>
                            </div>
							<div class="form-group">
								<label>Tanggal Masuk</label>
								<input name="tgl_masuk" type="date" class="form-control">
								<p class="help-block">Minimal magang 4 bulan</p>
                            </div>
							<div class="form-group">
								<label>Tanggal Keluar</label>
								<input name="tgl_keluar" type="date" class="form-control">
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
                                <label for="disabledSelect">Jalur</label>
                                <input name="jalur" class="form-control" id="disabledInput" type="text" value="mandiri" readonly>
                            </div>
							<div class="form-group">
								<label>CV</label>
								<input name="cv" type="file" required>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							<div class="form-group">
								<label>Transkip Nilai</label>
								<input name="transkip" type="file" required>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							
							<button name="daftar" type="submit" class="btn btn-default">Daftar</button>
							<button name="batal" type="submit" class="btn btn-default">Batal</button>
						</form>
					</div>
				</div>
                <!-- /.row -->

                
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
			if(isset($_POST['daftar'])){
			$nim = $_POST['nim'];
			$prodi = $_POST['prodi'];
			$perusahaan = $_POST['perusahaan'];
			$tgl_masuk = $_POST['tgl_masuk'];
			$tgl_keluar = $_POST['tgl_keluar'];
			$jalur = $_POST['jalur'];
				
				$allowed_ext	= array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip', 'jpg', 'jpeg', 'png');
				$file_name		= $_FILES['cv']['name'];
				$value 			= explode('.', $file_name);
				$file_ext		= strtolower(end($value));
				$file_size		= $_FILES['cv']['size'];
				$file_tmp		= $_FILES['cv']['tmp_name'];
				$file_name1		= $_FILES['transkip']['name'];
				$value1			= explode('.', $file_name1);
				$file_ext1		= strtolower(end($value1));
				$file_size1		= $_FILES['transkip']['size'];
				$file_tmp1		= $_FILES['transkip']['tmp_name'];

				//$nama			= $_POST['nama'];
				//$tgl			= date("Y-m-d");

				if(in_array($file_ext, $allowed_ext) === true && in_array($file_ext1, $allowed_ext) === true){
					if($file_size < 1044070 && $file_size1 < 1044070){
						$lokasi = 'files/'.$file_name;
						$lokasi1 = 'files/'.$file_name1;
						move_uploaded_file($file_tmp, $lokasi);
						move_uploaded_file($file_tmp1, $lokasi1);
						
						$sql_cek="select * from magang where nim = '$nim'";
						$cek_cek=mysql_query($sql_cek);
						$data_cek = mysql_fetch_array($cek_cek);
						
						if($data_cek['nim']==""){
						
						$in = mysql_query("INSERT INTO magang VALUES('$nim','$prodi', '$perusahaan', '$tgl_masuk', '$tgl_keluar', '$jalur', 'Belum di Seleksi','Belum', '$file_name', '$file_name1', '$lokasi', '$lokasi1', NULL)");
						if($in){
							echo "<script> document.location='../mhs/mahasiswa.php'</script>";
						}else{
							echo "<script> alert('Register Gagal'); document.location='../upload-download-files/daftar-mandiri.php'</script>";
						}
						}else{
							$del="delete from sp where nim = '$nim'";
						$cek_del=mysql_query($del);
						$in = mysql_query("update magang set prodi = '$prodi', perusahaan='$perusahaan', tgl_masuk='$tgl_masuk', tgl_keluar='$tgl_keluar', jalur='$jalur', s_seleksi='Belum di Seleksi', verifikasi='Belum', cv='$file_name', transkip='$file_name1', filecv='$lokasi', filetranskip='$lokasi1' where nim='$nim'");
						//$in = mysql_query("UPDATE magang set '$nim','$prodi', '$perusahaan', '$tgl_masuk', '$tgl_keluar', '$jalur', 'Belum di Seleksi','Belum', '$file_name', '$file_name1', '$lokasi', '$lokasi1'");
						if($in){
							echo "<script>  document.location='../mhs/mahasiswa.php'</script>";
						}else{
							echo "<script> alert('Register Gagal'); document.location='../upload-download-files/daftar-kerjasama.php'</script>";
						}
					}
					}else{
						echo '<div class="error">ERROR: Besar ukuran file (file size) maksimal 1 Mb!</div>';
					}
				}else{
					echo '<div class="error">ERROR: Ekstensi file tidak di izinkan!</div>';
				}
				
			}
			if (isset($_POST['batal'])){
		echo "<script> document.location='../mhs/mahasiswa.php'</script>";
		
		}
			?>
