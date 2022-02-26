<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $data["url"]; ?>scripts/ckeditor/ckeditor.js"></script>

<script language="javascript">
	function deleteConfirm(){
		if(confirm("Are you sure you want to delete!")){
			return true;
		}
		else{
			return false;
		}
	}
	
</script>

<header id="portfolio">
    <div class="container">
	<h3><b>Update photos of the product</b></h3>
    <div style="color: red">
            <?php 
                if(isset($data["Error"])){
                    foreach($data["Error"] as $values){
						echo "<i>".$values."</i></br>";
                    }
                }
            ?>
    </div>
	<div style="color: blue">
        <?php 
            if(isset($data["Notice"])){
                echo "<h4>".$data["Notice"]."</h4>";
            }  
        ?>
    </div>
    </div>
</header>
		<div class="container">
			 	<form  id="frmHinhAnh" class="form-horizontal" name="frmHinhAnh" method="post" action="<?php echo $data["url"]?>Product/productPictureUpdate" enctype="multipart/form-data" role="form">
					<div class="form-group">
						<label for="txtTen" class="col-sm-2 control-label">Product ID:  </label>
						<?php
                    		$result = $data["Detail"];
                    		while( $row = mysqli_fetch_array($result, MYSQLI_ASSOC) ){
                			?>
						<div class="col-sm-10">
							<input type="text" name="txtProductId" id="txtProductId" class="form-control" placeholder="" value="<?php echo $row["product_id"]; ?>" readonly="readonly"/>
						</div>
            		</div>	
                    <div class="form-group">    
                        <label for="txtTen" class="col-sm-2 control-label">Product name:  </label>
						<div class="col-sm-10">
						     <input type="text" name="txt_sp_ten" id="txt_sp_ten" class="form-control" placeholder="" value="<?php echo $row["product_name"]; ?>" readonly="readonly"/> 
							<?php }?>
						</div>
					</div>
					   
                     <div class="form-group">    
                        <label for="" class="col-sm-2 control-label">Picture:  </label>
						<div class="col-sm-10">
							<input type="file" name="image" id="image" class="form-control"/>
							<br> 
							<input type="submit"  class="btn btn-success" name="btnSave" id="btnSave" value="Save a photo"/>
							<input type="button" class="btn btn-danger" id="btnBack" name="btnBack" class="w3-button w3-white" value="Back" onclick="window.location='<?php echo $data["url"] ?>Product/Default';">        
						</div>
                     </div>       
 
                    <!--Danh sach hinh anh-->
                     <div class="col-sm-offset-2 col-sm-12">
						<div class="col-sm-1">
                        	<label class="control-label">No.</label>
                        </div>
                        <div class="col-sm-2">
                        	<label class="control-label">Picture</label>
                        </div>
                        <div class="col-sm-1">
                        	<label class="control-label">Delete</label>
                        </div>
                    </div> <!-- <div class="col-sm-offset-2 col-sm-12">1 hang bang hinh anh-->
                   <!--Row du lieu-->
				   <?php
							$count = 1;
                    		while( $row2 = mysqli_fetch_array( $data["Hinh"], MYSQLI_ASSOC) ){
								
                			?>
							<div class='col-sm-offset-2 col-sm-12'>
							  <div class='col-sm-1'>
								<?php echo $count++;?>
									
								</div>
							  <div class='col-sm-2'>
								<img src="<?php echo $data["url"]?>public/uploads/<?php echo $row2["product_picture_name"] ?>" width="100px"/>
							  </div>
							  <div class='col-sm-3'>
								  <a onclick="return deleteConfirm()" 
                                  href="<?php echo $data["url"] ?>/Product/productPictureDelete/<?php echo $row2['product_picture_id']?>/<?php echo $row2['product_id']?>">
								  <img src="https://img.icons8.com/officexs/16/000000/delete-sign.png" border='0' /></a>
							  </div>
                              
							</div>
                            <div class='col-sm-offset-2 col-sm-4'>
                           		<div><hr /></div>
                           </div>
                          <?php 
							}
		  				?>
				<!-- <div class="form-group"> -Danh sach hinh anh-->

                    
				</form>
		</div><!--<div class="container">-->
