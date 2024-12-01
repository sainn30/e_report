<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sainstagram</title>
    <link rel="shortcut icon" type="img/png/jpg" href="public\image\sain (2).png" >
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
    body {
    	color: #fff;
    	background: #737373;
    }
    .form-control {
	    min-height: 41px;
	    background: #fff;
	    box-shadow: none !important;
	    border-color: #e3e3e3;
    }
    .form-control:focus {
	    border-color: #70c5c0;
    }
    .form-control, .btn {
	    border-radius: 2px;
    }
    .login-form {
	    width: 350px;
	    margin: 0 auto;
	    padding: 100px 0 30px;
    }
    .login-form form {
	    color: #7a7a7a;
	    border-radius: 2px;
    	margin-bottom: 15px;
    	font-size: 13px;
    	background: #ececec;
    	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    	padding: 30px;
    	position: relative;
    }
    .login-form h2 {
	    font-size: 22px;
	    margin: 35px 0 25px;
    }
    .login-form .avatar {
	    position: absolute;
    	margin: 0 auto;
    	left: 0;
    	right: 0;
    	top: -50px;
    	width: 95px;
    	height: 95px;
    	border-radius: 50%;
    	z-index: 9;
	    background: cornflowerblue;
	    padding: 15px;
	    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .login-form .avatar img {
	    width: 100%;
    }
    .login-form input[type="checkbox"] {
    	position: relative;
	    top: 1px;
    }
    .login-form .btn, .login-form .btn:active {
	    font-size: 16px;
	    font-weight: bold;
    	background: cornflowerblue !important;
	    border: none;
	    margin-bottom: 20px;
    }
    .login-form .btn:hover, .login-form .btn:focus {
	    background: blue !important;
    }
    .login-form a {
	    color: #fff;
	    text-decoration: underline;
    }
    .login-form a:hover {
	    text-decoration: none;
    }
    .login-form form a {
	    color: #7a7a7a;
	    text-decoration: none;
    }
    .login-form form a:hover {
	    text-decoration: underline;
    }
    .login-form .bottom-action {
	    font-size: 14px;
    }
</style>
</head>
<body>
<div class="login-form">
    <?php 
    include 'config.php';
    $query = $koneksi->query("SELECT max(kode) as kodeTerbesar FROM tb_user");
    $data = $query->fetch_array();
    $kodeUser = $data['kodeTerbesar'];
    $urutan = (int) substr($kodeUser, 4, 4); // (string, index, length)

    $urutan++;
    $huruf = "USE-";

    $kodeUser = $huruf . sprintf("%04s", $urutan); // %04s = 4 angka
    
    ?>
    <form action=""method="post">
		<div class="avatar">
        <li style="font-size:63px;color:white;margin-left:10px" class="fa fa-user text-center"></li>
    	</div>
        <h2 class="text-center">Member Register</h2>
        <div class="form-group">
        	<input type="hidden" name="kode" value="<?php echo $kodeUser; ?>">
        </div>
        <div class="form-group">
        	<input type="text" class="form-control" name="name-user" placeholder="Nama lengkap" required="required">
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required="required">
        </div>
        <div class="form-group">
        	<input type="text" class="form-control" name="user" placeholder="Username" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="pass1" placeholder="Password" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="pass2" placeholder="Ulangi Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="tombol" class="btn btn-primary btn-lg btn-block" value="login">Sign up</button>
        </div>
    </form>
    <p class="text-center small">Already have an account? <a href="login.php">Sign in here!</a></p>

    <?php 
    $kode = @$_POST['kode'];
    $nama_user = @$_POST['name-user'];
    $email = @$_POST['email'];
    $user = @$_POST['user'];
    $pass1 = md5(@$_POST['pass1'] ?? '');
    $pass2 = md5(@$_POST['pass2'] ?? '');
    $tombol = @$_POST['tombol'];

    if ($tombol) {
        if ($pass1 == $pass2) {
            $data = $koneksi->query("SELECT * FROM tb_user WHERE email='$email'");
            $hitung = $data->num_rows;
            if($hitung > 0){
                echo "<script>alert('Email sudah terdaftar!')</script>";
            } else {
               $input = $koneksi->query("INSERT INTO tb_login (kode, username, password, level, status, proses ) VALUES('$kode','$user','$pass1',
                'user', 'offline', 'aktif')");
               $input .= $koneksi->query("INSERT INTO tb_user (kode, nama_user, pekerjaan, email, no_hp, foto ) VALUES('$kode','$nama_user', '', '$email', '', '')");
               if ($input) {
                   echo "<script>alert('Register Berhasilh!'); location='login.php'</script>";
               }else {
                   echo "<script>alert('Register Gagal!'); location='register.php'</script>";
               }

            }
        }else {
            echo "<script>alert('Password Tidak Sama!'); location='register.php'</script>";
        }
    }
    
    ?>
</div>
</body>
</html> 