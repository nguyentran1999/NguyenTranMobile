<?php
    class PaymentModel extends DB{

        //Lay tat ca du lieu tu csdl payment
        function getList(){
            $sql = "SELECT * FROM `payment`";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        //Insert vao csdl
        function PaymentAddM($paymentName){
            $sql = "INSERT INTO `payment`(`payment_name`) VALUES('$paymentName')";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
        
            return json_encode($result);
        }

        //Update vao csdl
        public function PaymentUpdateM($paymentName, $paymentId){
            $sql = "UPDATE `payment` SET `payment_name`='$paymentName'
                    WHERE `payment_id`= $paymentId";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }

            return json_encode($result);
        }

        //delete
        public function PaymentDeleteM($paymentId){
            $sql = "DELETE FROM `payment` WHERE `payment_id`='$paymentId'";
            
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }

        //Lay chi tiet hinh thuc thanh toan theo ma
        function getIdDetail($paymentId){
            $sql = "SELECT * FROM payment WHERE `payment_id`= '$paymentId'";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

    }
?>