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
if($_SESSION['hak_akses']!="sbk"){
die("Anda bukan Sub Bag Kerjasama");//jika bukan admin jangan lanjut
}
?>

<?php
	include "koneksi.php";
	if(isset($_GET['kode'])){
		$kode = $_GET['kode'];
	} else {
		echo "<script>alert('Data Belum Dipilih');document.location='localhost/ta/subbag/buatspm.php'</script>";
	}
	$sql = "SELECT * FROM perusahaan WHERE perusahaan='$kode'";
	$kueri = mysql_query($sql);
	$data = mysql_fetch_array($kueri);
	$nama_peru = $data['perusahaan'];
	
	//$sql = "SELECT * FROM mhs WHERE nim='$kode'";
	//$kueri = mysql_query($sql);
	//$data = mysql_fetch_array($kueri);
	//$nim_sp = $data['nim'];
	//$sql = "SELECT * FROM magang WHERE perusahaan='$nama_peru'";
	//$kueri = mysql_query($sql);
	//$data = mysql_fetch_array($kueri);
	//$nim_sp = $data['nim'];
	?>
<?php
	include "koneksi.php";
	
	$sql1 = "SELECT * FROM sbk WHERE username='$nm'";
	$kueri1 = mysql_query($sql1);
	$data1 = mysql_fetch_array($kueri1);
	$username = $data1['username'];
	$nik= $data1['nik'];
	$nama= $data1['nama'];
	?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Page Sub Bagian Kerjasama</title>

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
                <a class="navbar-brand" href="../subbag/homesubbag.php">Sub Bagian Kerjasama</a>
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
                            <a href="../subbag/setting.php"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../subbag/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <<li>
                        <a href="../subbag/homesubbag.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
					<li class="active">
                        <a href="javascript:;" data-toggle="collapse" data-target="#m"><i class="fa fa-fw fa-th-list"></i> Magang <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="m" class="collapse">
                            <li>
                                <a href="spm.php"><i class="fa fa-fw fa-tag"></i>Surat Pengantar</a>
                            </li>
							<li>
                                <a href="../subbag/buatspm.php"><i class="fa fa-fw fa-pencil"></i>Buat Surat Pengantar</a>
                            </li>
							<li>
                                <a href="../subbag/perusahaan.php"><i class="fa fa-fw fa-info"></i>Lowongan Magang</a>
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
                            Surat Pengantar <small><?php echo $nama?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="../subbag/homesubbag.php"> Dashboard </a>
                            </li>
							<li>
                                <i class="fa fa-pencil"></i> <a href="../subbag/buatspm.php"> Buat Surat Pengantar </a>
                            </li>
							<li class="active">
                                <i class="fa fa-tag"></i> Surat Pengantar
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
				<div class="row">
                    <div class="col-lg-4">
					
                        <form role="form" action="" method="post" enctype="multipart/form-data">
							<div class="form-group">
                                <label for="disabledSelect">Perusahaan</label>
                                <input name="perusahaan" class="form-control" id="disabledInput" type="text" value = "<?php echo $kode ?>" readonly>
                            </div>
							<div class="form-group">
								<label>Perihal</label>
								<select class="form-control" name="perihal">
								<option>--Perihal--</option>
								<option value="permohonan">Permohonan</option>
								<option value="pengantar">Pengantar</option>
								</select>
							</div>
							<div class="form-group">
								<label>Surat</label>
								<input name="sp" type="file" required>
								<!-- <p class="help-block">Example block-level help text here.</p> -->
                            </div>
							
							<!--<div class="form-group">
								<label>Surat Pengantar Magang</label>
								<input name="spm" type="file" required>
								<!-- <p class="help-block">Example block-level help text here.</p> 
                            </div>-->
					</div>
				</div>
							
							
				<div class="row">
				<div class="col-lg-12">
					<div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
										<th>Nim</th>
										<th>Perusahaan</th>
										<th>Pilih</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
						include "koneksi.php";
						//if (isset($_POST['tampilkan'])){
								$sql1 = "SELECT * FROM magang where verifikasi='Sudah' and perusahaan='$kode'";
								$kueri1 = mysql_query($sql1);
								$no=1;
								while($data1 = mysql_fetch_array($kueri1)){
									$nim2=$data1['nim'];
									$pe=$data1['perusahaan'];

									$sql3 = "SELECT * FROM mahasiswa where nim='$nim2'";
									$kueri3 = mysql_query($sql3);
									$data3 = mysql_fetch_array($kueri3);
									$sql4 = "SELECT * FROM sp where nim='$nim2' and perusahaan='$kode'";
									$kueri4 = mysql_query($sql4);
									$data4 = mysql_fetch_array($kueri4);
									$nim4=$data4['nim'];
									
									if($data1['s_seleksi']!='Ditolak'){
									?>
									<tr>
									<td><?php echo $data3['nama']?></td>
									<td><?php echo $data1['nim']?></td>
									<td><?php echo $data1['perusahaan']?></td>
									
									<td><input name ="ck[]" type="checkbox" value="<?php echo $data1['nim']?>"></td>
									</tr>
									<?php }
							$no++; }
							//}
							?>
                                </tbody>
                            </table>
							
                        </div>
						
							<button name="upload" type="submit" class="btn btn-default">Buat</button>
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
			if(isset($_POST['upload'])){
			$perusahaan = $_POST['perusahaan'];
			$perihal = $_POST['perihal'];
			$ck = $_POST['ck'];
							
				$allowed_ext	= array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'pdf', 'rar', 'zip', 'jpg', 'jpeg', 'png');
				//$file_name		= $_FILES['spm']['name'];
				//$value 			= explode('.', $file_name);
				//$file_ext		= strtolower(end($value));
				//$file_size		= $_FILES['spm']['size'];
				//$file_tmp		= $_FILES['spm']['tmp_name'];
				
				$file_name1		= $_FILES['sp']['name'];
				$value1			= explode('.', $file_name1);
				$file_ext1		= strtolower(end($value1));
				$file_size1		= $_FILES['sp']['size'];
				$file_tmp1		= $_FILES['sp']['tmp_name'];


				if(in_array($file_ext1, $allowed_ext) === true){
					if($file_size1 < 1044070){
						//$lokasi = 'files/'.$file_name;
						$lokasi1 = 'files/'.$file_name1;
						//move_uploaded_file($file_tmp, $lokasi);
						move_uploaded_file($file_tmp1, $lokasi1);
						//$in = mysql_query("INSERT INTO sp VALUES(NULL, '$perusahaan', '$perihal', '$file_name', '$lokasi', 'Belum di Verifikasi', 'Belum di Verifikasi')");
						for($i=0;$i<sizeof($ck);$i++){
						$in = mysql_query("INSERT INTO sp VALUES(NULL, '$ck[$i]', '$perusahaan', '$perihal', '$file_name1', '$lokasi1', 'Belum di Verifikasi')");
						if($in){
							echo "<script> alert('Surat Pengantar berhasil dibuat');document.location='../subbag/buatspm.php'</script>";
						}else{
							echo "<script> alert('Gagal');document.location='../subbag/buatspm.php'</script>";
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
		echo "<script> document.location='../subbag/buatspm.php'</script>";
		
		}
			?>

