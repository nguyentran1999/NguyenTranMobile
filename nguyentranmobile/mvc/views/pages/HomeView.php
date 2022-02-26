<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- Hot New Arrivals -->



<br>
<br>
<div class="">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div><h4 style="text-transform: uppercase">HOT PROMOTIONAL PHONE</h4></div>
							<ul>
								<li></li>
							</ul>
							<br>
							<hr/>
						</div>
						<div class="row">
							<div class="col-lg-12" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

										<!-- Slider Item -->
										<?php 
											while($row = mysqli_fetch_array($data["ListGetSanPhamKhuyenMai"], MYSQLI_ASSOC)){
										?>
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img width="200px" height="190px" src="<?php echo $data["url"]?>public/uploads/<?php echo $row["product_picture_name"]?>" alt=""></div>
												<div class="product_content">
													<br>
													<br>
													<div class="product_name"><div><a href="<?php echo $data["url"]?>Home/ViewSanPhamDon/<?php echo $row["product_id"]?>"><?php echo $row["product_name"]?></a></div></div>
													<div class="product_price" style="color: red"><b><?php echo number_format($row["product_price"])?>₫</b> <span><strike><?php if($row["product_old_price"] > $row["product_price"]) { echo number_format($row["product_old_price"]);?>₫<?php };?></strike></span></div>
													<div class="" style="font-size: 12px"><?php echo $row["promotion_content"]?></div>
													<div class="product_extras">
														<button class="product_cart_button" onclick="location.href='<?php echo $data["url"] ?>Home/ProductSingle/<?php echo $row["product_id"]?>';" >BUY</button>
													</div>
												</div>
												<!--<div class="product_fav"><i class="fas fa-heart"></i></div>-->
												<ul class="product_marks">
													
												</ul>
											</div>
											<br>
											<br>
										</div>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
</div>





<div class="">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="tabs clearfix tabs-right">
							<div><h4 style="text-transform: uppercase">THE MOST OUTSTANDING PHONE</h4></div>
							<ul>
								<li></li>
							</ul>
							<br>
							<hr/>
						</div>
						<div class="row">
							<div class="col-lg-12" style="z-index:1;">

								<!-- Product Panel -->
								<div class="product_panel panel active">
									<div class="arrivals_slider slider">

										<!-- Slider Item -->
										<?php 
											while($row = mysqli_fetch_array($data["ListGetSanPham"], MYSQLI_ASSOC)){
										?>
										<div class="arrivals_slider_item">
											<div class="border_active"></div>
											<div class="product_item is_new d-flex flex-column align-items-center justify-content-center text-center">
												<div class="product_image d-flex flex-column align-items-center justify-content-center"><img width="200px" height="190px" src="<?php echo $data["url"]?>public/uploads/<?php echo $row["product_picture_name"]?>" alt=""></div>
												<div class="product_content">
													<br>
													<br>
													<div class="product_name"><div><a href="<?php echo $data["url"]?>Home/ViewSanPhamDon/<?php echo $row["product_id"]?>"><?php echo $row["product_name"]?></a></div></div>
													<div class="product_price" style="color: red"><b><?php echo number_format($row["product_price"])?>₫</b> <span><strike><?php if($row["product_old_price"] > $row["product_price"]) { echo number_format($row["product_old_price"]);?>₫<?php };?></strike></span></div>
													<div class="" style="font-size: 12px"><?php echo $row["promotion_content"] ?></div>
													<div class="product_extras">
														<button class="product_cart_button" onclick="location.href='<?php echo $data["url"] ?>Home/ProductSingle/<?php echo $row["product_id"]?>';" >BUY</button>
													</div>
												</div>
												<!--<div class="product_fav"><i class="fas fa-heart"></i></div>-->
												<ul class="product_marks">
													<li class="" style="background-color: red; color: white;"></li>
												</ul>
											</div>
											<br>
											<br>
										</div>
										<?php }?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>

	

	<!-- Characteristics -->

	<div class="characteristics">
		<div class="container">
			<div class="row">

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="images/char_1.png" alt=""></div>
						<div class="char_content">
							<div class="char_title">Free shipping</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="images/char_2.png" alt=""></div>
						<div class="char_content">
							<div class="char_title">Home delivery</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="images/char_3.png" alt=""></div>
						<div class="char_content">
							<div class="char_title">Genuine</div>
						</div>
					</div>
				</div>

				<!-- Char. Item -->
				<div class="col-lg-3 col-md-6 char_col">
					
					<div class="char_item d-flex flex-row align-items-center justify-content-start">
						<div class="char_icon"><img src="images/char_4.png" alt=""></div>
						<div class="char_content">
							<div class="char_title">The most preferential price</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>

