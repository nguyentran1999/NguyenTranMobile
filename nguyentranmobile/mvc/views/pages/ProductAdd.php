<!-- Boostrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $data["url"]; ?>scripts/ckeditor/ckeditor.js"></script>


<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Product/Default" title="List of products" >Products</a><span> ›</span>
		<a style="color: gray">Add new</a>
	</h4>
</div>
<!-- Header -->
<header id="portfolio">
    <div class="container">
        <h3 style="text-align: center"><b>Product add</b></h3>
        <div style="color: red">
        <?php 
            if(isset($data["Error"]["fail"])){ ?> 
            <i class="col-sm-12" style="color: red"><?php echo $data["Error"]["fail"] ?></i>   
        <?php }?>
        <br/>
        </div>
    </div>
</header>
<!-- Form -->
<br>
<div class="container">
    <form action="<?php echo $data["url"]?>Product/productAdd" method="POST" class="form-horizontal">
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Product name:</label>
                <div class="col-sm-10">
                    <input type="text" id="txtProductName" name="txtProductName" placeholder="Enter the product name" class="form-control" value="<?php if(isset($_SESSION["productName"])){ echo $_SESSION["productName"];} ?>">
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
                    <?php while( $row = mysqli_fetch_array($data["ListNSX"] ) ){ ?>
                    <option value="<?php echo $row["producer_id"]; ?>"><?php echo $row["producer_name"] ; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>                
        <?php 
            if(isset($data["Error"]["producerId"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["producerId"] ?></i>   
        <?php }?>                
        <div class="form-group" >
            <label for="" class="col-sm-2 control-label">Promotion name:</label>
            <div class="col-sm-10">
                <select name="slPromotionId" id="slPromotionId" class="form-control" style="width: 100% ; height: 100%">
                    <option value="0">Choose</option>
                    <?php while( $row = mysqli_fetch_array($data["ListKM"] ) ){ ?>
                    <option value="<?php echo $row["promotion_id"]; ?>"><?php echo $row["promotion_name"] ; ?></option>
                    <?php } ?>
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
                <input type="number" id="txtProductPrice" name="txtProductPrice" placeholder="Enter product price" class="form-control" value="<?php if(isset($_SESSION["productPrice"])){ echo $_SESSION["productPrice"];} ?>">
                <small>Just enter the number</small>
            </div>
        </div>
        <?php 
            if(isset($data["Error"]["productPrice"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["productPrice"] ?></i>   
        <?php }?>        
        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Short description:</label>
            <div class="col-sm-10">
                <input type="text" id="txtShortDescription" name="txtShortDescription" placeholder="Enter short description" class="form-control" value="<?php if(isset($_SESSION["shortDescription"])){ echo $_SESSION["shortDescription"];} ?>">
            </div>
        </div>
        <?php 
            if(isset($data["Error"]["shortDescription"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["shortDescription"] ?></i>   
        <?php }?>                
        <div class="form-group">  
            <label for="lbl_sp_motachitiet" class="col-sm-2 control-label">Detail description:  </label>
			<div class="col-sm-10">
                <textarea class="ckeditor" type="text" name="txtDetailDescription"><?php if(isset($_SESSION["detailDescription"])){ echo $_SESSION["detailDescription"];} ?></textarea>
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
            <label for="lbl_sp_cauhinhchitiet" class="col-sm-2 control-label">Configuration:  </label>
			<div class="col-sm-10">
                <textarea class="ckeditor" type="text" name="txtProductConfiguration"><?php if(isset($_SESSION["productConfiguration"])){ echo $_SESSION["productConfiguration"];} ?></textarea>
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
                <input type="number" id="txtProductAmount" name="txtProductAmount" placeholder="Enter product amount" class="form-control" value="<?php if(isset($_SESSION["productAmount"])){ echo $_SESSION["productAmount"];}?>">
                <small>Just enter the number</small>
            </div>
        </div>
        <?php 
            if(isset($data["Error"]["productAmount"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["productAmount"] ?></i>   
        <?php }?>                       
        <div class="col-sm-2"></div>
        <input type="submit" id="btnAdd" name="btnAdd" class="btn btn-success" value="Add">
        <input type="button" id="btnBack" name="btnBack" class="btn btn-danger" value="Back" onclick="window.location='<?php echo $data["url"] ?>Product/Default';">

        </form>
        
</div>
<br><br>

<script type="text/javascript" src="<?php echo $data["url"]; ?>scripts/ckeditor/ckeditor.js"></script>