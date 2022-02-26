<?php
    class CustomerModel extends DB{

        function setCustomer($customerAccountName, $customerPassword, $customerName, $customerSex, $customerAddress , $customerPhone, $customerEmail, $customerBirthdate, $customerAuthorization){
            $sql = "INSERT INTO `customer`(`customer_account_name`,`customer_password`,`customer_name`,`customer_sex`,`customer_address`,`customer_phone`,`customer_email`,`customer_birth_date`, `customer_authorization`) 
                    VALUES('$customerAccountName', '$customerPassword', '$customerName', '$customerSex', '$customerAddress' ,'$customerPhone', '$customerEmail', '$customerBirthdate', $customerAuthorization)";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }

        function getList(){
            $sql = "SELECT * FROM `customer`";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        //dangNhapKhachHang
        public function customerSignInM($customerAccountName, $customerPassword){
            $sql = "SELECT * FROM `customer` WHERE `customer_account_name`='$customerAccountName' AND `customer_password`='$customerPassword'";
            
            $result = mysqli_query($this->conn, $sql);
            
            if(mysqli_num_rows($result)==1){
                return json_encode(true);
            }else{
                return json_encode(false);
            }
        }

        //getKhachhang
        public function getCustomer($customerAccountName, $customerPassword){
            $sql = "SELECT * FROM `customer` WHERE `customer_account_name` = '$customerAccountName' AND `customer_password` = '$customerPassword'";
            
            $result = mysqli_query($this->conn, $sql);
            $row = mysqli_fetch_array($result);

            if(mysqli_num_rows($result)==1){
                return $row;
            }else{
                return 0;
            }

        }

        //updateThongtinCaNhan
        function PersonalInfoUpdateM($customerAccountName, $customerName, $customerAddress , $customerPhone, $customerEmail, $customerBirthdate){
            $sql = "UPDATE `customer` SET `customer_name`='$customerName', `customer_address` = '$customerAddress', `customer_phone` = '$customerPhone', `customer_email` = '$customerEmail', `customer_birth_date` = '$customerBirthdate'
                    WHERE `customer_account_name`= '$customerAccountName'";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }

        function PasswordChange($customerAccountName, $customerPassword){
            $sql = "UPDATE `customer` SET `customer_password`='$customerPassword'
                    WHERE `customer_account_name`= '$customerAccountName'";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }



        // Hàm kiểm tra hợp lệ username
        function CheckUsername($customerAccountName)
        {
            $sql = "SELECT `customer_account_name` FROM `customer` WHERE `customer_account_name`= '$customerAccountName'";
            $result = mysqli_query($this->conn, $sql);
            $rows = mysqli_num_rows($result);
            
            if($rows>0){
                return false;
            }else{
                return true;
            }
        }

        // Kiểm tra customerEmail hợp lệ
        function CheckEmail($customerEmail)
        {
            $sql = "SELECT `customer_account_name` FROM `customer` WHERE `customer_email`= '$customerEmail'";
            $result = mysqli_query($this->conn, $sql);
            $rows = mysqli_num_rows($result);
            
            if($rows>0){
                return false;
            }else{
                return true;
            }
        }

        public function checkPassword($customerPassword, $customerAccountName){
            $sql = "SELECT * FROM `customer` WHERE `customer_password`='$customerPassword' AND `customer_account_name`='$customerAccountName'";
            $list = mysqli_query($this->conn, $sql);
            
            if(mysqli_num_rows($list)>0){
                return json_encode(true) ;
            }else{
                return json_encode(false) ;
            }
            
        }

    }
?>