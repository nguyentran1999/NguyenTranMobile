<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- Header -->
<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Payment/Default" title="List of payments" >Payments</a><span> ›</span>
		<a style="color: gray">Add new</a>
	</h4>
</div>
<header id="portfolio">
    <div class="container">
        <h3 style="text-align: center"><b>Payment Add</b></h3>
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
        <form action="<?php echo $data["url"]?>Payment/PaymentAdd" method="POST" class="form-horizontal">
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Payment name:</label>
                <div class="col-sm-10">
                    <input type="text" id="txtPaymentName" name="txtPaymentName" class="form-control" value="<?php if(isset($_SESSION["paymentName"])){ echo $_SESSION["paymentName"];} ?>">
                </div>
        </div>
        <?php 
            if(isset($data["Error"]["paymentName"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["paymentName"] ?></i>   
        <?php }?>

        <div class="col-sm-2"></div>
        <input type="submit" id="btnAdd" name="btnAdd" class="btn btn-success" value="Add">
        <input type="button" id="btnBack" name="btnBack" class="btn btn-danger" value="back" onclick="window.location='<?php echo $data["url"] ?>Payment/Default';">

        </form>
        
</div>
<br><br>

