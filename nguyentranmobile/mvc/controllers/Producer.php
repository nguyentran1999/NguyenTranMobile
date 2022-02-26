<?php
if(isset($_SESSION['admin'])){
    class Producer extends Controller{

        protected $producerModel;

        function __construct(){
            $this->producerModel = $this->getModel("ProducerModel");
        }

        //Default method at runtime
        function Default(){
            if(isset($_SESSION['producerName']) && isset($_SESSION['producerDescription'])){
                unset($_SESSION['producerName']);
                unset($_SESSION['producerDescription']);
            }
            $this->getView("master1", [
                "Page" => "ProducerView",
                "List" => $this->producerModel->getList(),
                "url"=>$this->getBaseUrl()
            ]);
        }
        
        //Add view
        function addView(){
            $this->getView("master1", [
                "url"=>$this->getBaseUrl(),
                "Page" => "ProducerAdd"
            ]);
        }

        //Update view
        function updateView($producer_id){
            $this->getView("master1", [
                "url" => $this->getBaseUrl(),
                "Page" =>"ProducerUpdate",
                "Detail" => $this->producerModel->getIdDetail($producer_id)
            ]);
        }

        //Hàm thêm nha san xuat
        function producerAdd(){
            if(isset($_POST["btnAdd"])){
                $producerName = $_POST["txtProducerName"];
                $producerDescription = $_POST["txtProducerDescription"];

                $_SESSION['producerName'] = $producerName;
                $_SESSION['producerDescription'] = $producerDescription;

                $error = array();
                if(strlen($producerName) == ""){
                    $error['producerName'] = "Enter the producer name, please!";
                }
                if(strlen($producerDescription) == ""){
                    $error['producerDescription'] = "Enter the description of the producer, please!";
                }

                if(empty($error)){
                    $result = $this->producerModel->producerAddM($producerName, $producerDescription);
                    if($result == "true"){
                        $notice = "Producer has just been added successfully!";

                        unset($_SESSION['producerName']);
                        unset($_SESSION['producerDescription']);

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" => "ProducerView",
                            "List" => $this->producerModel->getList(),
                            "Notice" => $notice
                        ]);
                    }else{
                        $error['fail'] = "Add failed!";
                        $this->getView("master1", [
                            "url"=>$this->getBaseUrl(),
                            "Page" => "ProducerAdd",
                            "Error" => $error
                        ]);
                    }
                    
                }else{
                    $this->getView("master1", [
                        "url"=>$this->getBaseUrl(),
                        "Page" => "ProducerAdd",
                        "Error" => $error
                    ]);
                }
            }
        }

        //Ham cap nhat Nha San Xuat
        function producerUpdate(){
            if(isset($_POST["btnUpdate"])){
                $producerName = $_POST["txtProducerName"];
                $producerDescription = $_POST["txtProducerDescription"];
                $producerId = $_POST["hdProducerId"];

                $error = array();
                if(strlen($producerName) == ""){
                    $error['producerName'] = "Enter the producer name, please!";
                }
                if(strlen($producerDescription) == ""){
                    $error['producerDescription'] = "Enter the description of the producer, please!";
                }

                if(empty($error)){
                    $result = $this->producerModel->producerUpdateM($producerName, $producerDescription, $producerId);
                    if($result == "true"){
                        $notice = "Producer has just been updated successfully!";

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" => "ProducerView",
                            "List" => $this->producerModel->getList(),
                            "Notice" => $notice
                            
                        ]);
                    }else{
                        $error['fail'] = "Update failed";

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" =>"ProducerUpdate",
                            "Detail" => $this->producerModel->getIdDetail($producerId),
                            "Error" => $error
                        ]);
                    }
                    
                }else{
                    $this->getView("master1", [
                        "url" => $this->getBaseUrl(),
                        "Page" =>"ProducerUpdate",
                        "Detail" => $this->producerModel->getIdDetail($producerId),
                        "Error" => $error
                    ]);
                }
            }
        }

        //Ham xoa NhaSanXuat
        function producerDelete($producerId){
            $this->producerModel->producerDeleteM($producerId);
            header("Location: /nguyentranmobile/Producer/Default ");
        }

    }
}else{
    header("Location: /nguyentranmobile/Home/DangNhap");
}
?>