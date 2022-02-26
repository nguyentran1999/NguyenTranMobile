<!--Boostrap-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    function UpdateCart(id){
        qty = $("#qty_"+id).val();
        $.post('<?php echo $data["url"] ?>/Home/UpdateCart', {'id':id,'qty':qty}, function(data){
            $("#listCart").load("<?php echo $data["url"] ?>/Home/Cart #listCart");
            $("#listCartTotal").load("<?php echo $data["url"] ?>/Home/Cart #listCartTotal");
            $("#total").load("<?php echo $data["url"] ?>/Home/Cart #total");
        });
    }
</script>
<body>
<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Home/Default" title="Home" >Home</a><span> ›</span>
		<a style="color: gray">Cart</a>
	
    </h4>
    <p ><h4 style="color: blue"><?php if(isset($data["Notice"])) echo $data["Notice"]; ?></h4></p>
</div>
<div class="container">
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
<div id="total" style="text-align: center"><h3><b>CART</b></h3 >(<?php echo $total?> product(s))</div>
<?php if(isset($_SESSION['cart']) && $_SESSION['cart'] != null ){ ?>
    <form action="<?= $data["url"]; ?>Home/PaymentProduct" method="POST">
    <table class="table table-hover" id="listCart">
        <thead>
            <tr>
                <th>Product image</th>
                <th>Product's name</th>
                <th>Unit price</th>
                <th>Amount</th>
                <th>Total price of products</th>
                <th>Delete</th>
               
            </tr>
        </thead>
        <tbody>
            <?php foreach($_SESSION['cart'] as $key => $val){?>
            <tr>
                <td><img src="<?php echo $data["url"]?>public/uploads/<?php echo $val["hinh"] ?>" width="100px"/></td>
                <td><?php echo $val['name']?></td>
                <td> <?php echo number_format( $val['gia'])?></td>
                <td>
                    <input type="number" name="qty" id="qty_<?php echo $key;?>" value="<?php echo $val['qty']?>" onclick="UpdateCart(<?php echo $key ?>)" class="form-control" style="width: 100px"> 
                    
                </td>
                <td><?php echo number_format($val['gia']*$val['qty'])?></td>
                <td>
                    <a href="<?php echo $data["url"] ?>Home/DeleteCart/<?php echo $key ?>">
                    <img style="width: 20px" src="<?php echo $data["url"]?>/public/images/deletecart.png">
                    </a>
                </td>
            </tr>
            <?php }
            ?>
        </tbody>
    </table>
<p><h4  style="color: red"><?php if(isset($data["Error"])) echo $data["Error"]; ?></h4></p>
    <table class="table table-hover" id="listCartTotal">
        
        <tr>
            <td style="text-align: right" >
            <b>TOTAL PRICE:</b>
                 <h4 style="color: red"><?php echo number_format($totalprice)?></h4>
            </td>
        </tr>
    
    </table>
    <h4><b>Choose form of payment </b></h4>
    <?php
        $result = $data["ListPayment"];
        while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){ 
    ?>
        <p><input class="" type="radio" name="rdHTTT" id="rdHTTT" value="<?php echo $row["payment_id"] ?>"> <label for="" class="label-control"> <?php echo $row["payment_name"] ?></label></p>
        
    <?php }?>
    <table class="table table-hover" id="">
        <tr>
            <td style="text-align: center" >
                <h4><input type="submit" name="btnThanhToan" class="btn btn-success" value="PAY"/></h4>
            </td>
        </tr>
    
    </table>
    </form>


        
<?php }else{?>
    <p style="text-align: center">You have no items in your shopping cart. </p>
    <p style="text-align: center"><input type="button" id="btnMuaSam" name="btnMuaSam" class="btn btn-success" value="Continue shopping" onclick="window.location='<?php echo $data["url"] ?>Home/Default';"></p>
<?php }?>
</div>
</body>
