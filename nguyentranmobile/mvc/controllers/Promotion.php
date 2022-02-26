<?php
if(isset($_SESSION['admin'])){
    class Promotion extends Controller{

        protected $promotionModel;

        //contructer
        function __construct()
        {
            $this->promotionModel = $this->getModel("PromotionModel");
        }

        //Ham mac dinh khi chay
        function Default(){
            if(isset($_SESSION['promotionName']) && isset($_SESSION['promotionContent']) && isset($_SESSION['promotionStartDay']) && isset($_SESSION['promotionEndDay'])){
                unset($_SESSION['promotionName']);
                unset($_SESSION['promotionContent']);
                unset($_SESSION['promotionStartDay']);
                unset($_SESSION['promotionEndDay']);
            }

            $this->getView("master1", [
                "Page" => "PromotionView",
                "List" => $this->promotionModel->getList(),
                "url"=>$this->getBaseUrl()
            ]);
        }

        //Hien thi view them moi khuyen mai
        function addView(){
            $this->getView("master1", [
                "url"=>$this->getBaseUrl(),
                "Page" => "PromotionAdd"
            ]);
        }

        //Hien thi View cap nhat khuyen mai
        function updateView($promotionId){
            $this->getView("master1", [
                "url" => $this->getBaseUrl(),
                "Page" =>"PromotionUpdate",
                "Detail" => $this->promotionModel->getIdDetail($promotionId)
            ]);
        }

        //Hàm thêm khuyen mai
        function promotionAdd(){
            if(isset($_POST["btnAdd"])){
                $promotionName = $_POST["txtPromotionName"];
                $promotionContent = $_POST["txtPromotionContent"];
                $promotionStartDay = $_POST["dtPromotionStartDay"];
                $promotionEndDay = $_POST["dtPromotionEndDay"];

                $_SESSION['promotionName'] = $promotionName;
                $_SESSION['promotionContent'] = $promotionContent;
                $_SESSION['promotionStartDay'] = $promotionStartDay;
                $_SESSION['promotionEndDay'] = $promotionEndDay;

                $error = array();
                if(strlen($promotionName) == ""){
                    $error['promotionName'] = "Enter the promotion name, please!";
                }
                if(strlen($promotionContent) == ""){
                    $error['promotionContent'] = "Enter the promotion content, please!";
                }
                if($promotionStartDay > $promotionEndDay){
                    $error['promotionStartDay'] = "Promotion start date must be smaller than end date.";
                }
                if($promotionEndDay < $promotionStartDay){
                    $error['promotionEndDay'] = "Promotion end date must be greater than start date.";
                }

                if(empty($error)){
                    $result = $this->promotionModel->promotionAddM($promotionName, $promotionContent, 
                                                                        $promotionStartDay, $promotionEndDay);
                    if($result == "true"){
                        $notice = "Promotion has just been added successfully!";

                        unset( $_SESSION['promotionName']);
                        unset($_SESSION['promotionContent']);
                        unset($_SESSION['promotionStartDay']);
                        unset($_SESSION['promotionEndDay']);

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" => "PromotionView",
                            "List" => $this->promotionModel->getList(),
                            "Notice" => $notice
                        ]);
                    }else{
                        $error['fail'] = "Add failed!";

                        $this->getView("master1", [
                            "url"=>$this->getBaseUrl(),
                            "Page" => "PromotionAdd",
                            "Error" => $error
                        ]);
                    }
                    
                }else{
                    $this->getView("master1", [
                        "url"=>$this->getBaseUrl(),
                        "Page" => "PromotionAdd",
                        "Error" => $error
                    ]);
                }
            }
        }

        //Ham cap nhat Khuyen Mai
        function promotionUpdate(){
            if(isset($_POST["btnUpdate"])){
                $promotionName = $_POST["txtPromotionName"];
                $promotionContent = $_POST["txtPromotionContent"];
                $promotionStartDay = $_POST["dtPromotionStartDay"];
                $promotionEndDay = $_POST["dtPromotionEndDay"];
                $promotionId = $_POST["hdPromotionId"];

                $error = array();
                if(strlen($promotionName) == ""){
                    $error['promotionName'] = "Enter the promotion name, please!";
                }
                if(strlen($promotionContent) == ""){
                    $error['promotionContent'] = "Enter the promotion content, please!";
                }

                if($promotionStartDay > $promotionEndDay){
                    $error['promotionStartDay'] = "Promotion start date must be smaller than end date.";
                }
                if($promotionEndDay < $promotionStartDay){
                    $error['promotionEndDay'] = "Promotion end date must be greater than start date.";
                }

                if(empty($error)){
                    $result = $this->promotionModel->promotionUpdateM($promotionName, $promotionContent, 
                                                                        $promotionStartDay, $promotionEndDay, $promotionId);
                    if($result == "true"){
                        $notice = "Promotion has just been updated successfully!";

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" => "PromotionView",
                            "List" => $this->promotionModel->getList(),
                            "Notice" => $notice
                        ]);
                    }else{
                        $error['fail'] = "Update failed";

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" =>"PromotionUpdate",
                            "Detail" => $this->promotionModel->getIdDetail($promotionId),
                            "Error" => $error
                        ]);
                    }
                    
                }else{
                    $this->getView("master1", [
                        "url" => $this->getBaseUrl(),
                        "Page" =>"PromotionUpdate",
                        "Detail" => $this->promotionModel->getIdDetail($promotionId),
                        "Error" => $error
                    ]);
                }


            }
        }

        //Ham xoa Khuyen Mai
        function promotionDelete($promotionId){
            $this->promotionModel->promotionDeleteM($promotionId);
            header("Location: /nguyentranmobile/Promotion/Default ");
        } 
    }
}else{
    header("Location: /nguyentranmobile/Home/DangNhap");
}
?>