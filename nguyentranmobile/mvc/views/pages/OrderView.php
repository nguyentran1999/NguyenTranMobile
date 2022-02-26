<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--datatable-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<!-- Confirm trước khi cap nhat -->
<script language="javascript">
            function updateConfirm(){
                if(confirm("Are you sure you want to pay!")){
                    return true;
                }
                else{
                    return false;
                }
            }
</script>

<script language="javascript">
            function updateNgayGiaoConfirm(){
                if(confirm("Are you sure you want the delivery date to be today!")){
                    return true;
                }
                else{
                    return false;
                }
            }
</script>
<!-- Datatable -->
<script language="javascript">
		$(document).ready(function() {
    var table = $('#tablesalomon').DataTable( {
        responsive: true,
            "lengthMenu": [[2, 5, 10, 15, 20, 25, 30, -1], [2, 5, 10, 15, 20, 25, 30, "Tất cả"]]
    } );
    new $.fn.dataTable.FixedHeader( table );
} );		
</script>

<!-- Header -->
<header id="portfolio">
    <div  class="container">
        <h3 style="text-align: center"><b>ORDERS</b></h3>
    </div>
</header>

<!--Form -->
<div class="">
<form name="frmXoa" method="post" action="">
    <table id="tablesalomon" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><strong>Order ID</strong></th>
                <th><strong>Product name</strong></th>
                <th><strong>Amount</strong></th>
                <th><strong>Tatol price</strong></th>
                <th><strong>Account name </strong></th>
                <th><strong>Delivery address</strong></th>
                <th><strong>Order date</strong></th>
                <th><strong>Delivery date</strong></th>
                <th><strong>Status</strong></th>
                <th><strong>Payment name</strong></th>
            </tr>
        </thead>

        <tbody>
            <?php
                                
                $result = $data["List"];
                while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){
            ?>
            <tr>
                <td ><?php echo $row["order_id"] ?></td>
                <td><?php echo $row["product_name"] ?></td>
                <td><?php echo $row["product_order_amount"] ?></td>
                <td><?php echo $row["product_order_total_price"] ?></td>
                <td><?php echo $row["customer_account_name"] ?></td>
                <td><?php echo $row["order_delivery_address"] ?></td>
                <td><?php echo $row["order_date"] ?></td>
                <td><?php if($row["order_delivery_date"] != "0000-00-00 00:00:00"){echo $row["order_delivery_date"];}else{?><a onclick="return updateNgayGiaoConfirm()" href="<?php echo $data["url"] ?>Order/NgayGiao/<?php echo $row['order_id'] ?>"><input type="button" class="form-control btn btn-success"  value="Delivery date"/><?php }?></td>
                <td><?php if($row["order_status"] == 0){ ?> <a onclick="return updateConfirm()" href="<?php echo $data["url"] ?>Order/ThanhToan/<?php echo $row['order_id'] ?>"> <input type="button" class="form-control btn btn-success"  value="Pay"/> <?php }else{ echo "Paid"; } ?></td>
                <td><?php echo $row["payment_id"] ?></td>
           
            </tr>
            <?php
                }
            ?>
        </tbody>

    </table>  
</form>
</div>