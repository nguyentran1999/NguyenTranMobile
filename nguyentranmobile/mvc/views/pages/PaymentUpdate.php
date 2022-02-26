<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- Header -->
<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Payment/Default" title="List of payments" >Payments</a><span> ›</span>
		<a style="color: gray">Update</a>
	</h4>
</div>

<header id="portfolio">
    <div class="container">
        <h3 style="text-align: center"><b>Payment update</b></h3>
    <div style="color: red">
        <?php 
            if(isset($data["Error"]["fail"])){ ?> 
            <i class="col-sm-12" style="color: red"><?php echo $data["Error"]["fail"] ?></i>   
        <?php }?>
    </div>
    <div class="w3-section w3-bottombar w3-padding-16">
    </div>
    
    </div>
</header>
<br>
<!-- Form -->
<div class="container">
        <form action="<?php echo $data["url"]?>Payment/paymentUpdate" method="POST" class="form-horizontal">
            <div class="form-group">
            <?php 
                    //$result = $data["Detail"];
                    //while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){<?php echo $row["payment_name"]; echo $row["payment_id"];
                    $payment = json_decode($data["Detail"]);
                ?>
                <label for="" class="col-sm-2 control-label">Payment name:</label>
                <div class="col-sm-10">
                    <input type="text" id="txtPaymentName" name="txtPaymentName" class="form-control" value="<?= $payment->name;  ?>">
                </div>
            </div>
            <?php 
                if(isset($data["Error"]["paymentName"])){ ?>
                <div class="col-sm-2"></div> 
                <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["paymentName"] ?></i>   
            <?php }?>            
                    <input type="hidden" id="hdPaymentId" name="hdPaymentId"  value="<?= $payment->id;  ?>">
                

        <div class="col-sm-2"></div>
        <input type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-success" value="Update">
        <input type="button" id="btnBack" name="btnBack" class="btn btn-danger" value="Back" onclick="window.location='<?php echo $data["url"] ?>Payment/Default';">
        <?php //} ?>
        </form>
</div>

