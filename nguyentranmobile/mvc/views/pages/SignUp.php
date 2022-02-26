<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
function CheckUsername(str) {
    if (str.length == 0) {
        document.getElementById("error_username").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("error_username").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "<?php echo $data["url"] ?>Home/CheckUsername/" + str, true);
        xmlhttp.send();
    }
}

function CheckEmail(str) {
    if (str.length == 0) {
        document.getElementById("error_email").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("error_email").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "<?php echo $data["url"] ?>Home/CheckEmail/" + str, true);
        xmlhttp.send();
    }
}
</script>
<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Home/Default" title="Home" >Home</a><span> ›</span>
		<a style="color: gray">Sign up</a>
	</h4>
</div>
<!-- Header -->
<header id="portfolio">
    <div class="container">
        <div style="text-align: center"><h3><b>SIGN UP</b></h3></div>
        <div style="color: red">
        <?php 
        if(isset($data["Error"])){
            foreach($data["Error"] as $values){
                echo "<i>".$values."</i></br>";
            }  
        }
        ?>
        </div>
    </div>
</header>
<!-- Form -->
<div class="container">
        <form action="<?php echo $data["url"]?>Home/signUpRole" method="POST" class="form-horizontal">
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Account name:</label>
                <div class="col-sm-10">
                    <input type="text" id="txtAccountName" name="txtAccountName" class="form-control" value="<?php if(isset($_SESSION["customerAccountName"])){ echo $_SESSION["customerAccountName"];}  ?>" onkeyup="CheckUsername(this.value)">
                </div>
        </div>

        <div class="col-sm-2"></div>
        <div class="col-sm-10"><p id="error_username"></p></div>

        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" id="txtPassword" name="txtPassword" class="form-control" value="<?php if(isset($_SESSION["customerPassword"])){ echo $_SESSION["customerPassword"];}  ?>">
                </div>
        </div>
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Password again:</label>
                <div class="col-sm-10">
                    <input type="password" id="txtPasswordAgain" name="txtPasswordAgain" class="form-control" value="<?php if(isset($_SESSION["customerPasswordAgain"])){ echo $_SESSION["customerPasswordAgain"];}  ?>">
                </div>
        </div>
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Name:</label>
                <div class="col-sm-10">
                    <input type="text" id="txtName" name="txtName" class="form-control" value="<?php if(isset($_SESSION["customerName"])){ echo $_SESSION["customerName"];}  ?>">
                </div>
        </div>
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Bỉthdate:</label>
                <div class="col-sm-10">
                    <input type="date" id="dtBirthdate" name="dtBirthdate" class="form-control" value="<?php if(isset($_SESSION["customerBirthdate"])){ echo $_SESSION["customerBirthdate"];}  ?>">
                </div>
        </div>

        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Phone:</label>
                <div class="col-sm-10">
                    <input type="tel" id="txtPhone" name="txtPhone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required class="form-control" value="<?php if(isset($_SESSION["customerPhone"])){ echo $_SESSION["customerPhone"];}  ?>">
                    <small>Form: 123-456-7890</small>
                </div>
        </div>
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" id="txtEmail" name="txtEmail" class="form-control" value="<?php if(isset($_SESSION["customerEmail"])){ echo $_SESSION["customerEmail"];}  ?>" onkeyup="CheckEmail(this.value)">
                </div>
        </div>

        <div class="col-sm-2"></div>
        <div class="col-sm-10"><p id="error_email"></p></div>

        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Address:</label>
                <div class="col-sm-10">
                    <input type="tel" id="txtAddress" name="txtAddress" class="form-control" value="<?php if(isset($_SESSION["customerAddress"])){ echo $_SESSION["customerAddress"];}  ?>">
                </div>
        </div>
        <div class="form-group" >
            <label for="" class="col-sm-2 control-label">Sex:</label>
            <div class="col-sm-10">
                <select name="slSex" id="slSex" class="form-control" style="width: 100% ; height: 100%">
                    <option value="0">...</option>
                    <option value="Nam">Male</option>
                    <option value="Nữ">Female</option>
                </select>
            </div>
        </div>
        <div class="form-group">
        <div class="col-sm-2"></div>
        <img style="width: 20px" src="<?php echo $data["url"]?>/public/images/dangki.png">
        <input type="submit" id="btnSignUp" name="btnSignUp" class=" btn btn-default" value="Sign up for an account">
        </div>
        </form>
        
</div>