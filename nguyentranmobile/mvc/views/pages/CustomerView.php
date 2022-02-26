<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!--datatable-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>


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
        <h3 style="text-align: center"><b>CUSTOMERS</b></h3>
    </div>
</header>

<!--Form -->
<div class="">
<form name="frmXoa" method="post" action="">
<table id="tablesalomon" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
                <th><strong>Account name</strong></th>
                <th><strong>Customer name</strong></th>
                <th><strong>Sex</strong></th>
                <th><strong>Address</strong></th>
                <th><strong>Phone</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Birthdate</strong></th>
                <th><strong>authorization</strong></th>

        </tr>
        </thead>

                <tbody>
        <?php
                                
                $result = $data["List"];
                while( $row=mysqli_fetch_array( $result, MYSQLI_ASSOC )){
        ?>
        <tr>
            <td ><?php echo $row["customer_account_name"] ?></td>
            <td><?php echo $row["customer_name"] ?></td>
            <td><?php echo $row["customer_sex"] ?></td>
            <td><?php echo $row["customer_address"] ?></td>
            <td><?php echo $row["customer_phone"] ?></td>
            <td><?php echo $row["customer_email"] ?></td>
            <td><?php echo $row["customer_birth_date"] ?></td>
            <td><?php echo $row["customer_authorization"] ?></td>
        </tr>
        <?php
            }
         ?>
                </tbody>

</table>  

<br>


 </form>
</div>