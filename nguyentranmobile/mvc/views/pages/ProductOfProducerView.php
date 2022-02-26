<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- Hot New Arrivals -->
<div class="">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="tabbed_container">
						<div class="">
							<div>
								<h4>
									<a href="<?php echo $data["url"] ?>Home/Default" title="Home" >Home</a><span> ›</span>
									<a href="" style="text-transform: uppercase;"><?php while($row = mysqli_fetch_array($data["ProducerName"], MYSQLI_ASSOC)){ ?> <?php echo "$row[producer_name]" ?><?php }?></a>
								</h4>
							</div>
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
											while($row = mysqli_fetch_array($data["ListProductOfProducer"], MYSQLI_ASSOC)){
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
												<ul class="product_marks">
													<li class=""></li>
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
						<p><?php while($row = mysqli_fetch_array($data["ListDescriptionProducer"], MYSQLI_ASSOC)){ ?> <?php echo $row["producer_description"] ?> <?php } ?> </p>
					</div>
				</div>
			</div>
		</div>		
	</div>
	
