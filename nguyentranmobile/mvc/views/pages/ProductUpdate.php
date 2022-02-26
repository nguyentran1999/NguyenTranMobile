<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $data["url"]; ?>scripts/ckeditor/ckeditor.js"></script>
<!-- Header -->

<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Product/Default" title="List of product" >Products</a><span> ›</span>
		<a style="color: gray">Update</a>
	</h4>
</div>
<header id="portfolio">
    <div class="container">
        <h3 style="text-align: center"><b>Product update</b></h3>
    <div style="color: red">
        <?php 
            if(isset($data["Error"]["fail"])){ ?> 
            <i class="col-sm-12" style="color: red"><?php echo $data["Error"]["fail"] ?></i>   
        <?php }?>
    </div>
    </div>
</header>
<!-- Form -->
<br>
<div class="container">
        <form action="<?php echo $data["url"]?>Product/productUpdate" method="POST" class="form-horizontal">
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Product name:</label>
            <div class="col-sm-10">
                <?php
                    $result = $data["Detail"];
                    while( $row = mysqli_fetch_array($result, MYSQLI_ASSOC) ){
                        $selected2 = $row["producer_id"];
                        $selected3 = $row["promotion_id"];
                    
                ?>
                <input type="hidden" id="hdProductId" name="hdProductId" value="<?php echo $row["product_id"]; ?>">
                <input type="text" id="txtProductName" name="txtProductName" class="form-control" value="<?php echo $row["product_name"]; ?>">
                    
            </div>
        </div>
        <?php 
            if(isset($data["Error"]["productName"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["productName"] ?></i>   
        <?php }?>                 
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Producer name:</label>
                <div class="col-sm-10">
                    <select name="slProducerId" id="slProducerId" class="form-control" style="width: 100% ; height: 100%">
                        <option value="0">Choose</option>
                        <?php while( $row2 = mysqli_fetch_array($data["ListNSX"] ) ){ ?>
                            <?php if($selected2 == $row2["producer_id"]){ ?>
                        <option value="<?php echo $row2["producer_id"]; ?>" selected><?php echo $row2["producer_name"]; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $row2["producer_id"]; ?>"><?php echo $row2["producer_name"]; ?></option>
                            <?php }?>
                        <?php }?>
                    </select>
                </div>
        </div>
        <?php 
            if(isset($data["Error"]["producerId"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["producerId"] ?></i>   
        <?php }?>                     
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Promotion name:</label>
                <div class="col-sm-10">
                    <select name="slPromotionId" id="slPromotionId" class="form-control" style="width: 100% ; height: 100%">
                        <option value="0">Choose</option>
                        <?php while( $row3 = mysqli_fetch_array($data["ListKM"] ) ){ ?>
                            <?php if($selected3 == $row3["promotion_id"]){ ?>
                        <option value="<?php echo $row3["promotion_id"]; ?>" selected><?php echo $row3["promotion_name"]; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $row3["promotion_id"]; ?>"><?php echo $row3["promotion_name"]; ?></option>
                            <?php }?>
                        <?php }?>
                    </select>
                </div>
        </div>

        <?php 
            if(isset($data["Error"]["promotionId"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["promotionId"] ?></i>   
        <?php }?> 
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Price:</label>
            <div class="col-sm-10">
                <input type="number" id="txtProductPrice" name="txtProductPrice" class="form-control" value="<?php echo $row["product_price"]; ?>">
                <small>Just enter the number</small>
            </div>
        </div>
        <?php 
            if(isset($data["Error"]["productPrice"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["productPrice"] ?></i>   
        <?php }?>         
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Old price:</label>
            <div class="col-sm-10">
                <input type="number" id="txtProductOldPrice" name="txtProductOldPrice" class="form-control" value="<?php echo $row["product_old_price"]; ?>">
                <small>Just enter the number</small>
            </div>
        </div>
        <?php 
            if(isset($data["Error"]["productOldPrice"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["productOldPrice"] ?></i>   
        <?php }?> 
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Short description:</label>
            <div class="col-sm-10">
                <input type="text" id="txtShortDescription" name="txtShortDescription" class="form-control" value="<?php echo $row["product_short_description"]; ?>">
            </div>
        </div>
        <?php 
            if(isset($data["Error"]["shortDescription"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["shortDescription"] ?></i>   
        <?php }?>        
        <div class="form-group">  
            <label for="lbl_sp_motachitiet" class="col-sm-2 control-label">Detail description:</label>
			<div class="col-sm-10">
                <textarea class="ckeditor" type="text" name="txtDetailDescription"><?php echo $row["product_detail_description"]; ?></textarea>
                <script language="javascript">
                    CKEDITOR.replace('txtDetailDescription',
                    {
                                            skin : 'kama',
                                            extraPlugins : 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
                                                ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
                                                ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                                ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                                ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                                ['Style','FontFormat','FontName','FontSize'],
                                                ['TextColor','BGColor'],[ 'UIColor' ] ]
                                        });                                                			
                </script>                 
		    </div>
        </div>
        <?php 
            if(isset($data["Error"]["detailDescription"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["detailDescription"] ?></i>   
        <?php }?>                                
        <div class="form-group">  
            <label for="lbl_sp_cauhinhchitiet" class="col-sm-2 control-label">Configuration: </label>
			<div class="col-sm-10">
                <textarea class="ckeditor" type="text" name="txtProductConfiguration"><?php echo $row["product_configuration"]; ?></textarea>
                <script language="javascript">
                    CKEDITOR.replace('txtProductConfiguration',
                                        {
                                            skin : 'kama',
                                            extraPlugins : 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
                                                ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
                                                ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                                ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                                ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                                ['Style','FontFormat','FontName','FontSize'],
                                                ['TextColor','BGColor'],[ 'UIColor' ] ]
                                        });                            			
                </script>                 
		    </div>
        </div>
        <?php 
            if(isset($data["Error"]["productConfiguration"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["productConfiguration"] ?></i>   
        <?php }?> 
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Amount:</label>
            <div class="col-sm-10">
                
                <input type="number" id="txtProductAmount" name="txtProductAmount" class="form-control" value="<?php echo $row["product_amount"]; ?>">
                <small>Just enter the number</small>
                    <?php } ?>
            </div>
        </div>
        <?php 
            if(isset($data["Error"]["productAmount"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["productAmount"] ?></i>   
        <?php }?>         

        <div class="col-sm-2"></div>
        <input type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-success" value="Update">
        <input type="button" id="btnBack" name="btnBack" class="btn btn-danger" value="Back" onclick="window.location='<?php echo $data["url"] ?>Product/Default';">

        </form>
</div>

