<?php
if(isset($_SESSION['admin'])){
    class Customer extends Controller{
        protected $customermodel;

        //contructer
        function __construct()
        {
            $this->customermodel = $this->getModel("CustomerModel");
        }

        //Ham mac dinh khi chay
        function Default(){
            $this->getView("master1", [
                "Page" => "CustomerView",
                "List" => $this->customermodel->getList(),
                "url"=>$this->getBaseUrl()
            ]);
        }

    }
}else{
    header("Location: /nguyentranmobile/Home/DangNhap");
}
?>