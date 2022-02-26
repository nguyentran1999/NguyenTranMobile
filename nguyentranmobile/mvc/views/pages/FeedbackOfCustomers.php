<!-- Boostrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $data["url"]; ?>scripts/ckeditor/ckeditor.js"></script>


<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Home/Default" title="Home" >Home</a><span> ›</span>
		<a style="color: gray">Feedback</a>
	</h4>
</div>
<!-- Header -->
<header id="portfolio">
    <div class="container">
        <h3 style="text-align: center"><b>FEEDBACK</b></h3>
        <div style="color: red">
        <?php 
        if(isset($data["Error"])){
            foreach($data["Error"] as $values){
                echo "<i>".$values."</i></br>";
            }  
        }
        ?>
        </div>

        <div style="color: blue">
        <?php 
            if(isset($data["Notice"])){
                echo "<h4>".$data["Notice"]."</h4>";
            }  
        ?>
    </div>
    </div>
</header>
<!-- Form -->
<br>
<div class="container">
    <form action="<?php echo $data["url"]?>Home/FeedbackCustomers" method="POST" class="form-horizontal">

        <div class="form-group">
            <label for="" class="col-sm-2 control-label">Feedback topic:</label>
            <div class="col-sm-10">
                <select name="slFeedbackTopic" id="slFeedbackTopic" class="form-control" style="width: 100% ; height: 100%">
                    <option value="0">Choose</option>
                    <?php while( $row = mysqli_fetch_array($data["ListCDGY"] ) ){ ?>
                    <option value="<?php echo $row["feedback_topic_id"]; ?>"><?php echo $row["feedback_topic_name"] ; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>                
              

        <div class="form-group">  
            <label for="lbl_txt_gy_noidung" class="col-sm-2 control-label">Feedback content:  </label>
			<div class="col-sm-10">
                <textarea class="ckeditor" type="text" name="txtFeedbackContent"></textarea>
                <script language="javascript">
                    CKEDITOR.replace('txtFeedbackContent',
                    {
                                            skin : 'kama',
                                            extraPlugins : 'uicolor',
                                            uiColor: '#eeeeee',
                                            toolbar : [ ['Source','DocProps','-','Save','NewPage','Preview','-','Templates'],
                                                ['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
                                                ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
                                                ['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
                                                ['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
                                                ['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
                                                ['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
                                                ['Link','Unlink','Anchor', 'NumberedList','BulletedList','-','Outdent','Indent'],
                                                ['Image','Flash','Table','Rule','Smiley','SpecialChar'],
                                                ['Style','FontFormat','FontName','FontSize'],
                                                ['TextColor','BGColor'],[ 'UIColor' ] ]
                                        });                                                			
                </script>                 
		    </div>
        </div>

        
        
                               
        <div class="col-sm-2"></div>
        <input type="submit" id="btnFeedback" name="btnFeedback" class="btn btn-success" value="Submit">
        <input type="button" id="btnBack" name="btnBack" class="btn btn-danger" value="Back" onclick="window.location='<?php echo $data["url"] ?>Home/Default';">

        </form>
        
</div>
<br><br>

<script type="text/javascript" src="<?php echo $data["url"]; ?>scripts/ckeditor/ckeditor.js"></script>