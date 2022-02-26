<?php
if(isset($_SESSION['admin'])){
    class Product extends Controller{

        protected $productModel;
        protected $promotionModel;
        protected $producerModel;

        //contructer
        function __construct()
        {
            $this->productModel = $this->getModel("ProductModel");
            $this->promotionModel = $this->getModel("PromotionModel");
            $this->producerModel = $this->getModel("ProducerModel");
        }

        //Ham mac dinh khi chay
        function Default(){
            if(isset($_SESSION["productName"]) && isset($_SESSION["producerId"]) && isset($_SESSION["promotionId"]) && isset($_SESSION["productPrice"])
             && isset($_SESSION['shortDescription']) && isset($_SESSION['detailDescription']) && isset($_SESSION['productConfiguration']) && isset($_SESSION['productAmount'])){

                unset($_SESSION["productName"]);
                unset($_SESSION['producerId']);
                unset($_SESSION['promotionId']);
                unset($_SESSION['productPrice']);
                unset($_SESSION['shortDescription']);
                unset($_SESSION['detailDescription']);
                unset($_SESSION['productConfiguration']);
                unset($_SESSION['productAmount']);
            }
            

            $this->getView("master1", [
                "Page" => "ProductView",
                "List" => $this->productModel->getList(),
                "url"=>$this->getBaseUrl()
            ]);
        }

        //Hien thi view them moi san pham
        function addView(){
            $this->getView("master1", [
                "url"=>$this->getBaseUrl(),
                "Page" => "ProductAdd",
                "ListNSX" => $this->producerModel->getList(),
                "ListKM" => $this->promotionModel->getList()
            ]);
        }

        //Hien thi View cap nhat  san pham
        function updateView($productId=0){
            if ($productId==0) {
                $this->getView("master1", [
                    "Page" => "ProductView",
                    "List" => $this->productModel->getList(),
                    "url"=>$this->getBaseUrl()
                ]); 
            }else{
            $this->getView("master1", [
                "url" => $this->getBaseUrl(),
                "Page" =>"ProductUpdate",
                "Detail" => $this->productModel->getIdDetail($productId),
                "ListNSX" => $this->producerModel->getList(),
                "ListKM" => $this->promotionModel->getList()
            ]);
            }
        }

        //Hàm thêm mới  sản phẩm
        function productAdd(){
            if(isset($_POST["btnAdd"])){
                $productName = $_POST["txtProductName"];
                $producerId = $_POST["slProducerId"];
                $promotionId = $_POST["slPromotionId"];
                $productPrice = $_POST["txtProductPrice"];
                $productOldPrice = $productPrice;
                $shortDescription = $_POST["txtShortDescription"];
                $detailDescription = $_POST["txtDetailDescription"];
                $productConfiguration = $_POST["txtProductConfiguration"];
                $productAmount = $_POST["txtProductAmount"];

                //SESSION luu cac ki tu neu nguoi dung nhap sai
                $_SESSION["productName"] = $productName;
                $_SESSION['producerId'] = $producerId ;
                $_SESSION['promotionId'] = $promotionId;
                $_SESSION['productPrice'] = $productPrice;
                $_SESSION['shortDescription'] = $shortDescription;
                $_SESSION['detailDescription'] = $detailDescription;
                $_SESSION['productConfiguration'] = $productConfiguration;
                $_SESSION['productAmount'] = $productAmount;
                
                //Mang thong bao loi neu nguoi dung nhap sai
                $error = array();
                if(strlen($productName) == ""){
                    $error['productName'] = "Enter the product name, please!";
                }
                if($producerId == "0"){
                    $error['producerId'] = "Choose a producer name, please!";
                }
                if($promotionId == "0"){
                    $error['promotionId'] = "Choose a promotion name, please!";
                }
                if(strlen($productPrice) == ""){
                    $error['productPrice'] = "Enter the product price, please!";
                }
                if(strlen($shortDescription) == ""){
                    $error['shortDescription'] = "Enter a short description, please!";
                }
                if(strlen($detailDescription) == ""){
                    $error['detailDescription'] = "Enter a detail description, please!";
                }
                if(strlen($productConfiguration) == ""){
                    $error['productConfiguration'] = "Enter the product configuration, please!";
                }
                if(strlen($productAmount) == ""){
                    $error['productAmount'] = "Enter the product amount, please!";
                }
                
                if(empty($error)){
                    $result = $this->productModel->productAddM($productName, $producerId, $promotionId, 
                                                            $productPrice, $productOldPrice, $shortDescription, $detailDescription, $productConfiguration, $productAmount);
                    if($result == "true"){
                        $notice = "Product has just been added successfully!";
                        unset($_SESSION["productName"]);
                        unset($_SESSION['producerId']);
                        unset($_SESSION['promotionId']);
                        unset($_SESSION['productPrice']);
                        unset($_SESSION['shortDescription']);
                        unset($_SESSION['detailDescription']);
                        unset($_SESSION['productConfiguration']);
                        unset($_SESSION['productAmount']);

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" => "ProductView",
                            "List" => $this->productModel->getList(),
                            "Notice" => $notice
                            
                        ]);
                    }else{
                        $error['fail'] = "Add failed!";
                        $this->getView("master1", [
                            "url"=>$this->getBaseUrl(),
                            "Page" => "ProductAdd",
                            "ListNSX" => $this->producerModel->getList(),
                            "ListKM" => $this->promotionModel->getList(),
                            "Error" => $error
                        ]);
                    }
                }else{
                    $this->getView("master1", [
                        "url"=>$this->getBaseUrl(),
                        "Page" => "ProductAdd",
                        "ListNSX" => $this->producerModel->getList(),
                        "ListKM" => $this->promotionModel->getList(),
                        "Error" => $error
                    ]);
                }
            }
        }

        //Ham cap nhat San Pham
        function productUpdate(){
            if(isset($_POST["btnUpdate"])){
                $productName = $_POST["txtProductName"];
                $producerId = $_POST["slProducerId"];
                $promotionId = $_POST["slPromotionId"];
                $productPrice = $_POST["txtProductPrice"];
                $productOldPrice = $_POST["txtProductOldPrice"];
                $shortDescription = $_POST["txtShortDescription"];
                $detailDescription = $_POST["txtDetailDescription"];
                $productConfiguration = $_POST["txtProductConfiguration"];
                $productAmount = $_POST["txtProductAmount"];
                $productId = $_POST["hdProductId"];

                $error = array();
                if(strlen($productName) == ""){
                    $error['productName'] = "Enter the product name, please!";
                }
                if($producerId == "0"){
                    $error['producerId'] = "Choose a producer name, please!";
                }
                if($promotionId == "0"){
                    $error['promotionId'] = "Choose a promotion name, please!";
                }
                if($productPrice == ""){
                    $error['productPrice'] = "Enter the product price, please!";
                }
                if($productOldPrice == ""){
                    $error['productOldPrice'] = "Enter the product old price, please!";
                }
                if(strlen($shortDescription) == ""){
                    $error['shortDescription'] = "Enter a short description, please!";
                }
                if(strlen($detailDescription) == ""){
                    $error['detailDescription'] = "Enter a detail description, please!";
                }
                if(strlen($productConfiguration) == ""){
                    $error['productConfiguration'] = "Enter the product configuration, please!";
                }
                if(strlen($productAmount) == ""){
                    $error['productAmount'] = "Enter the product amount, please!";
                }

                if(empty($error)){
                    $result = $this->productModel->productUpdateM($productName, $producerId, $promotionId, 
                                                $productPrice, $productOldPrice, $shortDescription, $detailDescription, $productConfiguration, $productAmount, $productId);
                    if($result == "true"){
                        $notice = "Producer has just been updated successfully!";

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" => "ProductView",
                            "List" => $this->productModel->getList(),
                            "Notice" => $notice 
                        ]);
                    }else{
                        $error['fail'] = "Update failed";

                        $this->getView("master1", [
                            "url" => $this->getBaseUrl(),
                            "Page" =>"ProductUpdate",
                            "Detail" => $this->productModel->getIdDetail($productId),
                            "ListNSX" => $this->producerModel->getList(),
                            "ListKM" => $this->promotionModel->getList(),
                            "Error" => $error
                        ]);
                    }
                }else{
                    $this->getView("master1", [
                        "url" => $this->getBaseUrl(),
                        "Page" =>"ProductUpdate",
                        "Detail" => $this->productModel->getIdDetail($productId),
                        "ListNSX" => $this->producerModel->getList(),
                        "ListKM" => $this->promotionModel->getList(),
                        "Error" => $error
                    ]);
                }


            }
        }

        //Ham xoa SanPham
        function productDelete($productId){
            if($this->productModel->productDeleteM($productId) == "true"){
                header("Location: /nguyentranmobile/Product/Default ");
            }
            
        }
        
        function updateImageView($productId = 0){
            if($productId == 0){
                $this->getView("master1", [
                    "Page" => "ProductView",
                    "List" => $this->productModel->getList(),
                    "url"=>$this->getBaseUrl()
                ]);
            }
            $this->getView("master1", [
                "url" => $this->getBaseUrl(),
                "Page" => "ProductUpdatePicture",
                "Detail" => $this->productModel->getIdDetail($productId),
                "Hinh" => $this->productModel->getProductPicture($productId)
            ]);

        }

        function productPictureUpdate(){
            if(isset($_POST["btnSave"])){
                $productId = $_POST["txtProductId"];
                $image = $_FILES['image']['name'];
    
                $error = array();
                if($image == null){
                    $error['imagechon'] = "You need to choose a photo, please!";
                }else {
                    // Tao folder uploads de chua file
                    $target_dir = "public/uploads/";
                    //Tao duong dan file sau khi upload len he thong
                    $target_file = $target_dir.basename($image);
                    //kich thuoc file
                    if($_FILES['image']['size'] > 5242880){
                        $error['imagekichthuoc'] = "You can only upload files under 5MB, please!";
                    }

                    //kiem tra loai file
                    $file_type = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $file_type_allow = array('png', 'jpg', 'jpeg', 'gif');
                    if(!in_array(strtolower($file_type), $file_type_allow)){
                        $error['imagekichthuoc'] = "Only upload photos, please!";
                    }

                    //kiem tra file da ton tai tren he thong
                    if(file_exists($target_file)){
                        $error['imagetontai'] = "File already exists on the system!";
                    }

                    
                }
                //kiem tra va chuyen bo nho tam len server
                if(empty($error)){
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
                        $result = $this->productModel->productPictureUpdateM($productId, $image);
                        if($result=="true"){
                            $notice="Update product images successfully!";
                            $this->getView("master1", [
                                "url" => $this->getBaseUrl(),
                                "Page" => "ProductUpdatePicture",
                                "Detail" => $this->productModel->getIdDetail($productId),
                                "Hinh" => $this->productModel->getProductPicture($productId),
                                "Notice" => $notice
                            ]);  
                            
                        }else{
                            $error['fail']="Update failed!";
                            $this->getView("master1", [
                                "url" => $this->getBaseUrl(),
                                "Page" => "ProductUpdatePicture",
                                "Detail" => $this->productModel->getIdDetail($productId),
                                "Hinh" => $this->productModel->getProductPicture($productId),
                                "Error" => $error
                            ]);
                        }   
                    }
                }else{
                    $this->getView("master1", [
                        "url" => $this->getBaseUrl(),
                        "Page" => "ProductUpdatePicture",
                        "Detail" => $this->productModel->getIdDetail($productId),
                        "Hinh" => $this->productModel->getProductPicture($productId),
                        "Error" => $error
                    ]);    
                }
              
            }
        }

        function productPictureDelete($productPictureId, $productId){
            $this->productModel->productPictureDeleteM($productPictureId);
            header("Location: /nguyentranmobile/Product/updateImageView/$productId");

        }
    }
}else{
    header("Location: /nguyentranmobile/Home/DangNhap");
}
?>