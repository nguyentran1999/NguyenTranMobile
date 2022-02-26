<?php 
        
    class OrderModel extends DB
    {

        // Hiển thị tất cả đơn hàng
        function getList()
        {
            $sql = "SELECT * FROM `orders` JOIN payment ON payment.payment_id = orders.payment_id 
            JOIN customer ON customer.customer_account_name = orders.customer_account_name JOIN product_order ON product_order.order_id = orders.order_id";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }

        function getList2()
        {
            $sql = "SELECT orders.order_id, product.product_name, product_order.product_order_amount, orders.order_date, orders.order_delivery_date, 
            orders.order_delivery_address, orders.order_status,orders.payment_id, product_order.product_order_total_price  , orders.customer_account_name 
            FROM `product_order` JOIN product ON product_order.product_id = product.product_id 
            JOIN orders ON product_order.order_id = orders.order_id";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }

        //Update vao csdl
        public function updatePay($dh_tttt, $orderId){
            $sql = "UPDATE `orders` SET `order_status`= $dh_tttt
                    WHERE `order_id`= $orderId";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }

            return json_encode($result);
        }

        public function updateDeliveryDate($orderDeliveryDate, $orderId){
            $sql = "UPDATE `orders` SET `order_delivery_date`= '$orderDeliveryDate'
                    WHERE `order_id`= $orderId";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }

            return json_encode($result);
        }

        //getListLichSu
        function getOrderList($customerAccountName)
        {
            $sql = "SELECT orders.order_id, product.product_name, product_order.product_order_amount, orders.order_date, orders.order_delivery_date, 
            orders.order_delivery_address, orders.order_status FROM `product_order` JOIN product ON product_order.product_id = product.product_id 
            JOIN orders ON product_order.order_id = orders.order_id WHERE orders.customer_account_name = '$customerAccountName'";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }
        // Tìm kiếm chi tiết hóa đơn
        function GetDetailOrder($orderId)
        {
            $sql = "SELECT * FROM `product_order` JOIN `product` ON product.product_id = product_order.product_id WHERE order_id = $orderId";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }

        // Lấy hình thức thanh toán của hóa đơn
        function GetPayment($orderId)
        {
            $sql = "SELECT * FROM `orders` JOIN payment ON payment.payment_id = orders.payment_id WHERE orders.order_id = $orderId ";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }


        // Tạo đơn hàng
        function CreateOrder($orderId, $orderDate, $orderDeliveryAddress, $orderStatus, $paymentId, $customerAccountName)   
        {
            $sql = "INSERT INTO `orders`(`order_id`, `order_date`, `order_delivery_date`, `order_delivery_address`, `order_status`, `payment_id`, `customer_account_name`)
             VALUES ($orderId, '$orderDate', '0000-00-00 00:00:00' , '$orderDeliveryAddress', $orderStatus, $paymentId, '$customerAccountName')"; 
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }

        // Tạo ID cho đơn hàng
        function GetIDOrder()
        {
            $sql = "SELECT order_id FROM `orders` WHERE order_id = (SELECT MAX(order_id) FROM `orders`)";
            $result = mysqli_query($this->conn, $sql);
            $row = mysqli_num_rows($result);
            if($row > 0){
                while($row = mysqli_fetch_array($result)){
                    return $row["order_id"];
                }
            }else{
                return 0;
            }
        }

        // Thêm chi tiết đơn hàng (product_order)
        function AddProductToBill($productId, $orderId, $soluong, $dongia )
        {
            $sql = "INSERT INTO `product_order`(`product_id`, `order_id`, `product_order_amount`, `product_order_total_price`) 
            VALUES ($productId,$orderId,$soluong,$dongia)";
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }


        // Cập nhật số lượng trong kho
        function UpdateAmount($productId, $orderId)
        {
            $sql = "UPDATE `product` SET  product.product_amount = product.product_amount - (SELECT product_order.product_order_amount 
            FROM product_order WHERE product_order.product_id = $productId AND product_order.order_id = $orderId) WHERE product.product_id = $productId";
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }
    }
    

?>