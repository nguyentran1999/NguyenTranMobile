<!-- Bootstrap -->
<link rel="stylesheet" type="text/css" href="<?php echo $data["url"]; ?>styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo $data["url"]; ?>styles/product_responsive.css">
<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Home/Default" title="Home" >Home</a><span> ›</span>
		<?php while($row = mysqli_fetch_array($data["ProducerSingle"], MYSQLI_ASSOC)){?>
		<a href="<?php echo $data["url"] ?>Home/ProductOfProducer/<?php echo $row['producer_id'] ?>"><?php echo $row["producer_name"]?></a><span> ›</span>
		<a style="color: gray"><?php echo $row["product_name"]?></a>
		<?php }?>
	</h4>
</div>
<div class="single_product">
		<div class="container">
			
			<div class="row">

				<!-- Images -->
				<div class="col-lg-2 order-lg-1 order-2">
					<ul class="image_list">
                    <?php while($row = mysqli_fetch_array($data["PictureList"], MYSQLI_ASSOC)){
                        ?>
						<li data-image="<?php echo $data["url"]?>public/uploads/<?php echo $row["product_picture_name"]?>"><img src="<?php echo $data["url"]?>public/uploads/<?php echo $row["product_picture_name"]?>" alt=""></li>
                    <?php }?>
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
                <?php while($row = mysqli_fetch_array($data["PictureSingle"], MYSQLI_ASSOC)){?>
                    <div class="image_selected"><img src="<?php echo $data["url"]?>public/uploads/<?php echo $row["product_picture_name"]?>" alt=""></div>
                <?php }?>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="product_description">
                        <div class="product_category"></div>
                        <?php while($row = mysqli_fetch_array($data["ProductSingle"], MYSQLI_ASSOC)){?>
						<div class="product_name"><b><?php echo $row["product_name"] ?></b></div>
						<div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div>
						<div class="product_text"><p><?php echo $row["product_short_description"]?></p></div>
						<div class="order_info d-flex flex-row">
							<form action="#">
								<div style="color: red"><h4><b><?php echo number_format($row["product_price"])?>₫</b></h4></div>
								<div class="button_container">
									<button type="button" class="button cart_button"><a href="<?php echo $data["url"] ?>Home/AddCart/<?php echo $row['product_id'] ?>">Add to cart</a></button>
						
								</div>
                        
							</form>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
		
	<div class="container">
	<hr>
 		<div class="row">
     		<div class="col-sm-9">
			 <h4><b>Review details.</b></h4>
			 	<p><?php echo $row["product_detail_description"]?></p>
        	</div>
        	<div class="col-sm-3">
				<h4><b>Technical data</b></h4>
				<p><?php echo $row["product_configuration"]?></p>
       		 </div>
   	 	</div>    
	</div>
	
    <?php }?>
    <hr>