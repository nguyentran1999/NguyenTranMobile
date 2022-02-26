<!-- Bootstrap -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<!-- Header -->
<div class="container">
	<h4>
		<a href="<?php echo $data["url"] ?>Feedback_Topic/Default" title="List of feedback_topic" >Feedbacks topic</a><span> ›</span>
		<a style="color: gray">Update</a>
	</h4>
</div>

<header id="portfolio">
    <div class="container">
        <h3 style="text-align: center"><b>Feedback topic update</b></h3>
    <div style="color: red">
        <?php 
            if(isset($data["Error"]["fail"])){ ?> 
            <i class="col-sm-12" style="color: red"><?php echo $data["Error"]["fail"] ?></i>   
        <?php }?>
    </div>
    
    </div>
</header>
<br>
<!-- Form -->
<div class="container">
        <form action="<?php echo $data["url"]?>Feedback_Topic/feedback_topicUpdate" method="POST" class="form-horizontal">
            <div class="form-group">
                <label for="" class="col-sm-2 control-label">Feedback topic name:</label>
                <?php 
                    $result = $data["Detail"];
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                ?>
                <div class="col-sm-10">
                    <input type="text" id="txtFeedback_TopicName" name="txtFeedback_TopicName" class="form-control" value="<?php echo $row["feedback_topic_name"]; ?>">
                </div>
                </div>
                <?php 
            if(isset($data["Error"]["feedback_topicName"])){ ?>
            <div class="col-sm-2"></div> 
            <i class="col-sm-10" style="color: red"><?php echo $data["Error"]["feedback_topicName"] ?></i>   
        <?php }?>        
                    <input type="hidden" id="hdFeedback_TopicNameId" name="hdFeedback_TopicNameId"  value="<?php echo $row["feedback_topic_id"]; ?>">
                <?php } ?>
        

        <div class="col-sm-2"></div>
        <input type="submit" id="btnUpdate" name="btnUpdate" class="btn btn-success" value="Update">
        <input type="button" id="btnBack" name="btnBack" class="btn btn-danger" value="Back" onclick="window.location='<?php echo $data["url"] ?>Feedback_Topic/Default';">

        </form>
</div>

