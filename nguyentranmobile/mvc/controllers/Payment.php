<?php

//There is a web API for payment at the bottom/////////

if(isset($_SESSION['admin'])){
    class Payment extends Controller{

        protected $paymentModel;

        //contructer
        function __construct()
        {
            $this->paymentModel = $this->getModel("PaymentModel");
        }

        //Ham mac dinh khi chay
        function Default(){
            if(isset($_SESSION['paymentName'])){
                unset($_SESSION['paymentName']);
            }

            $this->getView("master1", [
                "Page" => "PaymentView",
                "List" => $this->paymentModel->getList(),
                "url"=>$this->getBaseUrl()
            ]);
        }

        //Hien thi view them moi HinhThucThanhToan
        function addView(){
            $this->getView("master1", [
                "url"=>$this->getBaseUrl(),
                "Page" => "PaymentAdd"
            ]);
        }

        //Hien thi View cap nhat HinhThucThanhToan
        function updateView($paymentId){

            $result = $this->paymentModel->getIdDetail($paymentId);

            $json_payment ="";
            if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_array($result);

                $response["id"] = $row["payment_id"];
                $response["name"] =  $row["payment_name"];

                $json_payment =  json_encode($response);
            }
            
            //$this->paymentModel->getIdDetail($paymentId)

            $this->getView("master1", [
                "url" => $this->getBaseUrl(),
                "Page" =>"PaymentUpdate",
                "Detail" => $json_payment
            ]);
        }

        //Hàm thêm HinhThucThanhToan
        function PaymentAdd(){
            if(isset($_POST["btnAdd"])){
                $paymentName = $_POST["txtPaymentName"];

                $_SESSION['paymentName'] = $paymentName;

                $error = array();
                if(strlen($paymentName) == ""){
                    $error['paymentName'] = "Enter the payment name, please!";
                }

                if(empty($error)){
                    $result = $this->paymentModel->PaymentAddM($paymentName);
                    if($result == "true"){
                        $notice = "Payment has just been added successfully!";

                        unset($_SESSION['paymentName']);

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" => "PaymentView",
                            "List" => $this->paymentModel->getList(),
                            "Notice" => $notice
                        ]);
                    }else{
                        $error['fail'] = "Add failed!";

                        $this->getView("master1", [
                            "url"=>$this->getBaseUrl(),
                            "Page" => "PaymentAdd",
                            "Error" => $error
                        ]);
                    }
                    
                }else{
                    $this->getView("master1", [
                        "url"=>$this->getBaseUrl(),
                        "Page" => "PaymentAdd",
                        "Error" => $error
                    ]);
                }
            }
        }

        //Ham cap nhat Hình thức thanh toán
        function paymentUpdate(){
            
                $paymentName = $_POST["txtPaymentName"];
                $paymentId = $_POST["hdPaymentId"];

                if(isset($_POST["btnUpdate"])){
                    $result = $this->paymentModel->getIdDetail($paymentId);
    
                    $json_payment ="";
                    if(mysqli_num_rows($result)>0){
                        $row = mysqli_fetch_array($result);
    
                        $response["id"] = $row["payment_id"];
                        $response["name"] =  $row["payment_name"];
    
                    $json_payment =  json_encode($response);
                }

                $error = array();
                if(strlen($paymentName) == ""){
                    $error['paymentName'] = "Enter the payment name, please!";
                }

                if(empty($error)){
                    $result = $this->paymentModel->PaymentUpdateM($paymentName, $paymentId);
                    if($result == "true"){
                        $notice = "Payment has just been updated successfully!";

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" => "PaymentView",
                            "List" => $this->paymentModel->getList(),
                            "Notice" => $notice
                            
                        ]);
                    }else{
                        $error['fail'] = "Update failed";

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" =>"PaymentUpdate",
                            "Detail" => $json_payment,
                            "Error" => $error
                        ]);
                    }
                    
                }else{
                    $this->getView("master1", [
                        "url" => $this->getBaseUrl(),
                        "Page" =>"PaymentUpdate",
                        "Detail" => $json_payment,
                        "Error" => $error
                    ]);
                }


            }
        }

        function get_payment_API($id){
            $result = $this->paymentModel->getIdDetail($id);

            $row = mysqli_fetch_array($result);

            $response["id"] = $row["payment_id"];
            $response["name"] =  $row["payment_name"];

            echo json_encode($response);
        }

        //Ham xoa HinhThucThanhToan
        function paymentDelete($paymentId){
            $this->paymentModel->PaymentDeleteM($paymentId);
            header("Location: /nguyentranmobile/Payment/Default ");
        } 
    }
}else{
    header("Location: /nguyentranmobile/Home/DangNhap");
}
?>