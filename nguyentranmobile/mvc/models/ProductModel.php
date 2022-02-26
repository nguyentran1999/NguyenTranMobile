<?php
    class ProductModel extends DB{

        //Select SanPham join Khuyen Mai join Loai San Pham join Nha San Xuat
        function getList(){
            $sql = "SELECT * FROM `product` JOIN `producer` ON product.producer_id = producer.producer_id
                                            JOIN `promotion` ON product.promotion_id = promotion.promotion_id WHERE product.product_amount > 0";
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        //select hinh san pham
        function getProductPicture($productId){
            $sql = "SELECT * FROM `product` JOIN `product_picture` ON product.product_id = product_picture.product_id WHERE product.product_id = $productId AND product.product_amount > 0 ";
                                           
            $list = mysqli_query($this->conn, $sql);

            return $list;
        }
        //insert
        function productAddM($productName, $producerId, $promotionId, $productPrice, $productOldPrice, 
                            $shortDescription, $detailDescription, $productConfiguration, $productAmount){
            $sql = "INSERT INTO `product`(`product_name`, `producer_id`, `promotion_id`, `product_price`, `product_old_price`,
                                         `product_short_description`, `product_detail_description`, `product_configuration`, `product_amount`) 
                                VALUES('$productName', $producerId, $promotionId, $productPrice, $productOldPrice,  
                                        '$shortDescription', '$detailDescription', '$productConfiguration', $productAmount)";
           
            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
            
        }

        //update
        function productUpdateM($productName, $producerId, $promotionId, $productPrice, $productOldPrice, $shortDescription, $detailDescription, $productConfiguration, $productAmount, $productId){
            $sql = "UPDATE `product` SET `product_name` = '$productName', `producer_id` = $producerId, `promotion_id` = $promotionId,
                                        `product_price` = $productPrice, `product_old_price` = $productOldPrice, `product_short_description` = '$shortDescription', `product_detail_description` = '$detailDescription',
                                        `product_configuration` = '$productConfiguration', `product_amount` = $productAmount 
                                        WHERE `product_id` = $productId";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }

            return json_encode($result);
            
        }

        //Delete
        function productDeleteM($productId){
            $sql = "DELETE FROM `product` WHERE `product_id` = $productId";
            $sql2 = "DELETE FROM `product_picture` WHERE `product_id` = $productId";
            $result = false;
            if(mysqli_query($this->conn, $sql2)){
                if(mysqli_query($this->conn, $sql)){
                    $result = true;
                }
            }
            return json_encode($result);
        }

        //Delete hinh san pham
        function productPictureDeleteM($productPictureId){
            $sql = "DELETE FROM `product_picture` WHERE `product_picture_id` = $productPictureId";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }

            return json_encode($result);
        }

        
  

        //Select có truyền mã san pham
        function getIdDetail($productId){
            $sql = "SELECT * FROM `product` WHERE `product_id` = $productId AND product_amount > 0" ;
            $list = mysqli_query($this->conn,$sql);

            return $list;
        }

        //Update Picture 
        function productPictureUpdateM($productId, $image){
            $sql = "INSERT INTO `product_picture` SET `product_picture_name` = '$image', `product_id` = $productId";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }

        //////////////
        function getProduct(){
            $sql = "SELECT * FROM `product` JOIN `product_picture` ON product.product_id = product_picture.product_id 
                                            JOIN `promotion` ON product.promotion_id = promotion.promotion_id 
                                            GROUP BY product.product_id HAVING product.product_amount > 0 ";

            $list = mysqli_query($this->conn, $sql);

            return $list;
                                            
        }
        ///san pham Khuyen mai
        function getPromotionProduct(){
            $sql = "SELECT * FROM `product` JOIN `product_picture` ON product.product_id = product_picture.product_id
                                            JOIN `promotion` ON product.promotion_id = promotion.promotion_id 
                                            WHERE promotion.promotion_id != 1 AND product.product_amount > 0 GROUP BY product.product_id";

            $list = mysqli_query($this->conn, $sql);

            return $list;
                                            
        }

        //getSanPham_KM_NSX_TheoNhaSanXuat
        function getProductPromotionOfProducer($producerId){
            $sql = "SELECT * FROM `product` JOIN `product_picture` ON product.product_id = product_picture.product_id
                                            JOIN `promotion` ON product.promotion_id = promotion.promotion_id
                                            JOIN `producer` ON product.producer_id = producer.producer_id
                                            GROUP BY product.product_id
                                            HAVING producer.producer_id = $producerId AND product.product_amount > 0";

            $list = mysqli_query($this->conn, $sql);

            return $list;
        }
        //getSanPham_KM_NSX
        function getProductSingle($productId){
            $sql = "SELECT * FROM `product` JOIN `producer` ON product.producer_id = producer.producer_id
                                            JOIN `promotion` ON product.promotion_id = promotion.promotion_id
                                            WHERE product.product_id = $productId AND product.product_amount > 0";

            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        //getHinhSanPhamTheoMa
        function getProductPictureOfId($productId){
            $sql = "SELECT * FROM `product` JOIN `product_picture` ON product.product_id = product_picture.product_id
                                            WHERE product.product_id = $productId AND product.product_amount > 0";

            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        function getProductPictureOfIdRepresent($productId){
            $sql = "SELECT * FROM `product` JOIN `product_picture` ON product.product_id = product_picture.product_id
                                            WHERE product.product_id = $productId AND product.product_amount > 0
                                            LIMIT 1";

            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        public function checkValidate($productId){
            $sql = "SELECT * FROM `product` JOIN `product_picture` ON product.product_id = product_picture.product_id
                                            WHERE product.product_id = $productId AND product.product_amount > 0
                                            LIMIT 1";

            $list = mysqli_query($this->conn, $sql);
            
            return mysqli_fetch_array($list);
            
        }

        public function SearchSanPham($q){
            $sql = "SELECT * FROM `product` JOIN `product_picture` ON product.product_id = product_picture.product_id
                                            JOIN `promotion` ON product.promotion_id = promotion.promotion_id
                                            JOIN `producer` ON product.producer_id = producer.producer_id
                                            GROUP BY product.product_id
                                            HAVING product.product_name LIKE '%$q%' AND product.product_amount > 0";

            $list = mysqli_query($this->conn, $sql);

            return $list;
        }

        

    }
?>