<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--datatable-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<!-- Confirm trước khi xóa -->
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
        <h3 style="text-align: center"><b>PRODUCTS</b></h3>
    </div>
</header>

<!--Form -->
<div class="">
<form name="frmXoa" method="post" action="">
    <p>
        <a href="<?php echo $data["url"] ?>Product/addView"><img src="<?php echo $data["url"]?>/public/images/add.png"> Add new</a>
    </p>
    <table id="tablesalomon" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><strong>Product ID</strong></th>
                <th><strong>Product name</strong></th>
                <th><strong>Price</strong></th>
                <th><strong>Old price</strong></th>
                <th><strong>Promotion name</strong></th>
                <th><strong>Product amount</strong></th>
                <th><strong>Producer name</strong></th>
                <th><strong>Short description</strong></th>
                <th><strong>Picture</strong></th>
                <th><strong>Update</strong></th>
                <th><strong>Delete</strong></th>
            </tr>
        </thead>

        <tbody>
            <?php
                                
                $result = $data["List"];
                while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){
            ?>
            <tr>
                <td ><?php echo $row["product_id"] ?></td>
                <td><?php echo $row["product_name"] ?></td>
                <td><?php echo $row["product_price"] ?></td>
                <td><?php echo $row["product_old_price"] ?></td>
                <td><?php echo $row["promotion_name"] ?></td>
                <td><?php echo $row["product_amount"] ?></td>
                <td><?php echo $row["producer_name"] ?></td>
                <td><?php echo $row["product_short_description"] ?></td>
                <td align='center' class='cotNutChucNang'><a href="<?php echo $data["url"] ?>Product/updateImageView/<?php echo $row['product_id']?>"><img src="<?php echo $data["url"]?>public/images/image_edit.png" border='0'  /></td>            
        
                <td align='center' class='cotNutChucNang'>
                    <a href="<?php echo $data["url"] ?>Product/updateView/<?php echo $row['product_id'] ?>">
                    <img src="<?php echo $data["url"]?>/public/images/edit.png"></a>
                </td>
        
                <td align='center' class='cotNutChucNang'>
                    <a onclick="return deleteConfirm()" href="<?php echo $data["url"] ?>/Product/productDelete/<?php echo $row['product_id'] ?>">
                    <img src="<?php echo $data["url"]?>/public/images/delete.png">
                </td>
            </tr>
            <?php
                }
            ?>
        </tbody>

    </table>  

    <br>

    <div style="color: blue">
        <?php 
            if(isset($data["Notice"])){
                echo "<h4>".$data["Notice"]."</h4>";
            }  
        ?>
    </div>
</form>
</div>