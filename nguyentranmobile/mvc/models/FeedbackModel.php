<?php
    class FeedbackModel extends DB{

        function getList(){
            $sql = "SELECT * FROM `feedback` JOIN `feedback_topic` ON feedback.feedback_topic_id = feedback_topic.feedback_topic_id";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        function setFeedback($gy_ten, $gy_email, $gy_diachi, $gy_dienthoai, $gy_noidung, $gy_ngaygopy, $cdgy_ma){
            $sql = "INSERT INTO `feedback`(`feedback_name`, `feedback_email`, `feedback_address`, `feedback_phone`, `feedback_content`,
                                         `feedback_day`, `feedback_topic_id`) 
                                VALUES('$gy_ten', '$gy_email', '$gy_diachi', '$gy_dienthoai', '$gy_noidung',  
                                        '$gy_ngaygopy', $cdgy_ma)";
           
            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
            
        }
    }
?>