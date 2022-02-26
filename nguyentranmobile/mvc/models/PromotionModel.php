<?php
    class PromotionModel extends DB{

        //Lay tat ca du lieu tu csdl promotion
        function getList(){
            $sql = "SELECT * FROM `promotion`";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        //Insert vao csdl
        function promotionAddM($promotionName, $promotionContent, $promotionStartDay, $promotionEndDay){
            $sql = "INSERT INTO `promotion`(`promotion_name`, `promotion_content`, `promotion_start_day`, `promotion_end_day`) 
                        VALUES('$promotionName', '$promotionContent', '$promotionStartDay', '$promotionEndDay')";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
        
            return json_encode($result);
        }

        //Update vao csdl
        public function promotionUpdateM($promotionName, $promotionContent,$promotionStartDay, $promotionEndDay, $promotionId){
            $sql = "UPDATE `promotion` SET `promotion_name`='$promotionName', `promotion_content`= '$promotionContent', 
                    `promotion_start_day`= '$promotionStartDay', `promotion_end_day`= '$promotionEndDay'
                    WHERE `promotion_id`= $promotionId ";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }

            return json_encode($result);
        }

        //delete
        public function promotionDeleteM($promotionId){
            $sql = "DELETE FROM `promotion` WHERE `promotion_id`='$promotionId'";
            
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }

        //Lay chi tiet Khuyen Mai theo ma
        function getIdDetail($promotionId){
            $sql = "SELECT * FROM promotion WHERE `promotion_id`= '$promotionId'";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

    }
?>