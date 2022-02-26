<!DOCTYPE html>
<html lang="en">
<head>
<title>CUSC - KA Mobile</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="OneTech shop project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="<?php echo $data["url"]; ?>styles/bootstrap4/bootstrap.min.css">
<link href="<?php echo $data["url"]; ?>plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo $data["url"]; ?>plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data["url"]; ?>plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data["url"]; ?>plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data["url"]; ?>plugins/slick-1.8.0/slick.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data["url"]; ?>styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data["url"]; ?>styles/responsive.css">

</head>

<body>

<div class="super_container">
	
	<!-- Header -->
	
	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/phone.png" alt=""></div>+38 068 005 3570</div>
						<div class="top_bar_contact_item"><div class="top_bar_icon"><img src="images/mail.png" alt=""></div><a href="https://aptech.cusc.vn/">tnnguyena18098@cusc.ctu.edu.vn</a></div>
						<div class="top_bar_content ml-auto">
							<div class="top_bar_menu">
							<?php
									if(isset($_SESSION['name'])){ ?>
											<?php 
												if(isset($_SESSION['admin'])){?>
													<a href="<?php echo $data["url"] ?>Order/Default"><img src="<?php echo $data["url"]; ?>public/images/quanli.png" width="20px" alt="">Site management</a>
												<?php }?>
								<?php }?>
							</div>
							<div class="top_bar_user">
								<?php
									if(isset($_SESSION['name'])){ ?>
											Hello:
											<?php 
												if(isset($_SESSION['admin'])){ ?>
													<a href="<?php echo $data["url"] ?>Home/PersonalPage"><?php echo $_SESSION['admin']['customer_name'];?></a>
													
												<?php }
												if(isset($_SESSION['customer'])){?>
													<a href="<?php echo $data["url"] ?>Home/PersonalPage"><?php echo $_SESSION['customer']['customer_name'];?></a>
												<?php }
											?>
										<a href="<?php echo $data["url"] ?>Home/signOut">| Sign out</a>

								<?php }else{?>
									<div><a href="<?php echo $data["url"] ?>Home/signUp">Sign up|</a></div>
									<div><a href="<?php echo $data["url"] ?>Home/signIn">Sign in</a></div>
								<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>		
		</div>

		<!-- Header Main -->

		<div class="header_main">
			<div class="container">
				<div class="row">

					<!-- Logo -->
					<div class="col-lg-3 col-sm-3 col-3 order-1">
						<div class="logo_container">
						<div class="logo"> <a href="<?php echo $data["url"] ?>Home/Default"> <img src="<?php echo $data["url"] ?>public/images/Logo.png" width="250"></a></div>
						</div>
					</div>

					<!-- Search -->
					<div class="col-lg-5 col-12 order-lg-2 order-3 text-lg-left text-right">
					</div>

					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
							</div>

							<!-- Cart -->
							<?php 
								$total = 0;
								$totalprice = 0;
								if(isset($_SESSION['cart']) && $_SESSION['cart'] != null){
									foreach($_SESSION['cart'] as $key => $val){
										$total += $val['qty'];
										$totalprice += (($val['gia'])*($val['qty']));
									}
								}
							?>

							<div class="cart">
								<div class="cart_container d-flex flex-row align-items-center justify-content-end">
									<div class="">
										<img width="50" height="40" src="<?php echo $data['url']?>public/images/shopping-cart.png" alt="">
										<div class="cart_count"><span><?php echo $total?></span></div>
									</div>
									<div class="cart_content">
										<div class="cart_text"><a href="<?php echo $data["url"] ?>Home/Cart">Cart</a></div>
										<div class="cart_price"><?php echo number_format($totalprice)?>₫</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
        
        <!-- Main Navigation -->

		<nav class="main_nav" style="background-color: #1E90FF">
			<div class="container" style="background-color: #1E90FF" >
						
							<!-- Main Nav Menu -->

							<div class="main_nav_menu ml-auto" >
								<ul class="standard_dropdown main_nav_dropdown" >
									<li><a href="<?php echo $data["url"] ?>Home/Default" style="color: white">Home<i class="fas fa-chevron-down"></i></a></li>
									<li class="hassubs" >
										<a href="#" style="color: white">Product Management<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li>
												<a href="<?php echo $data["url"] ?>Product/Default" >Products<i class="fas fa-chevron-down"></i></a>
											</li>
											<li><a href="<?php echo $data["url"] ?>Producer/Default">Producers<i class="fas fa-chevron-down"></i></a></li>
										</ul>
                                    </li>
                                    <li class="hassubs">
										<a href="#" style="color: white">Other genres<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li>
												<a href="<?php echo $data["url"] ?>Payment/Default">Payments<i class="fas fa-chevron-down"></i></a>
											</li>
                                            <li><a href="<?php echo $data["url"] ?>Feedback_Topic/Default">Feedback topic<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li><a href="<?php echo $data["url"] ?>Customer/Default" style="color: white">Customers<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="<?php echo $data["url"] ?>Promotion/Default" style="color: white">Promotions<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="<?php echo $data["url"] ?>Order/Default" style="color: white">Orders<i class="fas fa-chevron-down"></i></a></li>
                                    <li><a href="<?php echo $data["url"] ?>Feedback/Default" style="color: white">Feedback<i class="fas fa-chevron-down"></i></a></li>
								</ul>
							</div>
			</div>
		</nav>
	</header>
        <?php require_once "./mvc/views/pages/".$data["Page"].".php";?>

<!-- Footer -->
<hr/>
<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 footer_col">
					<div class="footer_column footer_contact">
						<div class="logo_container">
							<div class="logo"><a href="#">KA Mobile</a></div>
						</div>
						<div class="footer_title">Gọi mua hàng</div>
						<div class="footer_phone">+84 292 373 1071</div>
						<div class="footer_contact_text">
							<p>Địa chỉ: 01 Lý Tự Trọng, Quận Ninh Kiều,</p>
							<p>TP. Cần Thơ</p>
						</div>
						<div class="footer_social">
							<ul>
								<li><a href="https://www.facebook.com/CUSC.CE/"><i class="fab fa-facebook-f"></i></a></li>
								<li><a href="https://www.youtube.com/channel/UCeCyUK8qM1k-sIQVGyJ_Bfw"><i class="fab fa-youtube"></i></a></li>
								<li><a href="https://aptech.cusc.vn/"><i class="fab fa-google"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-lg-2 offset-lg-2">
					<div class="footer_column">
						<ul class="footer_list">
							<li><h4>CƠ SỞ 1</h4>285 Đội Cấn, Q. Ba Đình, Hà Nội Tel: 1800 1141 E-mail: aptech1@aprotrain.com</li>
							<li><h4>CƠ SỞ 2</h4>212-214 Nguyễn Đình Chiểu, Q.3, TPHCM Tel: 1800 1779 E-mail: aptech2@aprotrain.com</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
					<ul class="footer_list">
							<li><h4>CƠ SỞ 3</h4>54 Lê Thanh Nghị, Bách Khoa, Q. Hai Bà Trưng, Hà Nội Tel: 0899 179 029 E-mail: aptech3@aprotrain.com</li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2">
					<div class="footer_column">
						<ul class="footer_list">
							<li>Gọi mua hàng 1800.1060 (7:30 - 22:00)</li>
							<li>Gọi khiếu nại   1800.1062 (8:00 - 21:30)</li>
							<li>Gọi bảo hành   1800.1064 (8:00 - 21:00)</li>
							<li>Kỹ thuật  1800.1763 (7:30 - 22:00)</li>
						
						</ul>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col">
					
					<div class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
						<div class="copyright_content"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</div>
						<div class="logos ml-sm-auto">
							<ul class="logos_list">
								<li><a href="#"><img src="images/logos_1.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_2.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_3.png" alt=""></a></li>
								<li><a href="#"><img src="images/logos_4.png" alt=""></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo $data["url"]; ?>styles/bootstrap4/popper.js"></script>
<script src="<?php echo $data["url"]; ?>styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?php echo $data["url"]; ?>plugins/greensock/TweenMax.min.js"></script>
<script src="<?php echo $data["url"]; ?>plugins/greensock/TimelineMax.min.js"></script>
<script src="<?php echo $data["url"]; ?>plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="<?php echo $data["url"]; ?>plugins/greensock/animation.gsap.min.js"></script>
<script src="<?php echo $data["url"]; ?>plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="<?php echo $data["url"]; ?>plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?php echo $data["url"]; ?>plugins/slick-1.8.0/slick.js"></script>
<script src="<?php echo $data["url"]; ?>plugins/easing/easing.js"></script>
<script src="<?php echo $data["url"]; ?>js/custom.js"></script>