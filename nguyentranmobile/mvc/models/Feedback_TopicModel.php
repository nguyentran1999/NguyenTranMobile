<?php
    class Feedback_TopicModel extends DB{

        //Lay tat ca du lieu tu csdl feedback_topic
        function getList(){
            $sql = "SELECT * FROM `feedback_topic`";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        //Insert vao csdl
        function feedback_topicAddM($feedback_topicName){
            $sql = "INSERT INTO `feedback_topic`(`feedback_topic_name`) VALUES('$feedback_topicName')";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
        
            return json_encode($result);
        }

        //Update vao csdl
        public function feedback_topicUpdateM($feedback_topicName, $feedback_topicId){
            $sql = "UPDATE `feedback_topic` SET `feedback_topic_name`='$feedback_topicName'
                    WHERE `feedback_topic_id`= $feedback_topicId";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }

            return json_encode($result);
        }

        //delete
        public function feedback_topicDeleteM($feedback_topicId){
            $sql = "DELETE FROM `feedback_topic` WHERE `feedback_topic_id`='$feedback_topicId'";
            
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }

        //Lay chi tiet feedback_topic theo ma
        function getIdDetail($feedback_topicId){
            $sql = "SELECT * FROM feedback_topic WHERE `feedback_topic_id`= '$feedback_topicId'";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

    }
?>