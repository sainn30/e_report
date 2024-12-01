<?php
@session_start();
if (@$_SESSION['admin'] || @$_SESSION['user']) {


?>



<!DOCTYPE html>
<html>

<?php include "head.php"; ?>

<body>
	

	<div class="wrapper">
		
		<?php include 'header.php'; ?>

		

		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-3 col-md-4 pd-left-none no-pd">
								<?php include 'sidebar.php'; ?>
							</div>
							<div class="col-lg-9 col-md-8 no-pd">
								<div class="main-ws-sec">
                                <?php 
                                      if (@$_SESSION["user"]) {
										$kode = @$_SESSION["user"] ["kode"];
										$data = $koneksi->query("SELECT * FROM tb_user WHERE kode='$kode'");
										$tampil = $data->fetch_array();
										if ($tampil['pekerjaan'] != '' && $tampil['no_hp'] != '') {

                                    ?>
									<div class="post-topbar">
										<div class="user-picy">
										<?php if (@$_SESSION["user"]) {
                                         		echo "<img src='profile/" . $tampil['foto'] . "' width='100' height='50' />";
                                     		}
                              			?>
										</div>
                                    
										<div class="post-st">
											<ul>
												<li><a class="post-jb active" href="#" title="">Posting Laporan</a></li>
											</ul>
										</div><!--post-st end-->
									</div><!--post-topbar end-->
                                    <?php 
									  }else {
										?>
											<div class="alert alert-success" role="alert">
											<h1 class="alert-heading">Selamat Datang ke E-Report, 
											<?php
											if (@$_SESSION["user"]) {
                                                    echo $tampil['nama_user'];
												}
											?>
											</h1>
											<p>Untuk mengajukan laporan pengajuan silahkan melengkapi profil terlebih dahulu</p>
											<hr>
											<p class="mb-0">Silahkan klik <a href="profile.php?=<?php echo $kode; ?>" class="alert-link">Disini</a></a></p>
											</div>
										<?php 
									  }
									}
                                    ?>
									<div class="posts-section">
										
										<?php include 'slider.php'; ?>

										<?php 
										include 'time.php';
										$a = $koneksi->query("SELECT * FROM (tb_login LEFT JOIN tb_user ON tb_login.kode = tb_user.kode) LEFT JOIN 
										tb_pengaduan ON tb_pengaduan.id_user=tb_user.id_user WHERE tb_login.kode = '$kode' ORDER BY tgl_pengaduan
										 DESC;");
										$num = $a->num_rows;
										if ($num > 0) {

										while ($tampil_report = $a->fetch_array()) {
										?>
										<div class="post-bar">
											<div class="post_topbar">
												<div class="usy-dt">
												<?php if (@$_SESSION["user"]) {
													  if ($tampil['foto'] != "") {
														echo "<img src='profile/" . $tampil['foto'] . "' width='50' height='50' />";
													  }else {
														echo "<img src='profile/user.jpeg' width='50' height='50' />";
													  }
                                     			 }
                              					?>													
												  <div class="usy-name">
														<h3><?php if (@$_SESSION["user"]) {
                                          					 echo $tampil['nama_user'];
                                   						   }?></h3>
														<span>
															<img src="images/clock.png" alt="">
															<?php 
															// echo $tampil_report['tgl_pengaduan']; 
															$date = $tampil_report['tgl_pengaduan']; 
															echo TimeAgo($date, date("Y-m-d H:i:s"));
															?>
														</span>
													</div>
												</div>
												<div class="ed-opts">
													<a href="#" title="" class="ed-opts-open"><i class="la la-ellipsis-v"></i></a>
													<ul class="ed-options">
														<li><a href="edit-post.php?id=<?php echo $tampil_report['id_pengaduan']; ?>" title="">Edit Post</a></li>
														<li><a href="delete-post.php?id=<?php echo $tampil_report['id_pengaduan']; ?>" title="">Delete</a></li>

													</ul>
												</div>
											</div>
											
											<div class="job_descp">
												<h3>
													<?php 
													 echo $tampil_report['judul_pengaduan'];
													?>
												</h3>

												<?php 
											
												if ($tampil_report['gambar_pengaduan'] != "") {
														echo "<img class='mb-3 img-thumbnail col-lg-12' src='foto/" . $tampil_report['gambar_pengaduan'] . "' width='100' height='300' />";
													  }else {
														echo "";
													  }
													  
												?>
												
												<p><?php echo $tampil_report['isi_pengaduan'];?>...<a href="#" title="">view more</a></p>

												
												
											</div>
											
										</div><!--post-bar end-->

										<?php 
										} // penutup while
										} else {
											?>
											<div class="process-comm">
											<div class="spinner">
												<div class="bounce1"></div>
												<div class="bounce2"></div>
												<div class="bounce3"></div>
											</div>
										</div><!--process-comm end-->
											<?php
										}
										?>
										
										
									</div><!--posts-section end-->
								</div><!--main-ws-sec end-->
							</div>
							
						</div>
					</div><!-- main-section-data end-->
				</div> 
			</div>
		</main>

       <?php include "footer.php"; ?>

	</div><!--theme-layout end-->



<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.mCustomScrollbar.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/scrollbar.js"></script>
<script type="text/javascript" src="js/script.js"></script>

</body>
</html>

<?php
} else {
    echo "<script>location='../login.php'</script>";
}
?>