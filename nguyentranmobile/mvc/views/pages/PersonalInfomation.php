<!--Boostrap-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="container">
    <h4>
        <a href="<?php echo $data["url"] ?>Home/Default" title="Trang chủ" >Home</a><span> ›</span>
        <a href="<?php echo $data["url"] ?>Home/PersonalPage">Personal Page</a><span> ›</span>
        <a style="color: gray">Personal information</a>
    </h4>


    <?php if(isset($_SESSION['name'])){?>
        <?php if(isset($_SESSION['admin']) && $_SESSION['admin'] != null || isset($_SESSION['customer']) && $_SESSION['customer'] != null){?>
            <br>
            <p>Hello:<b><?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_account_name'];}else{echo $_SESSION['customer']['customer_account_name'];}?></b></p>
            
        <div class="row">
            <!-- Doi thong tin ca nhan -->
            <div class="col-sm-7">
                <form action="<?php echo $data["url"]?>Home/PersonalInfoUpdate" method="POST">
                <h3 style="text-align: center">Update personal information</h3>
                <div style="color: red">
                <?php 
                if(isset($data["Error"])){
                    foreach($data["Error"] as $values){
                        echo "<i>".$values."</i></br>";
                    }  
                }
                ?>
            </div>
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td style="width: 120px">Full name:</td>
                        <td><input class="form-control"  type="text" name="txtCustomerName" id="txtCustomerName" value="<?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_name'];}else{echo $_SESSION['customer']['customer_name'];}?>"/></td>
                    </tr>
                    <tr>
                        <td>Birthdate</td>
                        <td><input class="form-control" type="date" name="txtCustomerBirthdate" id="txtCustomerBirthdate" value="<?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_birth_date'];}else{echo $_SESSION['customer']['customer_birth_date'];} ?>"/></td>
                    </tr>
                    <tr>
                        <td >Address</td>
                        <td ><input class="form-control"  type="text" name="txtCustomerAddress" id="txtCustomerAddress" value="<?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_address'];}else{echo $_SESSION['customer']['customer_address'];} ?>"/></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>
                            <input class="form-control"   type="tel" name="txtCustomerPhone" id="txtCustomerPhone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required value="<?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_phone'];}else{echo $_SESSION['customer']['customer_phone'];} ?>"/>
                            <small>Form: 123-456-7890</small>
                        </td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input  class="form-control"  type="email" name="txtCustomerEmail" id="txtCustomerEmail" value="<?php if(isset($_SESSION['admin'])){ echo $_SESSION['admin']['customer_email'];}else{echo $_SESSION['customer']['customer_email'];}?>"/></td>
                    </tr>
                    <tr>
                        <td style="text-align: center" colspan="2"><input type="submit" name="btnInfoUpdate" class="btn btn-success" value="Update information"/></td>
                    </tr>
                    </tbody>
                </table>
                </form>
        <?php }?>
    <?php }?>
            </div>
            <!-- Doi mat khau -->
            <div class="col-sm-5">
                <form action="<?php echo $data["url"]?>Home/PasswordChange" method="POST">
                <h3 style="text-align: center">Change Password</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td>Current password</td>
                            <td><input type="password" name="txtPassword"  id="txtPassword" class="form-control" /></td>
                        </tr>
                        <tr>
                            <td>New password</td>   
                            <td><input type="password" name="txtPasswordNew"  id="txtPasswordNew" class="form-control" /></td>
                        </tr>
                        <tr>
                            <td>New password again</td>
                            <td><input type="password" name="txtPasswordNewAgain"  id="txtPasswordNewAgain" class="form-control" /></td>
                        </tr>
                        <tr>
                        <td style="text-align: center" colspan="2"><input type="submit" name="btnPasswordUpdate" class="btn btn-success" value="Change Password"/></td>
                    </tr>
                    </tbody>
                </table>   
                </form>    
            </div>
    </div>
</div>