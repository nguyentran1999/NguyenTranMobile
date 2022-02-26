<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $data["url"]; ?>scripts/ckeditor/ckeditor.js"></script>
<!-- Header -->
<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Producer/Default" title="List of producers" >Producers</a><span> ›</span>
		<a style="color: gray">Update</a>
	</h4>
</div>

<header id="portfolio">
    <div class="container">
        <h3 style="text-align: center"><b>Producer update</b></h3>
        <?php 
            if(isset($data["Error"]["fail"])){ ?> 
            <i class="col-sm-12" style="color: red"><?php echo $data["Error"]["fail"] ?></i>   
        <?php }?>
    </div>
</header>
<br>
<!-- Form -->
<div class="container">
    <form action="<?php echo $data["url"]?>Producer/producerUpdate" method="POST" class="form-horizontal">
        <div class="form-group">
            <?php 
                $result = $data["Detail"];
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            ?>
            <label for="lblProducerName" class="col-sm-2 control-label">Producer name:</label>
            <div class="col-sm-10">
                <input type="text" id="txtProducerName" name="txtProducerName" class="form-control" value="<?php echo $row["producer_name"]; ?>">
            </div>
        </div>
        <?php 
            if(isset($data["Error"]["producerName"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["producerName"] ?></i>   
        <?php }?>    
        <div class="form-group">  
            <label for="lblProducerDescription" class="col-sm-2 control-label">Description:  </label>
            <div class="col-sm-10">
                <textarea class="ckeditor" type="text" name="txtProducerDescription"><?php echo $row["producer_description"]; ?></textarea>
                <script language="javascript">
                    CKEDITOR.replace('txtProducerDescription',
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
        <?php 
            if(isset($data["Error"]["producerDescription"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["producerDescription"] ?></i>   
        <?php }?>
            <input type="hidden" id="hdProducerId" name="hdProducerId"  value="<?php echo $row["producer_id"]; ?>">
    
        <div class="col-sm-2"></div>
        <input type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-success" value="Update">
        <input type="button" id="btnBack" name="btnBack" class="btn btn-danger" value="Back" onclick="window.location='<?php echo $data["url"] ?>Producer/Default';">
        <?php } ?>
    </form>
</div>

