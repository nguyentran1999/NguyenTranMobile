<?php
if(isset($_SESSION['admin'])){
    class Feedback_Topic extends Controller{

        protected $feedback_topicModel;

        //contructer
        function __construct()
        {
            $this->feedback_topicModel = $this->getModel("Feedback_TopicModel");
        }

        //Ham mac dinh khi chay
        function Default(){
            if(isset($_SESSION['feedback_topicName'])){
                unset($_SESSION['feedback_topicName']);
            }
            $this->getView("master1", [
                "Page" => "Feedback_TopicView",
                "List" => $this->feedback_topicModel->getList(),
                "url"=>$this->getBaseUrl()
            ]);
        }

        //Hien thi view them moi ChuDeGopY
        function addView(){
            $this->getView("master1", [
                "url"=>$this->getBaseUrl(),
                "Page" => "Feedback_TopicAdd"
            ]);
        }

        //Hien thi View cap nhat ChuDeGopY
        function updateView($feedback_topicId){
            $this->getView("master1", [
                "url" => $this->getBaseUrl(),
                "Page" =>"Feedback_TopicUpdate",
                "Detail" => $this->feedback_topicModel->getIdDetail($feedback_topicId)
            ]);
        }

        //Hàm thêm ChuDeGopY
        function feedback_topicAdd(){
            if(isset($_POST["btnAdd"])){
                $feedback_topicName = $_POST["txtFeedback_TopicName"];

                $_SESSION['feedback_topicName'] = $feedback_topicName;

                $error = array();
                if(strlen($feedback_topicName) == ""){
                    $error['feedback_topicName'] = "Enter the feedback topic name, please!";
                }

                if(empty($error)){
                    $result = $this->feedback_topicModel->feedback_topicAddM($feedback_topicName);
                    if($result == "true"){
                        $notice = "Feedback topic has just been added successfully!";

                        unset($_SESSION['feedback_topicName']);

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" => "Feedback_TopicView",
                            "List" => $this->feedback_topicModel->getList(),
                            "Notice" => $notice
                            
                        ]);
                    }else{
                        $error['fail'] = "Add failed!";

                        $this->getView("master1", [
                            "url"=>$this->getBaseUrl(),
                            "Page" => "Feedback_TopicAdd",
                            "Error" => $error
                        ]);
                    }
                    
                }else{
                    $this->getView("master1", [
                        "url"=>$this->getBaseUrl(),
                        "Page" => "Feedback_TopicAdd",
                        "Error" => $error
                    ]);
                }
            }
        }

        //Ham cap nhat ChuDeGopY
        function feedback_topicUpdate(){
            if(isset($_POST["btnUpdate"])){
                $feedback_topicName = $_POST["txtFeedback_TopicName"];
                $feedback_topicId = $_POST["hdFeedback_TopicNameId"];

                $error = array();
                if(strlen($feedback_topicName) == ""){
                    $error['feedback_topicName'] = "Enter the feedback topic name, please!";
                }

                if(empty($error)){
                    $result = $this->feedback_topicModel->feedback_topicUpdateM($feedback_topicName, $feedback_topicId);
                    if($result == "true"){
                        $notice = "Feedback topic has just been updated successfully!";

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" => "Feedback_TopicView",
                            "List" => $this->feedback_topicModel->getList(),
                            "Notice" => $notice
                            
                        ]);
                    }else{
                        $error['fail'] = "Update failed";

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" =>"Feedback_TopicUpdate",
                            "Detail" => $this->feedback_topicModel->getIdDetail($feedback_topicId),
                            "Error" => $error
                        ]);
                    }
                    
                }else{
                    $this->getView("master1", [
                        "url" => $this->getBaseUrl(),
                        "Page" =>"Feedback_TopicUpdate",
                        "Detail" => $this->feedback_topicModel->getIdDetail($feedback_topicId),
                        "Error" => $error
                    ]);
                }


            }
        }

        //Ham xoa ChuDeGopY
        function feedback_topicDelete($feedback_topicId){
            $this->feedback_topicModel->feedback_topicDeleteM($feedback_topicId);
            header("Location: /nguyentranmobile/Feedback_Topic/Default ");
        } 
    }
}else{
    header("Location: /nguyentranmobile/Home/DangNhap");
}

?>