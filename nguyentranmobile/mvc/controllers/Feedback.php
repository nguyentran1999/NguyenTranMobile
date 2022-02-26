<?php
if(isset($_SESSION['admin'])){
    class Feedback extends Controller{
        protected $feedbackModel;
        //contructer
        function __construct()
        {
            $this->feedbackModel = $this->getModel("FeedbackModel");
        }

        //Ham mac dinh khi chay
        function Default(){
            $this->getView("master1", [
                "Page" => "FeedbackView",
                "List" => $this->feedbackModel->getList(),
                "url"=>$this->getBaseUrl()
            ]);
        }

    }
}else{
    header("Location: /nguyentranmobile/Home/DangNhap");
}
?>