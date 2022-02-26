<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- Header -->
<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Promotion/Default" title="List of promotions" >Promotions</a><span> ›</span>
		<a style="color: gray">Add new</a>
	</h4>
</div>

<header id="portfolio">
    <div class="container">
        <h3 style="text-align: center"><b>Promotion add</b></h3>
    <div style="color: red">
        <?php 
            if(isset($data["Error"]["fail"])){ ?> 
            <i class="col-sm-12" style="color: red"><?php echo $data["Error"]["producerDescription"] ?></i>   
        <?php }?>
        <br/>
    </div>   
    </div>
</header>
<!-- Form -->
<br>
<div class="container">
        <form action="<?php echo $data["url"]?>Promotion/promotionAdd" method="POST" class="form-horizontal">
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Promotion name:</label>
                <div class="col-sm-10">
                    <input type="text" id="txtPromotionName" name="txtPromotionName" class="form-control" value="<?php if(isset($_SESSION["promotionName"])){ echo $_SESSION["promotionName"];} ?>">
                </div>
        </div>
        <?php 
            if(isset($data["Error"]["promotionName"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["promotionName"] ?></i>   
        <?php }?>
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Promotion content:</label>
                <div class="col-sm-10">
                    <input type="text" id="txtPromotionContent" name="txtPromotionContent" class="form-control" value="<?php if(isset($_SESSION["promotionContent"])){ echo $_SESSION["promotionContent"];} ?>">
                </div>
        </div>
        <?php 
            if(isset($data["Error"]["promotionContent"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["promotionContent"] ?></i>   
        <?php }?>
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Promotion start date:</label>
                <div class="col-sm-10">
                    <input type="date" id="dtPromotionStartDay" name="dtPromotionStartDay" class="form-control" value="<?php if(isset($_SESSION["promotionStartDay"])){ echo $_SESSION["promotionStartDay"];} ?>">
                </div>
        </div>
        <?php 
            if(isset($data["Error"]["promotionStartDay"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["promotionStartDay"] ?></i>   
        <?php }?>
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Promotion end date:</label>
                <div class="col-sm-10">
                <input type="date" id="dtPromotionEndDay" name="dtPromotionEndDay" class="form-control" value="<?php if(isset($_SESSION["promotionEndDay"])){ echo $_SESSION["promotionEndDay"];} ?>">
                </div>
        </div>
        <?php 
            if(isset($data["Error"]["promotionEndDay"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["promotionEndDay"] ?></i>   
        <?php }?>        
        <div class="col-sm-2"></div>
        <input type="submit" id="btnAdd" name="btnAdd" class="btn btn-success" value="Add">
        <input type="button" id="btnBack" name="btnBack" class="btn btn-danger" value="Back" onclick="window.location='<?php echo $data["url"] ?>Promotion/Default';">

        </form>
        
</div>
<br><br>

