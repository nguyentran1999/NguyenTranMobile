<?php
    class ProducerModel extends DB{

        //Lay tat ca du lieu tu csdl nhasanxuat
        function getList(){
            $sql = "SELECT * FROM `producer`";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        //Lay chi tiet nha san xuat theo ma -----------------
        function getIdDetail($producer_id){
            $sql = "SELECT * FROM producer WHERE `producer_id`= '$producer_id'";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        //Insert vao csdl ------------------
        function producerAddM($txtProducerName, $txtProducerDescription){
            $sql = "INSERT INTO `producer`(`producer_name`, `producer_description`) VALUES('$txtProducerName', '$txtProducerDescription')";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
        
            return json_encode($result);
        }

        //Update vao csdl--------------------
        public function producerUpdateM($txtProducerName, $txtProducerDescription, $producerId){
            $sql = "UPDATE `producer` SET `producer_name`='$txtProducerName', `producer_description` = '$txtProducerDescription'
                    WHERE `producer_id`= $producerId";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }

            return json_encode($result);
        }

        //delete-----
        public function producerDeleteM($producerId){
            $sql = "DELETE FROM `producer` WHERE `producer_id`='$producerId'";
            
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }
    }
?>