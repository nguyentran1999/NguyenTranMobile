<?php
if(isset($_SESSION['admin'])){
    class Order extends Controller{
        protected $orderModel;

        //contructer
        function __construct()
        {
            $this->orderModel = $this->getModel("OrderModel");
        }

        //Ham mac dinh khi chay
        function Default(){

            $this->getView("master1", [
                "Page" => "OrderView",
                "List" => $this->orderModel->getList2(),
                "url"=>$this->getBaseUrl()
            ]);
        }

        function ThanhToan($orderId){
            $this->orderModel->updatePay(1, $orderId);
            header("Location: /nguyentranmobile/Order/Default ");
        }

        function NgayGiao($orderId){
            $deliveryDate = gmdate('Y-m-d H:i:s');
            $this->orderModel->updateDeliveryDate($deliveryDate, $orderId);
            header("Location: /nguyentranmobile/Order/Default ");
        }
    }
}else{
    header("Location: /nguyentranmobile/Home/DangNhap");
}
?>