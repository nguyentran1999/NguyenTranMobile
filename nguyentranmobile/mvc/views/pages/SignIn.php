<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Home/Default" title="Home" >Home</a><span> ›</span>
		<a style="color: gray">Sign in</a>
	</h4>
</div>
<!-- Header -->
<header id="portfolio">
    <div class="container">
        <div style="text-align: center"><h3><b>SIGN IN</b></h3></div>
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
        <form action="<?php echo $data["url"]?>Home/signInRole" method="POST" class="form-horizontal">
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Account name:</label>
                <div class="col-sm-10">
                    <input type="text" id="txtAccountName" name="txtAccountName" class="form-control" value="<?php if(isset($_SESSION["kh_tendangnhap"])){ echo $_SESSION["kh_tendangnhap"];}  ?>">
                </div>
        </div>
        <div class="form-group">
                <label for="" class="col-sm-2 control-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" id="txtPassword" name="txtPassword" class="form-control" value="<?php if(isset($_SESSION["kh_matkhau"])){ echo $_SESSION["kh_matkhau"];}  ?>">
                </div>
        </div>
        <div class="form-group">
        <div class="col-sm-2"></div>
        <img style="width: 20px" src="<?php echo $data["url"]?>/public/images/dangki.png">
        <input type="submit" id="btnSignIn" name="btnSignIn" class=" btn btn-default" value="Sign in">
        </div>
        <hr>
        <div class="form-group">
        <div class="col-sm-2"></div>
        <a href="<?php echo $data["url"] ?>Home/signUp"> Đăng ký |</a>
        
        </div>
        
        </form>
        
</div>