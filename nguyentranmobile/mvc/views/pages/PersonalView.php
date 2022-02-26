<!--Boostrap-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="container">
        <h4>
            <a href="<?php echo $data["url"] ?>Home/Default" title="Home" >Home</a><span> ›</span>
            <a style="color: gray">Personal page</a>
        </h4>

    <?php if(isset($_SESSION['name'])){?>
        <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] != null || isset($_SESSION['customer']) && $_SESSION['customer'] != null){?>
            <br>
            <p>Hello:<b><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_account_name'];}else{echo $_SESSION['customer']['customer_account_name'];}?></b></p>
            <h3 style="text-align: center">Account information</h3>
            <div style="color: blue">
                <?php 
                    if(isset($data["Notice"])){
                        echo "<h4>".$data["Notice"]."</h4>";
                    }  
                ?>
            </div>
            <p style="text-align: right"><input type="button" name="btnUpdate" value="Update information" class="btn btn-success" onclick="location.href='<?php echo $data["url"] ?>Home/PersonalInfo';" /></p>
    <table class="table table-striped">
        <tr>
            <td  style="text-align: center">Tài khoản</td>
            <td style="text-align: center"><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_account_name'];}else{echo $_SESSION['customer']['customer_account_name'];}?></td>       
        </tr>
        <tr>
            <td  style="text-align: center">Họ tên</td>
            <td style="text-align: center"><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_name'];}else{echo $_SESSION['customer']['customer_name'];}?></td>
        </tr>
        <tr>
            <td  style="text-align: center">Giới tính</td>
            <td style="text-align: center"><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_sex'];}else{echo $_SESSION['customer']['customer_sex'];}?></td>
        </tr>
        <tr>
            <td  style="text-align: center">Ngày sinh</td>
            <td style="text-align: center"><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_birth_date'];}else{echo $_SESSION['customer']['customer_birth_date'];} ?></td>
        </tr>
        <tr>
            <td  style="text-align: center">Địa chỉ</td>
            <td style="text-align: center"><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_address'];}else{echo $_SESSION['customer']['customer_address'];} ?></td>
        </tr>
        <tr>
            <td  style="text-align: center">Số điện thoại</td>
            <td style="text-align: center"><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_phone'];}else{echo $_SESSION['customer']['customer_phone'];} ?></td>
        </tr>
        <tr>
            <td  style="text-align: center" >Email</td>
            <td style="text-align: center"><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_email'];}else{echo $_SESSION['customer']['customer_email'];}?></td>
        </tr>
    </table>
        <?php }?>
    <?php }?>
<hr>
    <h3 style="text-align: center">List of orders</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                    <th><strong>Order ID</strong></th>
                    <th><strong>Product name</strong></th>
                    <th><strong>Amount</strong></th>
                    <th><strong>Date ordered</strong></th>
                    <th><strong>Delivery date</strong></th>
                    <th><strong>Nơi nhận</strong></th>
                    <th><strong>Status</strong></th>
            </tr>
        </thead>  
        <tbody>          
        <?php                   
            $result = $data["OrderList"];
            while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){
        ?>
        <tr>
            <td><?php echo $row["order_id"]?></td>
            <td><?php echo $row["product_name"]?></td>
            <td><?php echo $row["product_order_amount"]?></td>
            <td><?php echo $row["order_date"]?></td>
            <td><?php if($row["order_delivery_date"] == NULL){ echo "Unconfimred";}else{ echo $row["order_delivery_date"];}?></td>
            <td><?php echo $row["order_delivery_address"]?></td>
            <td><?php if($row["order_status"] == 0){ echo "Not completed payment";}else {echo "Paid";}?></td>
        </tr>
        <?php }?>
        </tbody>
    </table>

</div>