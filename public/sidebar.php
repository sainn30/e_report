<div class="main-left-sidebar no-margin">
									<div class="user-data full-width">
										<div class="user-profile">
											<div class="username-dt">
												<div class="usr-pic">
												<?php if (@$_SESSION["user"]) {
													  if ($tampil['foto'] != "") {
														echo "<img src='profile/" . $tampil['foto'] . "' width='150' height='110' />";
													  }else {
														echo "<img src='profile/user.jpeg' width='150' height='110' />";
													  }
                                     			 }
                              					  ?>
												</div>
											</div><!--username-dt end-->
											<div class="user-specs">
                                                
                                                <h3><?php if (@$_SESSION["user"]) {
                                                    echo $tampil['nama_user'];
                                                }elseif (@$_SESSION["admin"]) {
                                                    echo $tampil['nama_admin'];
                                                }else {
                                                    echo "Tidak ada";
                                                }
                                                ?></h3>

												<span><?php 
												if (@$_SESSION["user"]) {
                                                    echo $tampil['pekerjaan'];
                                                }elseif (@$_SESSION["admin"]) {
                                                }
												?></span>
											</div>
										</div><!--user-profile end-->
										<ul class="user-fw-status">
											<?php 
											$akun = @$_SESSION["user"]["kode"];
											$variable = $koneksi->query("SELECT * FROM tb_user_follow WHERE kode = '$akun'");
											$jumlah = $variable->num_rows;
											?>
											<li>
												<h4>Following</h4>
												<span><?php echo $jumlah; ?></span>
											</li>
											<?php 
											$akun2 = @$_SESSION["user"]["kode"];
											$variable2 = $koneksi->query("SELECT * FROM tb_user_follow WHERE following = '$akun2'");
											$jumlah2 = $variable2->num_rows;
											?>
											<li>
												<h4>Followers</h4>
												<span><?php echo $jumlah2; ?></span>
											</li>
											<li>
												<a href="profile.php" title="">View profile</a>
											</li>
										</ul>
									</div><!--user-data end-->
									
								</div><!--main-left-sidebar end-->